<?php
/**
 * Basic page template.
 *
 * @package DJS
 */

get_header();
?>

<main class="djs-page-content">
	<div class="djs-container">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'djs-page-article' ); ?>>
				<?php if ( ! is_front_page() && djs_should_show_page_header( get_the_ID() ) ) : ?>
					<header class="djs-page-header">
						<h1 class="djs-page-title"><?php the_title(); ?></h1>
					</header>
				<?php endif; ?>

				<div class="djs-page-body">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
