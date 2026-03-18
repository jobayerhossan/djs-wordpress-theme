<?php
/**
 * Custom cart page template.
 *
 * @package DJS
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

$cart_count          = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
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
	<div class="djs-container">
		<header class="djs-cart-page__header">
			<div class="djs-cart-page__eyebrow"><?php esc_html_e( 'Panier', 'djs' ); ?></div>
			<div class="djs-cart-page__count">
				<?php
				printf(
					/* translators: %d: product count */
					esc_html( _n( '%d produit', '%d produits', $cart_count, 'djs' ) ),
					intval( $cart_count )
				);
				?>
			</div>
		</header>

		<form class="woocommerce-cart-form djs-cart-layout" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<div class="djs-cart-items">
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
					<?php
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( ! $_product || ! $_product->exists() || 0 >= $cart_item['quantity'] || ! apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						continue;
					}

					$product_permalink = apply_filters(
						'woocommerce_cart_item_permalink',
						$_product->is_visible() ? $_product->get_permalink( $cart_item ) : '',
						$cart_item,
						$cart_item_key
					);

					$product_image = apply_filters(
						'woocommerce_cart_item_thumbnail',
						$_product->get_image( 'woocommerce_thumbnail' ),
						$cart_item,
						$cart_item_key
					);

					$quantity = woocommerce_quantity_input(
						array(
							'input_name'   => "cart[{$cart_item_key}][qty]",
							'input_value'  => $cart_item['quantity'],
							'max_value'    => $_product->get_max_purchase_quantity(),
							'min_value'    => '0',
							'product_name' => $_product->get_name(),
						),
						$_product,
						false
					);
					?>

					<div class="djs-cart-item">
						<div class="djs-cart-item__media">
							<?php if ( $product_permalink ) : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>">
									<?php echo $product_image; ?>
								</a>
							<?php else : ?>
								<?php echo $product_image; ?>
							<?php endif; ?>
						</div>

						<div class="djs-cart-item__content">
							<div class="djs-cart-item__top">
								<div>
									<h2 class="djs-cart-item__title">
										<?php if ( $product_permalink ) : ?>
											<a href="<?php echo esc_url( $product_permalink ); ?>">
												<?php echo wp_kses_post( $_product->get_name() ); ?>
											</a>
										<?php else : ?>
											<?php echo wp_kses_post( $_product->get_name() ); ?>
										<?php endif; ?>
									</h2>

									<div class="djs-cart-item__meta">
										<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
									</div>

									<div class="djs-cart-item__price">
										<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
									</div>
								</div>

								<div class="djs-cart-item__remove">
									<?php
									echo apply_filters(
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">×</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_attr__( 'Remove this item', 'woocommerce' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
									?>
								</div>
							</div>

							<div class="djs-cart-item__quantity-row">
								<span class="djs-cart-item__quantity-label"><?php esc_html_e( 'Quantité', 'djs' ); ?></span>
								<div class="djs-cart-item__quantity-controls">
									<button type="button" class="djs-cart-qty-btn djs-cart-qty-btn--minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'djs' ); ?>">−</button>
									<div class="djs-cart-item__quantity-input"><?php echo $quantity; ?></div>
									<button type="button" class="djs-cart-qty-btn djs-cart-qty-btn--plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'djs' ); ?>">+</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<input type="hidden" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">

				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</div>

			<aside class="djs-cart-summary">
				<div class="djs-cart-summary__title"><?php esc_html_e( 'Résumé de la commande', 'djs' ); ?></div>

				<div class="djs-cart-summary__row">
					<span><?php esc_html_e( 'Total', 'djs' ); ?></span>
					<strong><?php wc_cart_totals_order_total_html(); ?></strong>
				</div>

				<div class="djs-cart-summary__note">
					<?php esc_html_e( 'Taxes et frais d’expédition calculés au paiement', 'djs' ); ?>
				</div>

				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="djs-cart-summary__checkout">
					<span><?php esc_html_e( 'Aller au paiement', 'djs' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>

				<p class="djs-cart-summary__legal">
					<?php esc_html_e( 'En validant ma commande, j’affirme avoir pris connaissance et accepté sans réserve les Conditions Générales de Vente et la Politique de Confidentialité de DJS Paris.', 'djs' ); ?>
				</p>

				<div class="djs-cart-summary__benefit">
					<?php esc_html_e( '✓ Livraison offerte', 'djs' ); ?>
				</div>
			</aside>
		</form>

		<section class="djs-cart-suggestions">
			<div class="djs-cart-suggestions__tabs">
				<button type="button" class="djs-cart-suggestions__tab is-active"><?php esc_html_e( 'Vous aimerez aussi', 'djs' ); ?></button>
				<button type="button" class="djs-cart-suggestions__tab" disabled><?php esc_html_e( 'Consulté récemment', 'djs' ); ?></button>
			</div>

			<?php if ( $suggested_query->have_posts() ) : ?>
				<?php woocommerce_product_loop_start(); ?>
				<?php while ( $suggested_query->have_posts() ) : ?>
					<?php $suggested_query->the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; ?>
				<?php woocommerce_product_loop_end(); ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</section>
	</div>
</section>

<?php do_action( 'woocommerce_after_cart' ); ?>
