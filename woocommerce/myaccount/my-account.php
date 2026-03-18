<?php
/**
 * Custom My Account template wrapper.
 *
 * @package DJS
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="djs-account-page">
	<?php if ( ! is_user_logged_in() ) : ?>
		<?php wc_get_template( 'myaccount/form-login.php' ); ?>
	<?php else : ?>
		<div class="djs-container">
			<div class="djs-account-shell">
				<nav class="djs-account-shell__nav">
					<?php do_action( 'woocommerce_account_navigation' ); ?>
				</nav>

				<div class="djs-account-shell__content">
					<?php do_action( 'woocommerce_account_content' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>
