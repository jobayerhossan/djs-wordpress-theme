<?php
/**
 * Contact page Customizer options and AJAX mail handler.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings for the contact page.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function djs_register_contact_customizer_settings( $wp_customize ) {
	$wp_customize->add_section(
		'djs_contact_settings',
		array(
			'title'       => __( 'DJS Contact', 'djs' ),
			'priority'    => 160,
			'description' => __( 'Settings for the contact page form.', 'djs' ),
		)
	);

	$wp_customize->add_setting(
		'djs_contact_notification_email',
		array(
			'default'           => get_option( 'admin_email' ),
			'sanitize_callback' => 'sanitize_email',
		)
	);

	$wp_customize->add_control(
		'djs_contact_notification_email',
		array(
			'label'       => __( 'Notification email', 'djs' ),
			'description' => __( 'Messages from the contact form will be sent to this address.', 'djs' ),
			'section'     => 'djs_contact_settings',
			'type'        => 'email',
		)
	);
}
add_action( 'customize_register', 'djs_register_contact_customizer_settings' );

/**
 * Handle AJAX contact form submissions.
 */
function djs_handle_contact_form_submission() {
	check_ajax_referer( 'djs_ajax_nonce', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || '' === $email || '' === $subject || '' === $message ) {
		wp_send_json_error(
			array(
				'message' => __( 'Merci de remplir tous les champs obligatoires.', 'djs' ),
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

	$recipient = get_theme_mod( 'djs_contact_notification_email', get_option( 'admin_email' ) );
	$recipient = is_email( $recipient ) ? $recipient : get_option( 'admin_email' );

	$mail_subject = sprintf(
		/* translators: %s: contact subject */
		__( 'Nouveau message de contact : %s', 'djs' ),
		$subject
	);

	$mail_body = sprintf(
		"Nom : %s\nE-mail : %s\nSujet : %s\n\nMessage :\n%s",
		$name,
		$email,
		$subject,
		$message
	);

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	);

	$sent = wp_mail( $recipient, $mail_subject, $mail_body, $headers );

	if ( ! $sent ) {
		wp_send_json_error(
			array(
				'message' => __( 'Une erreur est survenue. Merci de réessayer dans quelques instants.', 'djs' ),
			),
			500
		);
	}

	wp_send_json_success(
		array(
			'message' => __( 'Votre message a bien été envoyé. Nous vous répondrons très bientôt.', 'djs' ),
		)
	);
}
add_action( 'wp_ajax_djs_submit_contact_form', 'djs_handle_contact_form_submission' );
add_action( 'wp_ajax_nopriv_djs_submit_contact_form', 'djs_handle_contact_form_submission' );
