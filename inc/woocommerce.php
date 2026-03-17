<?php 
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Refresh header cart count after AJAX add to cart
 */
function djs_header_cart_count_fragment( $fragments ) {
	ob_start();
	?>
	<span class="header-cart-count">
		<?php echo WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?>
	</span>
	<?php
	$fragments['.header-cart-count'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'djs_header_cart_count_fragment' );