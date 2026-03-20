<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product || ! $product->is_visible() ) {
	return;
}

$product_id        = $product->get_id();
$primary_image_id  = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();
$hover_image_id    = ! empty( $gallery_image_ids ) ? $gallery_image_ids[0] : $primary_image_id;
?>

<li <?php wc_product_class( 'djs-product-card', $product ); ?>>

	<div class="djs-product-card__inner">
		<div class="djs-product-card__wishlist">
			<?php echo djs_get_wishlist_button_html( $product_id, 'loop' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

		<div class="djs-product-card__image-wrap">
			<a href="<?php the_permalink(); ?>" class="djs-product-card__image-link">

				<?php if ( $primary_image_id ) : ?>
					<div class="djs-product-card__image djs-product-card__image--default">
						<?php
						echo wp_get_attachment_image(
							$primary_image_id,
							'large',
							false,
							array(
								'class' => 'djs-product-card__img',
								'alt'   => esc_attr( get_the_title() ),
							)
						);
						?>
					</div>
				<?php endif; ?>

				<?php if ( $hover_image_id ) : ?>
					<div class="djs-product-card__image djs-product-card__image--hover">
						<?php
						echo wp_get_attachment_image(
							$hover_image_id,
							'large',
							false,
							array(
								'class' => 'djs-product-card__img',
								'alt'   => esc_attr( get_the_title() ),
							)
						);
						?>
					</div>
				<?php endif; ?>
			</a>

			<div class="djs-product-card__overlay">
				<?php
				echo apply_filters(
					'woocommerce_loop_add_to_cart_link',
					sprintf(
						'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
						esc_attr(
							implode(
								' ',
								array_filter(
									array(
										'button',
										'product_type_' . $product->get_type(),
										$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
										$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
										'djs-product-card__cart-btn',
									)
								)
							)
						),
						wc_implode_html_attributes(
							array(
								'data-product_id'  => $product->get_id(),
								'data-product_sku' => $product->get_sku(),
								'aria-label'       => $product->add_to_cart_description(),
								'rel'              => 'nofollow',
							)
						),
						esc_html( $product->add_to_cart_text() )
					),
					$product,
					array()
				);
				?>
			</div>
		</div>

		<div class="djs-product-card__content">
			<h2 class="djs-product-card__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<div class="djs-product-card__price">
				<?php echo $product->get_price_html(); ?>
			</div>
		</div>

	</div>

</li>
