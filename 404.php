<?php
/**
 * 404 template.
 *
 * @package DJS
 */

get_header();

$djs_404_title      = djs_get_theme_text( '404_title', '404' );
$djs_404_message    = djs_get_theme_text( '404_message', 'La page que vous recherchez semble introuvable.' );
$djs_404_submessage = djs_get_theme_text( '404_submessage', 'Elle a peut-être été déplacée, supprimée ou son adresse est incorrecte.' );
$djs_404_button     = djs_get_theme_text( '404_button_text', 'Retour à l’accueil' );
?>

<main class="djs-page-content djs-404-page">
	<div class="djs-container">
		<section class="djs-page-header djs-404-page__header">
			<h1 class="djs-page-title"><?php echo esc_html( $djs_404_title ); ?></h1>
			<p><?php echo esc_html( $djs_404_message ); ?></p>
		</section>

		<div class="djs-page-body djs-404-page__body">
			<p><?php echo esc_html( $djs_404_submessage ); ?></p>

			<p>
				<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php echo esc_html( $djs_404_button ); ?>
				</a>
			</p>
		</div>
	</div>
</main>

<?php
get_footer();
