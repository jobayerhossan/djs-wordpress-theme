<?php
/**
 * Template Name: Homepage
 */

get_header();
?>

<section class="home-hero">
	<div class="home-hero-bg">
		<img src="http://localhost/djs/wp-content/uploads/2026/03/img.jpg" alt="Collection Automne 2026">
	</div>

	<div class="home-hero-overlay"></div>

	<div class="djs-container">
		<div class="home-hero-content">
			<div class="home-hero-inner">
				<div class="home-hero-subtitle">L’ÉLÉGANCE À L’ÉTAT PUR</div>

				<h1 class="home-hero-title">Collection<br>Automne 2026</h1>

				<a href="#" class="home-hero-btn">
					<span>Découvrir</span>
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
				<div class="swiper-slide">SAVOIR-FAIRE FRANÇAIS</div>
				<div class="swiper-slide">LIVRAISON OFFERTE</div>
				<div class="swiper-slide">NOUVELLE COLLECTION 2026</div>
				<div class="swiper-slide">NOUVEAU · MANTEAUX</div>
				<div class="swiper-slide">ROBES · EXCLUSIVITÉ</div>
				<div class="swiper-slide">SAVOIR-FAIRE FRANÇAIS</div>
				<div class="swiper-slide">LIVRAISON OFFERTE</div>
			<?php endfor; ?>
		</div>
	</div>
</section>


<section class="home-featured-products">
	<div class="djs-container">
		<div class="home-featured-products__head">
			<div class="home-featured-products__head-left">
				<div class="home-featured-products__eyebrow">Sélection</div>
				<h2 class="home-featured-products__title">Pièces du Moment</h2>
			</div>

			<div class="home-featured-products__head-right">
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="home-featured-products__all">
					<span>Voir tout</span>
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
					'posts_per_page' => 3,
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

			<a href="#" class="home-editorial-card">
				<div class="home-editorial-card__image">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/fc53a79eff1e78598212c14120fa88259d5b4eb6.png' ) ); ?>" alt="Collection Femme">
				</div>
				<div class="home-editorial-card__content">
					<div class="home-editorial-card__eyebrow">Femme</div>
					<h3 class="home-editorial-card__title">Collection Femme</h3>
					<span class="home-editorial-card__link">
						<span>Découvrir</span>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ArrowRight.svg' ); ?>" alt="Arrow">
					</span>
				</div>
			</a>

			<a href="#" class="home-editorial-card">
				<div class="home-editorial-card__image">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/952016c40c4b36b78da1b11fda4760759779c23c.jpg' ) ); ?>" alt="Notre Histoire">
				</div>
				<div class="home-editorial-card__content">
					<div class="home-editorial-card__eyebrow">Savoir-faire</div>
					<h3 class="home-editorial-card__title">Notre Histoire</h3>
					<span class="home-editorial-card__link">
						<span>En savoir plus</span>
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
			<div class="home-vision__eyebrow">Notre Vision</div>

			<h2 class="home-vision__quote">
				"La mode n'est pas seulement ce que vous portez —<br>
				c'est la façon dont vous vous sentez, ce que vous<br>
				exprimez, ce que vous devenez."
			</h2>

			<div class="home-vision__meta">— DJS PARIS, DEPUIS 1998</div>
		</div>
	</div>
</section>

<section class="home-campaign-banner">
	<div class="home-campaign-banner__image">
		<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/bc01deb1da2f90e87e6787ce6f43626a477fdf80.png' ) ); ?>" alt="La Nouvelle Saison">
	</div>

	<div class="home-campaign-banner__overlay"></div>

	<div class="home-campaign-banner__content">
		<div class="home-campaign-banner__eyebrow">Lookbook AH 2026</div>

		<h2 class="home-campaign-banner__title">
			La Nouvelle<br>Saison
		</h2>

		<a href="#" class="home-campaign-banner__btn">Explorer la collection</a>
	</div>
</section>

<section class="home-values">
	<div class="djs-container">
		<div class="home-values__grid">

			<div class="home-values__item">
				<div class="home-values__icon">◈</div>
				<h3 class="home-values__title">Savoir-faire Artisanal</h3>
				<p class="home-values__text">
					Chaque pièce est confectionnée dans nos ateliers parisiens avec une attention particulière au détail.
				</p>
			</div>

			<div class="home-values__item">
				<div class="home-values__icon">◇</div>
				<h3 class="home-values__title">Matières Nobles</h3>
				<p class="home-values__text">
					Nous sélectionnons uniquement les matières les plus naturelles — cachemire, soie, lin et laine mérinos.
				</p>
			</div>

			<div class="home-values__item">
				<div class="home-values__icon">◎</div>
				<h3 class="home-values__title">Mode Responsable</h3>
				<p class="home-values__text">
					Nos créations sont pensées pour durer. Nous privilégions la qualité à la quantité.
				</p>
			</div>

			<div class="home-values__item">
				<div class="home-values__icon">◉</div>
				<h3 class="home-values__title">Livraison Offerte</h3>
				<p class="home-values__text">
					Livraison express offerte dès 200€ d'achat. Retours gratuits sous 30 jours.
				</p>
			</div>

		</div>
	</div>
</section>

<?php
get_footer();