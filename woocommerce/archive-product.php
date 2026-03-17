<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );?>


<?php
$current_term     = get_queried_object();
$current_term_id  = ( isset( $current_term->term_id ) ) ? (int) $current_term->term_id : 0;
$current_taxonomy = ( isset( $current_term->taxonomy ) ) ? $current_term->taxonomy : '';
?>

<?php if ( is_product_category() && $current_term_id ) : ?>
	<?php
	$thumbnail_id = get_term_meta( $current_term_id, 'thumbnail_id', true );
	$banner_image = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'full' ) : '';
	$term_title   = single_term_title( '', false );
	$term_desc    = term_description( $current_term_id, 'product_cat' );
	?>

	<section class="djs-category-hero <?php if ( !$banner_image ){echo 'no_cat_image';} ?>">
		<?php if ( $banner_image ) : ?>
			<div class="djs-category-hero__bg">
				<img src="<?php echo esc_url( $banner_image ); ?>" alt="<?php echo esc_attr( $term_title ); ?>">
			</div>
		<?php endif; ?>

		<div class="djs-category-hero__overlay"></div>

		<div class="djs-container">
			<div class="djs-category-hero__content">
				<?php if ( ! empty( $term_desc ) ) : ?>
					<div class="djs-category-hero__eyebrow">
						<?php echo wp_kses_post( wp_strip_all_tags( $term_desc ) ); ?>
					</div>
				<?php endif; ?>

				<h1 class="djs-category-hero__title">
					<?php echo esc_html( $term_title ); ?>
				</h1>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php 


$current_term     = get_queried_object();
$current_term_id  = ( isset( $current_term->term_id ) ) ? (int) $current_term->term_id : 0;
$current_taxonomy = ( isset( $current_term->taxonomy ) ) ? $current_term->taxonomy : '';

$product_cats = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'parent'     => 0,
	)
);

$genre_terms = get_terms(
	array(
		'taxonomy'   => 'pa_genre',
		'hide_empty' => true,
	)
);

$color_terms = get_terms(
	array(
		'taxonomy'   => 'pa_couleurs',
		'hide_empty' => true,
	)
);

$size_terms = get_terms(
	array(
		'taxonomy'   => 'pa_taille',
		'hide_empty' => true,
	)
);

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
?>

