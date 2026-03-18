<?php
/**
 * My Account custom registration helpers.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Validate custom registration fields.
 *
 * @param WP_Error $errors Error object.
 * @param string   $username Username.
 * @param string   $email Email.
 *
 * @return WP_Error
 */
function djs_validate_account_registration_fields( $errors, $username, $email ) {
	if ( isset( $_POST['register'] ) ) {
		$first_name = isset( $_POST['first_name'] ) ? trim( wp_unslash( $_POST['first_name'] ) ) : '';
		$last_name  = isset( $_POST['last_name'] ) ? trim( wp_unslash( $_POST['last_name'] ) ) : '';

		if ( '' === $first_name ) {
			$errors->add( 'first_name_error', __( 'Le prénom est requis.', 'djs' ) );
		}

		if ( '' === $last_name ) {
			$errors->add( 'last_name_error', __( 'Le nom est requis.', 'djs' ) );
		}
	}

	return $errors;
}
add_filter( 'woocommerce_registration_errors', 'djs_validate_account_registration_fields', 10, 3 );

/**
 * Save custom registration fields.
 *
 * @param int $customer_id Customer ID.
 */
function djs_save_account_registration_fields( $customer_id ) {
	if ( isset( $_POST['first_name'] ) ) {
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) );
	}

	if ( isset( $_POST['last_name'] ) ) {
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) );
	}
}
add_action( 'woocommerce_created_customer', 'djs_save_account_registration_fields' );
