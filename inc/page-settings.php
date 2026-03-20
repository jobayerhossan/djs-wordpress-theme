<?php
/**
 * Default page editor settings.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the default page settings meta box.
 */
function djs_register_page_settings_meta_box() {
	add_meta_box(
		'djs-page-settings',
		__( 'DJS Page Settings', 'djs' ),
		'djs_render_page_settings_meta_box',
		'page',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'djs_register_page_settings_meta_box' );

/**
 * Render the default page settings meta box.
 *
 * @param WP_Post $post Current post object.
 */
function djs_render_page_settings_meta_box( $post ) {
	$template = get_page_template_slug( $post->ID );

	if ( '' !== $template && 'default' !== $template ) {
		echo '<p>' . esc_html__( 'This option applies to pages using the default page template.', 'djs' ) . '</p>';
		return;
	}

	wp_nonce_field( 'djs_save_page_settings', 'djs_page_settings_nonce' );

	$show_title = get_post_meta( $post->ID, '_djs_show_page_header', true );
	$show_title = '' === $show_title ? '1' : $show_title;
	?>
	<p>
		<label for="djs-show-page-header">
			<input
				type="checkbox"
				id="djs-show-page-header"
				name="djs_show_page_header"
				value="1"
				<?php checked( $show_title, '1' ); ?>
			>
			<?php esc_html_e( 'Show page title bar', 'djs' ); ?>
		</label>
	</p>
	<p class="howto">
		<?php esc_html_e( 'Enabled by default for pages using the default page template.', 'djs' ); ?>
	</p>
	<?php
}

/**
 * Save the default page settings meta box values.
 *
 * @param int $post_id Post ID.
 */
function djs_save_page_settings_meta_box( $post_id ) {
	if ( ! isset( $_POST['djs_page_settings_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['djs_page_settings_nonce'] ) ), 'djs_save_page_settings' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( 'page' !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	$template = get_page_template_slug( $post_id );

	if ( '' !== $template && 'default' !== $template ) {
		delete_post_meta( $post_id, '_djs_show_page_header' );
		return;
	}

	$show_title = isset( $_POST['djs_show_page_header'] ) ? '1' : '0';
	update_post_meta( $post_id, '_djs_show_page_header', $show_title );
}
add_action( 'save_post_page', 'djs_save_page_settings_meta_box' );

/**
 * Determine whether the current page should display the title bar.
 *
 * @param int $post_id Post ID.
 *
 * @return bool
 */
function djs_should_show_page_header( $post_id ) {
	$show_title = get_post_meta( $post_id, '_djs_show_page_header', true );

	return '' === $show_title || '1' === $show_title;
}
