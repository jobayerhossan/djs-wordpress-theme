<?php
/**
 * Standard single post template.
 *
 * @package DJS
 */

get_header();
?>

<main class="djs-page-content djs-single-post">
	<div class="djs-container">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'djs-single-post__article' ); ?>>
				<header class="djs-page-header djs-single-post__header">
					<div class="djs-single-post__meta">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
					</div>

					<h1 class="djs-page-title djs-single-post__title"><?php the_title(); ?></h1>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="djs-single-post__thumb">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="djs-page-body djs-single-post__content">
					<?php the_content(); ?>
				</div>
			</article>

			<nav class="djs-single-post__nav" aria-label="<?php esc_attr_e( 'Post navigation', 'djs' ); ?>">
				<div class="djs-single-post__nav-prev">
					<?php previous_post_link( '%link', esc_html__( 'Article précédent', 'djs' ) ); ?>
				</div>
				<div class="djs-single-post__nav-next">
					<?php next_post_link( '%link', esc_html__( 'Article suivant', 'djs' ) ); ?>
				</div>
			</nav>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
