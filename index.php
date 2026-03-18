<?php
/**
 * Blog index template.
 *
 * @package DJS
 */

get_header();
?>

<main class="djs-page-content djs-blog-index">
	<div class="djs-container">
		<header class="djs-page-header djs-blog-index__header">
			<h1 class="djs-page-title">
				<?php
				if ( is_home() && ! is_front_page() ) {
					single_post_title();
				} else {
					esc_html_e( 'Journal', 'djs' );
				}
				?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="djs-blog-index__list">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'djs-blog-card' ); ?>>
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

							<a class="djs-blog-card__link" href="<?php the_permalink(); ?>">
								<?php esc_html_e( 'Lire la suite', 'djs' ); ?>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="djs-blog-pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 1,
						'prev_text' => __( 'Précédent', 'djs' ),
						'next_text' => __( 'Suivant', 'djs' ),
					)
				);
				?>
			</div>
		<?php else : ?>
			<div class="djs-blog-empty">
				<p><?php esc_html_e( 'Aucun article n’a été publié pour le moment.', 'djs' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
