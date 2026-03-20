<?php
/**
 * Footer newsletter AJAX handler.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle AJAX newsletter submissions.
 */
function djs_handle_footer_newsletter_submission() {
	check_ajax_referer( 'djs_ajax_nonce', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

	if ( '' === $email ) {
		wp_send_json_error(
			array(
				'message' => __( 'Veuillez saisir votre adresse e-mail.', 'djs' ),
			),
			400
		);
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error(
			array(
				'message' => __( 'Veuillez saisir une adresse e-mail valide.', 'djs' ),
			),
			400
		);
	}

	wp_send_json_success(
		array(
			'message' => __( 'Merci, votre inscription a bien ete prise en compte.', 'djs' ),
		)
	);
}
add_action( 'wp_ajax_djs_submit_footer_newsletter', 'djs_handle_footer_newsletter_submission' );
add_action( 'wp_ajax_nopriv_djs_submit_footer_newsletter', 'djs_handle_footer_newsletter_submission' );
