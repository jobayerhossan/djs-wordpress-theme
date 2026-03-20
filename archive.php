<?php
/**
 * Archive template.
 *
 * @package DJS
 */

get_header();

$djs_archive_empty_text = djs_get_theme_text( 'archive_empty_text', 'Aucun contenu disponible dans cette archive.' );
$djs_pagination_prev    = djs_get_theme_text( 'pagination_prev_text', 'Précédent' );
$djs_pagination_next    = djs_get_theme_text( 'pagination_next_text', 'Suivant' );
?>

<main class="djs-page-content djs-archive-page">
	<div class="djs-container">
		<header class="djs-page-header djs-archive-page__header">
			<h1 class="djs-page-title"><?php the_archive_title(); ?></h1>

			<?php if ( get_the_archive_description() ) : ?>
				<div class="djs-page-body djs-archive-page__description">
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
				</div>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="djs-blog-index__list djs-archive-page__list">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'djs-blog-card djs-archive-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="djs-blog-card__thumb" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'large' ); ?>
							</a>
						<?php endif; ?>

						<div class="djs-blog-card__content">
							<div class="djs-blog-card__meta">
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
			<div class="djs-blog-empty djs-archive-page__empty">
				<p><?php echo esc_html( $djs_archive_empty_text ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
