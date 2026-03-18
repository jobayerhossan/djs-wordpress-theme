<?php
/**
 * Template Name: Homepage
 */

get_header();

$djs_home_defaults = array(
	'hero_image_url'           => 'http://localhost/djs/wp-content/uploads/2026/03/img.jpg',
	'hero_image_alt'           => 'Collection Automne 2026',
	'hero_subtitle'            => 'L’ÉLÉGANCE À L’ÉTAT PUR',
	'hero_title'               => "Collection\nAutomne 2026",
	'hero_button_text'         => 'Découvrir',
	'hero_button_url'          => '',
	'announcement_items'       => "SAVOIR-FAIRE FRANÇAIS\nLIVRAISON OFFERTE\nNOUVELLE COLLECTION 2026\nNOUVEAU · MANTEAUX\nROBES · EXCLUSIVITÉ\nSAVOIR-FAIRE FRANÇAIS\nLIVRAISON OFFERTE",
	'featured_eyebrow'         => 'Sélection',
	'featured_title'           => 'Pièces du Moment',
	'featured_link_text'       => 'Voir tout',
	'featured_count'           => 3,
	'editorial_1_image_url'    => home_url( '/wp-content/uploads/2026/03/fc53a79eff1e78598212c14120fa88259d5b4eb6.png' ),
	'editorial_1_image_alt'    => 'Collection Femme',
	'editorial_1_eyebrow'      => 'Femme',
	'editorial_1_title'        => 'Collection Femme',
	'editorial_1_link_text'    => 'Découvrir',
	'editorial_1_link_url'     => '',
	'editorial_2_image_url'    => home_url( '/wp-content/uploads/2026/03/952016c40c4b36b78da1b11fda4760759779c23c.jpg' ),
	'editorial_2_image_alt'    => 'Notre Histoire',
	'editorial_2_eyebrow'      => 'Savoir-faire',
	'editorial_2_title'        => 'Notre Histoire',
	'editorial_2_link_text'    => 'En savoir plus',
	'editorial_2_link_url'     => '',
	'vision_eyebrow'           => 'Notre Vision',
	'vision_quote'             => "\"La mode n'est pas seulement ce que vous portez —\nc'est la façon dont vous vous sentez, ce que vous\nexprimez, ce que vous devenez.\"",
	'vision_meta'              => '— DJS PARIS, DEPUIS 1998',
	'campaign_image_url'       => home_url( '/wp-content/uploads/2026/03/bc01deb1da2f90e87e6787ce6f43626a477fdf80.png' ),
	'campaign_image_alt'       => 'La Nouvelle Saison',
	'campaign_eyebrow'         => 'Lookbook AH 2026',
	'campaign_title'           => "La Nouvelle\nSaison",
	'campaign_button_text'     => 'Explorer la collection',
	'campaign_button_url'      => '',
	'value_1_icon'             => '◈',
	'value_1_title'            => 'Savoir-faire Artisanal',
	'value_1_text'             => 'Chaque pièce est confectionnée dans nos ateliers parisiens avec une attention particulière au détail.',
	'value_2_icon'             => '◇',
	'value_2_title'            => 'Matières Nobles',
	'value_2_text'             => 'Nous sélectionnons uniquement les matières les plus naturelles — cachemire, soie, lin et laine mérinos.',
	'value_3_icon'             => '◎',
	'value_3_title'            => 'Mode Responsable',
	'value_3_text'             => 'Nos créations sont pensées pour durer. Nous privilégions la qualité à la quantité.',
	'value_4_icon'             => '◉',
	'value_4_title'            => 'Livraison Offerte',
	'value_4_text'             => "Livraison express offerte dès 200€ d'achat. Retours gratuits sous 30 jours.",
);

$djs_home_get_field = static function ( $name ) use ( $djs_home_defaults ) {
	$field_key = 'djs_home_' . $name;
	$value     = function_exists( 'get_field' ) ? get_field( $field_key ) : null;

	if ( null === $value || '' === $value ) {
		return $djs_home_defaults[ $name ];
	}

	return $value;
};