<div class="djs-shop-page"
	data-shop-url="<?php echo esc_url( $shop_page_url ); ?>"
	data-current-term-id="<?php echo esc_attr( $current_term_id ); ?>"
	data-current-taxonomy="<?php echo esc_attr( $current_taxonomy ); ?>"
	data-search-term="<?php echo esc_attr( get_search_query() ); ?>">

	<div class="djs-shop-toolbar">
		<div class="djs-container">
			<div class="djs-shop-toolbar__inner">

				<div class="djs-shop-toolbar__left">
					<button class="djs-filter-toggle" type="button">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/SlidersHorizontal.svg' ); ?>" alt="">
						<span>Filtrer</span>
					</button>

					<div class="djs-shop-tabs">
						<a href="<?php echo esc_url( $shop_page_url ); ?>" class="djs-shop-tab djs-shop-tab-all active" data-genre="">Tout</a>

						<?php
						$femme = get_term_by( 'slug', 'femme', 'pa_genre' );
						$homme = get_term_by( 'slug', 'homme', 'pa_genre' );
						?>

						<?php if ( $femme ) : ?>
							<a href="<?php echo esc_url( get_term_link( $femme ) ); ?>" class="djs-shop-tab" data-genre="femme">Femme</a>
						<?php endif; ?>

						<?php if ( $homme ) : ?>
							<a href="<?php echo esc_url( get_term_link( $homme ) ); ?>" class="djs-shop-tab" data-genre="homme">Homme</a>
						<?php endif; ?>
					</div>

					<div class="djs-active-filters"></div>
				</div>

				<div class="djs-shop-toolbar__right">
					<div class="djs-shop-count">
						<span class="djs-found-count"><?php echo esc_html( $GLOBALS['wp_query']->found_posts ); ?></span> pièce<?php echo ( intval( $GLOBALS['wp_query']->found_posts ) > 1 ) ? 's' : ''; ?>
					</div>

					<div class="djs-sort-wrap">
						<select id="djs-sort-select" class="djs-sort-select">
							<option value="menu_order">Pertinence</option>
							<option value="date">Nouveautés</option>
							<option value="price_asc">Prix croissant</option>
							<option value="price_desc">Prix décroissant</option>
						</select>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="djs-filter-drawer">
		<div class="djs-filter-drawer__overlay"></div>

		<div class="djs-filter-drawer__panel">
			<div class="djs-filter-drawer__header">
				<h3>Filtrer <span class="djs-filter-count">(0)</span></h3>
				<button type="button" class="djs-filter-close">Fermer <span>×</span></button>
			</div>

			<form id="djs-filter-form">

				<div class="djs-filter-group">
					<div class="djs-filter-group__head">
						<div class="djs-filter-group__title">Catégories</div>
					</div>

					<div class="djs-filter-options djs-filter-options--boxed">
						<?php foreach ( $product_cats as $term ) : ?>
							<label class="djs-chip-label">
								<input type="checkbox" name="categories[]" value="<?php echo esc_attr( $term->slug ); ?>">
								<span><?php echo esc_html( $term->name ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="djs-filter-group is-collapsed">
					<div class="djs-filter-group__head">
						<div class="djs-filter-group__title">Genre</div>
						<button type="button" class="djs-filter-collapse">+</button>
					</div>

					<div class="djs-filter-options djs-filter-options--genre">
						<?php foreach ( $genre_terms as $term ) : ?>
							<label class="djs-check-label">
								<input type="checkbox" name="genre[]" value="<?php echo esc_attr( $term->slug ); ?>">
								<span class="djs-check-ui"></span>
								<span class="djs-check-text"><?php echo esc_html( $term->name ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="djs-filter-group is-collapsed">
					<div class="djs-filter-group__head">
						<div class="djs-filter-group__title">Couleurs</div>
						<button type="button" class="djs-filter-collapse">+</button>
					</div>

					<div class="djs-filter-options djs-filter-options--boxed">
						<?php foreach ( $color_terms as $term ) : ?>
							<label class="djs-chip-label">
								<input type="checkbox" name="color[]" value="<?php echo esc_attr( $term->slug ); ?>">
								<span><?php echo esc_html( $term->name ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="djs-filter-group is-collapsed">
					<div class="djs-filter-group__head">
						<div class="djs-filter-group__title">Taille</div>
						<button type="button" class="djs-filter-collapse">+</button>
					</div>

					<div class="djs-filter-options djs-filter-options--boxed">
						<?php foreach ( $size_terms as $term ) : ?>
							<label class="djs-chip-label">
								<input type="checkbox" name="size[]" value="<?php echo esc_attr( $term->slug ); ?>">
								<span><?php echo esc_html( $term->name ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="djs-filter-actions">
					<button type="button" class="djs-filter-apply">
						Afficher <span class="djs-filter-found-count"><?php echo esc_html( $GLOBALS['wp_query']->found_posts ); ?></span> pièce<?php echo ( intval( $GLOBALS['wp_query']->found_posts ) > 1 ) ? 's' : ''; ?>
					</button>
					<button type="button" class="djs-filter-reset">Tout effacer</button>
				</div>

			</form>
		</div>
	</div>

	<div class="djs-shop-content">
		<div class="djs-products-grid-wrap">
			<?php if ( woocommerce_product_loop() ) : ?>
				<?php woocommerce_product_loop_start(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; ?>
				<?php woocommerce_product_loop_end(); ?>
			<?php else : ?>
				<div class="djs-no-products">
					<h2>Aucun résultat</h2>
					<p>Modifiez vos filtres pour afficher des produits.</p>
					<button class="btn btn-border djs-filter-reset">Effacer les filtres</button>
				</div>
			<?php endif; ?>
		</div>

		<div class="djs-pagination-wrap">
			<?php woocommerce_pagination(); ?>
		</div>
	</div>
</div>

<?php get_footer( 'shop' ); ?>