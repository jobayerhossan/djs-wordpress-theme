<?php
$djs_footer_newsletter_title       = djs_get_theme_text( 'footer_newsletter_title', 'Rejoignez la communauté DJS' );
$djs_footer_newsletter_text        = djs_get_theme_text( 'footer_newsletter_text', 'Nouvelles collections et événements exclusifs.' );
$djs_footer_newsletter_placeholder = djs_get_theme_text( 'footer_newsletter_placeholder', 'Votre adresse e-mail' );
$djs_footer_newsletter_button      = djs_get_theme_text( 'footer_newsletter_button', 'S’INSCRIRE' );
$djs_footer_description            = djs_get_theme_text( 'footer_description', 'Mode de luxe française, créée avec passion et savoir-faire artisanal depuis Paris.' );
$djs_footer_nav_title              = djs_get_theme_text( 'footer_nav_title', 'Boutique' );
$djs_footer_service_title          = djs_get_theme_text( 'footer_service_title', 'Service Client' );
$djs_footer_store_title            = djs_get_theme_text( 'footer_store_title', 'Boutique Paris' );
$djs_footer_address                = djs_get_theme_text( 'footer_address', "12 Rue du Faubourg Saint-Honoré\n75008 Paris, France" );
$djs_footer_hours                  = djs_get_theme_text( 'footer_hours', "Lun — Sam : 10h — 19h\nDimanche : 11h — 18h" );
$djs_footer_contact                = djs_get_theme_text( 'footer_contact', "contact@djs-paris.com\n+33 1 42 00 00 00" );
$djs_footer_copy_template          = djs_get_theme_text( 'footer_copy', '© {year} DJS Paris. Tous droits réservés - Designed by Refresh Services' );
$djs_footer_copy                   = str_replace( '{year}', gmdate( 'Y' ), $djs_footer_copy_template );
?>

<footer class="site-footer">

	<div class="footer-top">
		<div class="djs-container">
			<div class="footer-newsletter flex justify-between align-center">

				<div class="footer-newsletter-text">
					<h2><?php echo esc_html( $djs_footer_newsletter_title ); ?></h2>
					<p><?php echo esc_html( $djs_footer_newsletter_text ); ?></p>
				</div>

				<div class="footer-newsletter-form">
					<form class="newsletter-form" id="djs-newsletter-form" novalidate>
						<input
							type="email"
							name="email"
							id="djs-newsletter-email"
							placeholder="<?php echo esc_attr( $djs_footer_newsletter_placeholder ); ?>"
							required
							aria-describedby="djs-newsletter-status"
						>
						<button type="submit"><?php echo esc_html( $djs_footer_newsletter_button ); ?></button>
					</form>
					<p class="newsletter-form__status" id="djs-newsletter-status" aria-live="polite"></p>
				</div>

			</div>
		</div>
	</div>

	<div class="footer-main">
		<div class="djs-container">
			<div class="footer-grid">

				<!-- Logo + Text -->
				<div class="footer-col footer-about">
					<div class="footer-logo">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php endif; ?>
					</div>

					<p class="footer-desc">
						<?php echo esc_html( $djs_footer_description ); ?>
					</p>

					<div class="footer-social flex gap-16">
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Instagram.svg" alt=""></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Facebook.svg" alt=""></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Youtube.svg" alt=""></a>
					</div>
				</div>

				<!-- Navigation -->
				<div class="footer-col">
					<h4 class="footer-title"><?php echo esc_html( $djs_footer_nav_title ); ?></h4>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer_menu',
						'container' => false,
						'menu_class' => 'footer-menu',
					));
					?>
				</div>

				<!-- Service Client -->
				<div class="footer-col">
					<h4 class="footer-title"><?php echo esc_html( $djs_footer_service_title ); ?></h4>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer_service',
						'container' => false,
						'menu_class' => 'footer-menu',
					));
					?>
				</div>

				<!-- Contact -->
				<div class="footer-col">
					<h4 class="footer-title"><?php echo esc_html( $djs_footer_store_title ); ?></h4>

					<p><?php echo nl2br( esc_html( $djs_footer_address ) ); ?></p>

					<p><?php echo nl2br( esc_html( $djs_footer_hours ) ); ?></p>

					<p><?php echo nl2br( esc_html( $djs_footer_contact ) ); ?></p>
				</div>

			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="djs-container flex justify-between align-center">

			<p class="footer-copy">
				<?php echo wp_kses_post( $djs_footer_copy ); ?>
			</p>

			<div class="footer-legal">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer_legal',
					'container' => false,
					'menu_class' => 'footer-legal-menu flex gap-24',
				));
				?>
			</div>

		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