$djs_home_get_image = static function ( $name ) use ( $djs_home_get_field ) {
	$image = $djs_home_get_field( $name . '_image' );

	if ( is_array( $image ) && ! empty( $image['url'] ) ) {
		return array(
			'url' => $image['url'],
			'alt' => ! empty( $image['alt'] ) ? $image['alt'] : $djs_home_get_field( $name . '_image_alt' ),
		);
	}

	return array(
		'url' => $djs_home_get_field( $name . '_image_url' ),
		'alt' => $djs_home_get_field( $name . '_image_alt' ),
	);
};

$announcement_items = array_filter(
	array_map(
		'trim',
		preg_split( '/\r\n|\r|\n/', (string) $djs_home_get_field( 'announcement_items' ) )
	)
);

$hero_image        = $djs_home_get_image( 'hero' );
$editorial_image_1 = $djs_home_get_image( 'editorial_1' );
$editorial_image_2 = $djs_home_get_image( 'editorial_2' );
$campaign_image    = $djs_home_get_image( 'campaign' );

$homepage_values = array(
	array(
		'icon'  => $djs_home_get_field( 'value_1_icon' ),
		'title' => $djs_home_get_field( 'value_1_title' ),
		'text'  => $djs_home_get_field( 'value_1_text' ),
	),
	array(
		'icon'  => $djs_home_get_field( 'value_2_icon' ),
		'title' => $djs_home_get_field( 'value_2_title' ),
		'text'  => $djs_home_get_field( 'value_2_text' ),
	),
	array(
		'icon'  => $djs_home_get_field( 'value_3_icon' ),
		'title' => $djs_home_get_field( 'value_3_title' ),
		'text'  => $djs_home_get_field( 'value_3_text' ),
	),
	array(
		'icon'  => $djs_home_get_field( 'value_4_icon' ),
		'title' => $djs_home_get_field( 'value_4_title' ),
		'text'  => $djs_home_get_field( 'value_4_text' ),
	),
);
?>

<section class="home-hero">
	<div class="home-hero-bg">
		<img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ); ?>">
	</div>

	<div class="home-hero-overlay"></div>

	<div class="djs-container">
		<div class="home-hero-content">
			<div class="home-hero-inner">
				<div class="home-hero-subtitle"><?php echo esc_html( $djs_home_get_field( 'hero_subtitle' ) ); ?></div>

				<h1 class="home-hero-title"><?php echo nl2br( esc_html( $djs_home_get_field( 'hero_title' ) ) ); ?></h1>

				<a href="<?php echo esc_url( $djs_home_get_field( 'hero_button_url' ) ?: '#' ); ?>" class="home-hero-btn">
					<span><?php echo esc_html( $djs_home_get_field( 'hero_button_text' ) ); ?></span>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ArrowRight.svg' ); ?>" alt="Arrow">
				</a>
			</div>
		</div>
	</div>
</section>

<section class="home-announcement-bar">
	<div class="swiper home-announcement-slider">
		<div class="swiper-wrapper">
			<?php for ( $i = 0; $i < 2; $i++ ) : ?>
				<?php foreach ( $announcement_items as $announcement_item ) : ?>
					<div class="swiper-slide"><?php echo esc_html( $announcement_item ); ?></div>
				<?php endforeach; ?>
			<?php endfor; ?>
		</div>
	</div>
</section>


<section class="home-featured-products">
	<div class="djs-container">
		<div class="home-featured-products__head">
			<div class="home-featured-products__head-left">
				<div class="home-featured-products__eyebrow"><?php echo esc_html( $djs_home_get_field( 'featured_eyebrow' ) ); ?></div>
				<h2 class="home-featured-products__title"><?php echo esc_html( $djs_home_get_field( 'featured_title' ) ); ?></h2>
			</div>

			<div class="home-featured-products__head-right">
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="home-featured-products__all">
					<span><?php echo esc_html( $djs_home_get_field( 'featured_link_text' ) ); ?></span>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ArrowRight.svg' ); ?>" alt="Arrow">
				</a>
			</div>
		</div>

		<div class="home-featured-products__grid">
			<?php
				$featured_products = new WP_Query(
					array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => absint( $djs_home_get_field( 'featured_count' ) ),
						'orderby'        => 'date',
						'order'          => 'DESC',
					)
			);

			if ( $featured_products->have_posts() ) :
				woocommerce_product_loop_start();

				while ( $featured_products->have_posts() ) :
					$featured_products->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;

				woocommerce_product_loop_end();
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</section>



