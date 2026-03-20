<?php
/**
 * Cart AJAX helpers and handlers.
 *
 * @package DJS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the legal page URLs used in the cart summary.
 *
 * @return array
 */
function djs_get_cart_policy_urls() {
	$privacy_page = get_page_by_path( 'politique-de-confidentialite' );
	$terms_page   = get_page_by_path( 'cgv' );

	return array(
		'privacy' => $privacy_page instanceof WP_Post ? get_permalink( $privacy_page ) : home_url( '/politique-de-confidentialite/' ),
		'terms'   => $terms_page instanceof WP_Post ? get_permalink( $terms_page ) : home_url( '/cgv/' ),
	);
}

/**
 * Render the cart page header markup.
 *
 * @return string
 */
function djs_get_cart_page_header_html() {
	$cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;

	ob_start();
	?>
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
	<?php

	return (string) ob_get_clean();
}

/**
 * Render the cart form markup.
 *
 * @return string
 */
function djs_get_cart_form_html() {
	$policy_urls = djs_get_cart_policy_urls();

	ob_start();
	?>
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
									<?php
									echo apply_filters(
										'woocommerce_cart_item_subtotal',
										WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ),
										$cart_item,
										$cart_item_key
									);
									?>
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
				<?php
				printf(
					wp_kses(
						__( 'En validant ma commande, j’affirme avoir pris connaissance et accepté sans réserve les <a href="%1$s">Conditions Générales de Vente</a> et la <a href="%2$s">Politique de Confidentialité</a> de DJS Paris.', 'djs' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( $policy_urls['terms'] ),
					esc_url( $policy_urls['privacy'] )
				);
				?>
			</p>

			<div class="djs-cart-summary__benefit">
				<?php esc_html_e( '✓ Livraison offerte', 'djs' ); ?>
			</div>
		</aside>
	</form>
	<?php

	return (string) ob_get_clean();
}

/**
 * Handle AJAX quantity updates on the cart page.
 */
function djs_ajax_update_cart_quantities() {
	check_ajax_referer( 'djs_ajax_nonce', 'nonce' );

	if ( ! WC()->cart ) {
		wp_send_json_error(
			array(
				'message' => __( 'Le panier est indisponible pour le moment.', 'djs' ),
			),
			400
		);
	}

	$cart_values = isset( $_POST['cart'] ) ? (array) wp_unslash( $_POST['cart'] ) : array();

	foreach ( $cart_values as $cart_item_key => $cart_item_data ) {
		$quantity = isset( $cart_item_data['qty'] ) ? wc_stock_amount( $cart_item_data['qty'] ) : null;

		if ( null === $quantity ) {
			continue;
		}

		WC()->cart->set_quantity( sanitize_text_field( $cart_item_key ), $quantity, false );
	}

	WC()->cart->calculate_totals();
	WC()->cart->maybe_set_cart_cookies();

	wp_send_json_success(
		array(
			'header_html' => djs_get_cart_page_header_html(),
			'form_html'   => djs_get_cart_form_html(),
			'cart_count'  => WC()->cart->get_cart_contents_count(),
			'notices'     => wc_print_notices( true ),
		)
	);
}
add_action( 'wp_ajax_djs_update_cart_quantities', 'djs_ajax_update_cart_quantities' );
add_action( 'wp_ajax_nopriv_djs_update_cart_quantities', 'djs_ajax_update_cart_quantities' );
