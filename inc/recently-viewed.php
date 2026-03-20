<?php
/**
 * Recently viewed product helpers.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build recently viewed products HTML from a list of product IDs.
 *
 * @param array $product_ids Product IDs in display order.
 *
 * @return string
 */
function djs_get_recently_viewed_products_html( $product_ids ) {
	$product_ids = array_values(
		array_filter(
			array_map( 'absint', (array) $product_ids )
		)
	);

	if ( empty( $product_ids ) ) {
		return '<p class="djs-cart-suggestions__empty">' . esc_html__( 'Aucun produit consulte recemment pour le moment.', 'djs' ) . '</p>';
	}

	$query = new WP_Query(
		array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'post__in'       => array_slice( $product_ids, 0, 12 ),
			'orderby'        => 'post__in',
		)
	);

	if ( ! $query->have_posts() ) {
		return '<p class="djs-cart-suggestions__empty">' . esc_html__( 'Aucun produit consulte recemment pour le moment.', 'djs' ) . '</p>';
	}

	ob_start();
	woocommerce_product_loop_start();

	while ( $query->have_posts() ) {
		$query->the_post();
		wc_get_template_part( 'content', 'product' );
	}

	woocommerce_product_loop_end();
	wp_reset_postdata();

	return (string) ob_get_clean();
}

/**
 * Handle AJAX recently viewed products requests.
 */
function djs_ajax_get_recently_viewed_products() {
	check_ajax_referer( 'djs_ajax_nonce', 'nonce' );

	$product_ids = isset( $_POST['product_ids'] ) ? (array) wp_unslash( $_POST['product_ids'] ) : array();

	wp_send_json_success(
		array(
			'html' => djs_get_recently_viewed_products_html( $product_ids ),
		)
	);
}
add_action( 'wp_ajax_djs_get_recently_viewed_products', 'djs_ajax_get_recently_viewed_products' );
add_action( 'wp_ajax_nopriv_djs_get_recently_viewed_products', 'djs_ajax_get_recently_viewed_products' );
