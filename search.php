<?php
/**
 * Search results template.
 *
 * @package DJS
 */

get_header();

$djs_search_results_prefix = djs_get_theme_text( 'search_results_prefix', 'Résultats pour :' );
$djs_search_empty_text     = djs_get_theme_text( 'search_empty_text', 'Aucun résultat ne correspond à votre recherche.' );
$djs_pagination_prev       = djs_get_theme_text( 'pagination_prev_text', 'Précédent' );
$djs_pagination_next       = djs_get_theme_text( 'pagination_next_text', 'Suivant' );
?>

<main class="djs-page-content djs-search-page">
	<div class="djs-container">
		<header class="djs-page-header djs-search-page__header">
			<h1 class="djs-page-title">
				<?php echo esc_html( $djs_search_results_prefix . ' ' . get_search_query() ); ?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="djs-blog-index__list djs-search-page__results">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'djs-blog-card djs-search-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="djs-blog-card__thumb" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'large' ); ?>
							</a>
						<?php endif; ?>

						<div class="djs-blog-card__content">
							<div class="djs-blog-card__meta">
								<span><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ?? get_post_type() ); ?></span>
								<span>·</span>
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
							</div>

							<h2 class="djs-blog-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<div class="djs-blog-card__excerpt">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="djs-blog-pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 1,
						'prev_text' => $djs_pagination_prev,
						'next_text' => $djs_pagination_next,
					)
				);
				?>
			</div>
		<?php else : ?>
			<div class="djs-blog-empty djs-search-page__empty">
				<p><?php echo esc_html( $djs_search_empty_text ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
