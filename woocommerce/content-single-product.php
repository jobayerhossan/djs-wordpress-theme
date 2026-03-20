<?php
/**
 * Custom single product content template.
 *
 * @package DJS
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product instanceof WC_Product ) {
	return;
}

$product_id         = $product->get_id();
$attachment_ids     = array_filter(
	array_unique(
		array_merge(
			array( $product->get_image_id() ),
			$product->get_gallery_image_ids()
		)
	)
);
$shop_page_url      = wc_get_page_permalink( 'shop' );
$badge_text         = function_exists( 'get_field' ) ? trim( (string) get_field( 'djs_product_badge', $product_id ) ) : '';
$size_guide_url     = function_exists( 'get_field' ) ? (string) get_field( 'djs_size_guide_url', $product_id ) : '';
$find_my_size_url   = function_exists( 'get_field' ) ? (string) get_field( 'djs_find_my_size_url', $product_id ) : '';
$size_fit_content   = function_exists( 'get_field' ) ? (string) get_field( 'djs_size_fit_content', $product_id ) : '';
$care_content       = function_exists( 'get_field' ) ? (string) get_field( 'djs_composition_care_content', $product_id ) : '';
$responsibility     = function_exists( 'get_field' ) ? (string) get_field( 'djs_responsibility_content', $product_id ) : '';
$delivery_returns   = function_exists( 'get_field' ) ? (string) get_field( 'djs_delivery_returns_content', $product_id ) : '';
$short_description  = $product->get_short_description();
$full_description   = $product->get_description();
$description_markup = $short_description ? $short_description : $full_description;
$price_suffix       = $product->get_price_suffix();
$categories         = wc_get_product_terms( $product_id, 'product_cat', array( 'fields' => 'names' ) );
$color_names        = wc_get_product_terms( $product_id, 'pa_couleurs', array( 'fields' => 'names' ) );
$related_ids        = wc_get_related_products( $product_id, 3 );
$attribute_label    = '';

if ( ! empty( $categories ) ) {
	$attribute_label = $categories[0];
}

if ( ! empty( $color_names ) ) {
	$attribute_label .= $attribute_label ? ' — ' . $color_names[0] : $color_names[0];
}

$accordion_sections = array_filter(
	array(
		array(
			'title'   => __( 'Description', 'djs' ),
			'content' => $description_markup,
		),
		array(
			'title'   => __( 'Taille & coupes', 'djs' ),
			'content' => $size_fit_content,
		),
		array(
			'title'   => __( 'Composition & guide d’entretien', 'djs' ),
			'content' => $care_content,
		),
		array(
			'title'   => __( 'Responsabilité', 'djs' ),
			'content' => $responsibility,
		),
		array(
			'title'   => __( 'Livraisons et retours', 'djs' ),
			'content' => $delivery_returns,
		),
	),
	static function ( $section ) {
		return ! empty( $section['content'] );
	}
);
?>

<?php do_action( 'woocommerce_before_single_product' ); ?>

<?php if ( post_password_required() ) : ?>
	<?php echo get_the_password_form(); ?>
	<?php return; ?>
<?php endif; ?>

<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'djs-single-product', $product ); ?>>
	<div class="djs-single-product__hero">
		<div class="djs-single-product__gallery">
			<?php if ( ! empty( $attachment_ids ) ) : ?>
				<?php foreach ( $attachment_ids as $attachment_id ) : ?>
					<div class="djs-single-product__media">
						<?php
						echo wp_get_attachment_image(
							$attachment_id,
							'full',
							false,
							array(
								'class' => 'djs-single-product__image',
								'alt'   => esc_attr( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ?: $product->get_name() ),
							)
						);
						?>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="djs-single-product__media djs-single-product__media--placeholder">
					<?php echo wc_placeholder_img( 'full' ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="djs-single-product__summary">
			<div class="djs-single-product__summary-inner">
				<a class="djs-single-product__back-link" href="<?php echo esc_url( $shop_page_url ); ?>">
					<?php esc_html_e( '← Retour', 'djs' ); ?>
				</a>

				<header class="djs-single-product__header">
					<h1 class="djs-single-product__title"><?php the_title(); ?></h1>

					<?php if ( $attribute_label ) : ?>
						<div class="djs-single-product__meta-line"><?php echo esc_html( $attribute_label ); ?></div>
					<?php endif; ?>

					<div class="djs-single-product__price-wrap">
						<div class="djs-single-product__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>

						<?php if ( $price_suffix ) : ?>
							<div class="djs-single-product__tax-note"><?php echo wp_kses_post( $price_suffix ); ?></div>
						<?php endif; ?>
					</div>

					<?php if ( $badge_text ) : ?>
						<div class="djs-single-product__badge"><?php echo esc_html( $badge_text ); ?></div>
					<?php endif; ?>
				</header>

				<div class="djs-single-product__purchase">
					<?php if ( ! empty( $color_names ) ) : ?>
						<div class="djs-single-product__detail-row">
							<span class="djs-single-product__detail-label"><?php esc_html_e( 'Couleur', 'djs' ); ?></span>
							<span class="djs-single-product__detail-value"><?php echo esc_html( $color_names[0] ); ?></span>
						</div>
					<?php endif; ?>

					<div class="djs-single-product__add-to-cart">
						<?php if ( $product->is_type( 'variable' ) && $size_guide_url ) : ?>
							<div class="djs-single-product__aux-link-row">
								<span class="djs-single-product__detail-label"><?php esc_html_e( 'Taille', 'djs' ); ?></span>
								<a href="<?php echo esc_url( $size_guide_url ); ?>" class="djs-single-product__aux-link">
									<?php esc_html_e( 'Guide des tailles', 'djs' ); ?>
								</a>
							</div>
						<?php endif; ?>

						<?php woocommerce_template_single_add_to_cart(); ?>

						<?php if ( $find_my_size_url ) : ?>
							<a href="<?php echo esc_url( $find_my_size_url ); ?>" class="djs-single-product__find-size-link">
								<?php esc_html_e( 'Trouver ma taille', 'djs' ); ?>
							</a>
						<?php endif; ?>

						<?php echo djs_get_wishlist_button_html( get_the_ID(), 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>

				<?php if ( ! empty( $accordion_sections ) ) : ?>
					<div class="djs-single-product__accordions">
						<?php foreach ( $accordion_sections as $index => $section ) : ?>
							<details class="djs-product-accordion" <?php echo 0 === $index ? 'open' : ''; ?>>
								<summary class="djs-product-accordion__summary">
									<span><?php echo esc_html( $section['title'] ); ?></span>
								</summary>

								<div class="djs-product-accordion__content">
									<?php echo wp_kses_post( wpautop( $section['content'] ) ); ?>
								</div>
							</details>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ( ! empty( $related_ids ) ) : ?>
		<section class="djs-related-products">
			<div class="djs-container">
				<div class="djs-related-products__head">
					<h2 class="djs-related-products__title"><?php esc_html_e( 'Vous aimerez aussi', 'djs' ); ?></h2>
					<a href="<?php echo esc_url( $shop_page_url ); ?>" class="djs-related-products__link">
						<?php esc_html_e( 'Voir plus', 'djs' ); ?>
					</a>
				</div>

				<?php
				$related_query = new WP_Query(
					array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'post__in'       => $related_ids,
						'orderby'        => 'post__in',
						'posts_per_page' => 3,
					)
				);
				?>

				<?php if ( $related_query->have_posts() ) : ?>
					<?php woocommerce_product_loop_start(); ?>
					<?php while ( $related_query->have_posts() ) : ?>
						<?php $related_query->the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
					<?php woocommerce_product_loop_end(); ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
</article>