<section class="home-editorial-grid">
	<div class="djs-container">
		<div class="home-editorial-grid__wrap">

			<a href="<?php echo esc_url( $djs_home_get_field( 'editorial_1_link_url' ) ?: '#' ); ?>" class="home-editorial-card">
				<div class="home-editorial-card__image">
					<img src="<?php echo esc_url( $editorial_image_1['url'] ); ?>" alt="<?php echo esc_attr( $editorial_image_1['alt'] ); ?>">
				</div>
				<div class="home-editorial-card__content">
					<div class="home-editorial-card__eyebrow"><?php echo esc_html( $djs_home_get_field( 'editorial_1_eyebrow' ) ); ?></div>
					<h3 class="home-editorial-card__title"><?php echo esc_html( $djs_home_get_field( 'editorial_1_title' ) ); ?></h3>
					<span class="home-editorial-card__link">
						<span><?php echo esc_html( $djs_home_get_field( 'editorial_1_link_text' ) ); ?></span>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ArrowRight.svg' ); ?>" alt="Arrow">
					</span>
				</div>
			</a>

			<a href="<?php echo esc_url( $djs_home_get_field( 'editorial_2_link_url' ) ?: '#' ); ?>" class="home-editorial-card">
				<div class="home-editorial-card__image">
					<img src="<?php echo esc_url( $editorial_image_2['url'] ); ?>" alt="<?php echo esc_attr( $editorial_image_2['alt'] ); ?>">
				</div>
				<div class="home-editorial-card__content">
					<div class="home-editorial-card__eyebrow"><?php echo esc_html( $djs_home_get_field( 'editorial_2_eyebrow' ) ); ?></div>
					<h3 class="home-editorial-card__title"><?php echo esc_html( $djs_home_get_field( 'editorial_2_title' ) ); ?></h3>
					<span class="home-editorial-card__link">
						<span><?php echo esc_html( $djs_home_get_field( 'editorial_2_link_text' ) ); ?></span>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ArrowRight.svg' ); ?>" alt="Arrow">
					</span>
				</div>
			</a>

		</div>
	</div>
</section>



<section class="home-vision">
	<div class="djs-container">
		<div class="home-vision__inner">
			<div class="home-vision__eyebrow"><?php echo esc_html( $djs_home_get_field( 'vision_eyebrow' ) ); ?></div>

			<h2 class="home-vision__quote">
				<?php echo nl2br( esc_html( $djs_home_get_field( 'vision_quote' ) ) ); ?>
			</h2>

			<div class="home-vision__meta"><?php echo esc_html( $djs_home_get_field( 'vision_meta' ) ); ?></div>
		</div>
	</div>
</section>

<section class="home-campaign-banner">
	<div class="home-campaign-banner__image">
		<img src="<?php echo esc_url( $campaign_image['url'] ); ?>" alt="<?php echo esc_attr( $campaign_image['alt'] ); ?>">
	</div>

	<div class="home-campaign-banner__overlay"></div>

	<div class="home-campaign-banner__content">
		<div class="home-campaign-banner__eyebrow"><?php echo esc_html( $djs_home_get_field( 'campaign_eyebrow' ) ); ?></div>

		<h2 class="home-campaign-banner__title">
			<?php echo nl2br( esc_html( $djs_home_get_field( 'campaign_title' ) ) ); ?>
		</h2>

		<a href="<?php echo esc_url( $djs_home_get_field( 'campaign_button_url' ) ?: '#' ); ?>" class="home-campaign-banner__btn"><?php echo esc_html( $djs_home_get_field( 'campaign_button_text' ) ); ?></a>
	</div>
</section>

<section class="home-values">
	<div class="djs-container">
		<div class="home-values__grid">
			<?php foreach ( $homepage_values as $homepage_value ) : ?>
				<div class="home-values__item">
					<div class="home-values__icon"><?php echo esc_html( $homepage_value['icon'] ); ?></div>
					<h3 class="home-values__title"><?php echo esc_html( $homepage_value['title'] ); ?></h3>
					<p class="home-values__text">
						<?php echo esc_html( $homepage_value['text'] ); ?>
					</p>
				</div>
			<?php endforeach; ?>

		</div>
	</div>
</section>

<?php
get_footer();
