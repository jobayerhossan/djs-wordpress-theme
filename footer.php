<footer class="site-footer">

	<div class="footer-top">
		<div class="djs-container">
			<div class="footer-newsletter flex justify-between align-center">

				<div class="footer-newsletter-text">
					<h2>Rejoignez la communauté DJS</h2>
					<p>Nouvelles collections et événements exclusifs.</p>
				</div>

				<div class="footer-newsletter-form">
					<form class="newsletter-form">
						<input type="email" name="email" placeholder="Votre adresse e-mail" required>
						<button type="submit">S’INSCRIRE</button>
					</form>
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
						Mode de luxe française, créée avec passion et savoir-faire artisanal depuis Paris.
					</p>

					<div class="footer-social flex gap-16">
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Instagram.svg" alt=""></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Facebook.svg" alt=""></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Youtube.svg" alt=""></a>
					</div>
				</div>

				<!-- Navigation -->
				<div class="footer-col">
					<h4 class="footer-title">Boutique</h4>
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
					<h4 class="footer-title">Service Client</h4>
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
					<h4 class="footer-title">Boutique Paris</h4>

					<p>
						12 Rue du Faubourg Saint-Honoré<br>
						75008 Paris, France
					</p>

					<p>
						Lun — Sam : 10h — 19h<br>
						Dimanche : 11h — 18h
					</p>

					<p>
						contact@djs-paris.com<br>
						+33 1 42 00 00 00
					</p>
				</div>

			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="djs-container flex justify-between align-center">

			<p class="footer-copy">
				© <?php echo date('Y'); ?> DJS Paris. Tous droits réservés - Designed by Refresh Services
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
