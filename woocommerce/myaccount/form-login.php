<?php
/**
 * Custom My Account login/register form.
 *
 * @package DJS
 */

defined( 'ABSPATH' ) || exit;

$allow_registration = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
$active_tab         = ( isset( $_GET['register'] ) || isset( $_POST['register'] ) ) && $allow_registration ? 'register' : 'login';
?>

<div class="djs-account-auth">
	<div class="djs-container">
		<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

		<div class="djs-account-auth__inner" data-default-tab="<?php echo esc_attr( $active_tab ); ?>">
			<div class="djs-account-auth__tabs">
				<button
					type="button"
					class="djs-account-auth__tab <?php echo 'login' === $active_tab ? 'is-active' : ''; ?>"
					data-target="login"
				>
					<?php esc_html_e( 'Connexion', 'djs' ); ?>
				</button>

				<?php if ( $allow_registration ) : ?>
					<button
						type="button"
						class="djs-account-auth__tab <?php echo 'register' === $active_tab ? 'is-active' : ''; ?>"
						data-target="register"
					>
						<?php esc_html_e( 'Créer un compte', 'djs' ); ?>
					</button>
				<?php endif; ?>
			</div>

			<div class="djs-account-auth__panels">
				<div class="djs-account-panel <?php echo 'login' === $active_tab ? 'is-active' : ''; ?>" data-panel="login">
					<div class="djs-account-panel__head">
						<h2 class="djs-account-panel__title"><?php esc_html_e( 'Bienvenue', 'djs' ); ?></h2>
					</div>

					<form class="woocommerce-form woocommerce-form-login login" method="post">
						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="username"><?php esc_html_e( 'Adresse e-mail', 'djs' ); ?></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ! empty( $_POST['username'] ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
						</p>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide djs-account-field djs-account-field--password">
							<label for="password"><?php esc_html_e( 'Mot de passe', 'djs' ); ?></label>
							<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
							<button type="button" class="djs-account-password-toggle" aria-label="<?php esc_attr_e( 'Afficher le mot de passe', 'djs' ); ?>">
								<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" stroke="currentColor" stroke-width="1.4"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.4"/></svg>
							</button>
						</p>

						<?php do_action( 'woocommerce_login_form' ); ?>

						<p class="woocommerce-LostPassword lost_password">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Mot de passe oublié ?', 'djs' ); ?></a>
						</p>

						<p class="form-row">
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Se connecter', 'woocommerce' ); ?>">
								<?php esc_html_e( 'Se connecter', 'djs' ); ?>
							</button>
						</p>

						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</form>
				</div>

				<?php if ( $allow_registration ) : ?>
					<div class="djs-account-panel <?php echo 'register' === $active_tab ? 'is-active' : ''; ?>" data-panel="register">
						<div class="djs-account-panel__head">
							<h2 class="djs-account-panel__title"><?php esc_html_e( 'Rejoignez DJS Paris', 'djs' ); ?></h2>
						</div>

						<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
							<?php do_action( 'woocommerce_register_form_start' ); ?>

							<div class="djs-account-form-grid">
								<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
									<label for="reg_first_name"><?php esc_html_e( 'Prénom', 'djs' ); ?></label>
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" value="<?php echo ! empty( $_POST['first_name'] ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>" />
								</p>

								<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
									<label for="reg_last_name"><?php esc_html_e( 'Nom', 'djs' ); ?></label>
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="reg_last_name" value="<?php echo ! empty( $_POST['last_name'] ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>" />
								</p>
							</div>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_email"><?php esc_html_e( 'Adresse e-mail', 'djs' ); ?></label>
								<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ! empty( $_POST['email'] ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
							</p>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide djs-account-field djs-account-field--password">
									<label for="reg_password"><?php esc_html_e( 'Mot de passe', 'djs' ); ?></label>
									<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
									<button type="button" class="djs-account-password-toggle" aria-label="<?php esc_attr_e( 'Afficher le mot de passe', 'djs' ); ?>">
										<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" stroke="currentColor" stroke-width="1.4"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.4"/></svg>
									</button>
									<span class="djs-account-field__hint"><?php esc_html_e( 'Min. 8 caractères', 'djs' ); ?></span>
								</p>
							<?php else : ?>
								<p class="djs-account-generated-password-note">
									<?php esc_html_e( 'Un mot de passe vous sera envoyé par e-mail.', 'djs' ); ?>
								</p>
							<?php endif; ?>

							<label class="djs-account-checkbox">
								<input type="checkbox" name="djs_newsletter_optin" value="1">
								<span><?php esc_html_e( 'Je souhaite recevoir les nouveautés et offres exclusives de DJS Paris', 'djs' ); ?></span>
							</label>

							<?php do_action( 'woocommerce_register_form' ); ?>

							<p class="woocommerce-form-row form-row">
								<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
								<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Créer mon compte', 'djs' ); ?>">
									<?php esc_html_e( 'Créer mon compte', 'djs' ); ?>
								</button>
							</p>

							<p class="djs-account-legal-note">
								<?php esc_html_e( 'En créant un compte, vous acceptez nos Conditions Générales de Vente et notre Politique de Confidentialité.', 'djs' ); ?>
							</p>

							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
	</div>
</div>
