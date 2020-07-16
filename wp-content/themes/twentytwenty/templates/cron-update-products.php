<?php
/**
 * Template Name: Update Products Page
 */

echo "[" . date("Y-m-d H:i:s") . "] update products job is starting <br/>".PHP_EOL;

/**
 * Storage logs
 * @param  string $message
 * @return           
 */
function file_logs( $message ) {
	$log = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "Attempt: Failed".PHP_EOL.
        "Message: ".$message.PHP_EOL.
        "-------------------------".PHP_EOL;
		//Save string to log, use FILE_APPEND to append.
		file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
}

// connect replica database
function get_products_replica() {
	try {
		$replica = new wpdb('root', 'osxmysql', 'demowordpress_replica', 'localhost');
		if ( is_wp_error( $replica->error ) ) {
			throw new Exception( $replica->error->get_error_message() );
		}

		$table = 'products_detail';
		// get data of product detail from replica
		$sql = "SELECT * FROM {$table} ORDER BY product_id DESC";
		$update_products = $replica->get_results( $sql, ARRAY_A );
		if ( ! $update_products ) {
			throw new Exception( 'Get data from replica is empty.' );
		}
		return $update_products;
	} catch (Exception $e) {
		file_logs( $e->getMessage() );
		echo "Connect to Replica is failed, please check logs for more info";
		exit;
	}
}

/**
 * Update product sku
 * @param  string $sql query statement
 * @return bool
 */
function update_product_sku( $sql ) {
	global $wpdb;
	$query = "
		UPDATE $wpdb->postmeta mt
		JOIN(
			$sql
		) vals ON mt.post_id = vals.id
		SET meta_value = sku
		WHERE meta_key = '_sku'
	";
	$update = $wpdb->query( $query );
	if ( $wpdb->last_error ) {
		throw new Exception( $wpdb->last_error );
	}
}

function update_product_stock( $sql ) {
	global $wpdb;
	$query = "
		UPDATE $wpdb->postmeta mt
		JOIN(
			$sql
		) vals ON mt.post_id = vals.id
		SET meta_value = stock
		WHERE meta_key = '_stock'
	";
	$update = $wpdb->query( $query );
	if ( $wpdb->last_error ) {
		throw new Exception( $wpdb->last_error );
	}
}


/**
 * Update products detail from Replica
 * @return 
 */
function update_products() {
	try {
		global $wpdb;

		$products_replica = get_products_replica();
		$products_replica_ids = array_column( $products_replica, 'product_id' );
		$_listIdsToString = implode( ',', $products_replica_ids );
		
		$_sku = "";
		$_stock = "";
		foreach ( $products_replica as $key => $product ) {
			if ( 0 == $key ) {
				$_sku .= "SELECT {$product['product_id']} as id, '{$product['sku']}' as sku";
				$_stock .= "SELECT {$product['product_id']} as id, {$product['stock']} as stock";
			} else {
				$_sku .= "SELECT {$product['product_id']}, '{$product['sku']}'";
				$_stock .= "SELECT {$product['product_id']}, {$product['stock']}";
			}

			if ( end( $products_replica ) != $product ) {
				$_sku .= " UNION ALL ";
				$_stock .= " UNION ALL ";
			}
		}

		update_product_sku( $_sku );
		update_product_stock( $_stock );
		echo "Update products successfully";
	} catch (Exception $e) {
		file_logs( $e->getMessage() );
		echo "Update products failed, please check logs";
		exit;
	}
}

update_products();