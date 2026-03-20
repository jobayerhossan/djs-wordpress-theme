<?php
/**
 * Custom cart page template.
 *
 * @package DJS
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

$cart_product_ids    = array();
$suggested_products  = array();

if ( WC()->cart ) {
	foreach ( WC()->cart->get_cart() as $cart_item ) {
		$cart_product_ids[] = $cart_item['product_id'];

		$related_ids = wc_get_related_products( $cart_item['product_id'], 3 );

		if ( ! empty( $related_ids ) ) {
			$suggested_products = array_merge( $suggested_products, $related_ids );
		}
	}
}

$suggested_products = array_values(
	array_unique(
		array_diff( $suggested_products, $cart_product_ids )
	)
);

if ( empty( $suggested_products ) ) {
	$suggested_query_args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 3,
		'post__not_in'   => $cart_product_ids,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
} else {
	$suggested_query_args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 3,
		'post__in'       => array_slice( $suggested_products, 0, 3 ),
		'orderby'        => 'post__in',
	);
}

$suggested_query = new WP_Query( $suggested_query_args );
?>

<section class="djs-cart-page">
	<?php echo djs_get_cart_page_header_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<?php echo djs_get_cart_form_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<section class="djs-cart-suggestions">
		<div class="djs-cart-suggestions__tabs">
			<button type="button" class="djs-cart-suggestions__tab is-active" data-target="recommended"><?php esc_html_e( 'Vous aimerez aussi', 'djs' ); ?></button>
			<button type="button" class="djs-cart-suggestions__tab" data-target="recently-viewed"><?php esc_html_e( 'Consulté récemment', 'djs' ); ?></button>
		</div>

		<div class="djs-cart-suggestions__panel is-active" data-panel="recommended">
			<?php if ( $suggested_query->have_posts() ) : ?>
				<?php woocommerce_product_loop_start(); ?>
				<?php while ( $suggested_query->have_posts() ) : ?>
					<?php $suggested_query->the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; ?>
				<?php woocommerce_product_loop_end(); ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>

		<div class="djs-cart-suggestions__panel" data-panel="recently-viewed">
			<div class="djs-cart-suggestions__recently-viewed" data-empty-text="<?php echo esc_attr__( 'Aucun produit consulte recemment pour le moment.', 'djs' ); ?>">
				<p class="djs-cart-suggestions__empty"><?php esc_html_e( 'Chargement des produits recemment consultes...', 'djs' ); ?></p>
			</div>
		</div>
	</section>
</section>

<?php do_action( 'woocommerce_after_cart' ); ?>
