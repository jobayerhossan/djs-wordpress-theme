<?php
/**
 * Custom wishlist feature.
 *
 * @package DJS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the wishlist cookie name.
 *
 * @return string
 */
function djs_get_wishlist_cookie_name() {
	return 'djs_wishlist';
}

/**
 * Sanitize wishlist product IDs.
 *
 * @param mixed $product_ids Raw product IDs.
 *
 * @return array
 */
function djs_sanitize_wishlist_product_ids( $product_ids ) {
	$product_ids = is_array( $product_ids ) ? $product_ids : array();

	return array_values(
		array_unique(
			array_filter(
				array_map( 'absint', $product_ids )
			)
		)
	);
}

/**
 * Read wishlist IDs from the guest cookie.
 *
 * @return array
 */
function djs_get_wishlist_ids_from_cookie() {
	if ( empty( $_COOKIE[ djs_get_wishlist_cookie_name() ] ) ) {
		return array();
	}

	$decoded = json_decode( wp_unslash( $_COOKIE[ djs_get_wishlist_cookie_name() ] ), true );

	return djs_sanitize_wishlist_product_ids( is_array( $decoded ) ? $decoded : array() );
}

/**
 * Get the current visitor wishlist IDs.
 *
 * @return array
 */
function djs_get_wishlist_product_ids() {
	if ( is_user_logged_in() ) {
		$product_ids = get_user_meta( get_current_user_id(), '_djs_wishlist_product_ids', true );

		return djs_sanitize_wishlist_product_ids( is_array( $product_ids ) ? $product_ids : array() );
	}

	return djs_get_wishlist_ids_from_cookie();
}

/**
 * Persist wishlist IDs for the current visitor.
 *
 * @param array $product_ids Wishlist product IDs.
 *
 * @return void
 */
function djs_save_wishlist_product_ids( $product_ids ) {
	$product_ids = djs_sanitize_wishlist_product_ids( $product_ids );

	if ( is_user_logged_in() ) {
		update_user_meta( get_current_user_id(), '_djs_wishlist_product_ids', $product_ids );
	}

	if ( function_exists( 'wc_setcookie' ) ) {
		wc_setcookie( djs_get_wishlist_cookie_name(), wp_json_encode( $product_ids ), time() + YEAR_IN_SECONDS );
		return;
	}

	setcookie( djs_get_wishlist_cookie_name(), wp_json_encode( $product_ids ), time() + YEAR_IN_SECONDS, COOKIEPATH ? COOKIEPATH : '/' );
}

/**
 * Merge guest wishlist into the logged-in account wishlist.
 *
 * @param string  $user_login Username.
 * @param WP_User $user User object.
 *
 * @return void
 */
function djs_merge_guest_wishlist_on_login( $user_login, $user ) {
	unset( $user_login );

	$cookie_ids = djs_get_wishlist_ids_from_cookie();

	if ( empty( $cookie_ids ) || ! $user instanceof WP_User ) {
		return;
	}

	$user_ids = get_user_meta( $user->ID, '_djs_wishlist_product_ids', true );
	$user_ids = djs_sanitize_wishlist_product_ids( is_array( $user_ids ) ? $user_ids : array() );

	update_user_meta( $user->ID, '_djs_wishlist_product_ids', array_merge( $cookie_ids, $user_ids ) );
	djs_save_wishlist_product_ids( array_merge( $cookie_ids, $user_ids ) );
}
add_action( 'wp_login', 'djs_merge_guest_wishlist_on_login', 10, 2 );

/**
 * Check if a product is already wishlisted.
 *
 * @param int $product_id Product ID.
 *
 * @return bool
 */
function djs_is_product_in_wishlist( $product_id ) {
	return in_array( absint( $product_id ), djs_get_wishlist_product_ids(), true );
}

/**
 * Get the wishlist icon markup.
 *
 * @param bool $is_active Whether the product is in the wishlist.
 *
 * @return string
 */
function djs_get_wishlist_icon_svg( $is_active ) {
	ob_start();
	?>
	<svg width="18" height="18" viewBox="0 0 24 24" fill="<?php echo $is_active ? '#C8102E' : 'none'; ?>" stroke="<?php echo $is_active ? '#C8102E' : '#1A1A1A'; ?>" stroke-width="1.5" aria-hidden="true" focusable="false">
		<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
	</svg>
	<?php

	return (string) ob_get_clean();
}

/**
 * Render a wishlist toggle button.
 *
 * @param int    $product_id Product ID.
 * @param string $context    Display context.
 *
 * @return string
 */
function djs_get_wishlist_button_html( $product_id, $context = 'loop' ) {
	$product_id = absint( $product_id );
	$is_active  = djs_is_product_in_wishlist( $product_id );
	$classes    = array( 'djs-wishlist-toggle', 'djs-wishlist-toggle--' . sanitize_html_class( $context ) );

	if ( $is_active ) {
		$classes[] = 'is-active';
	}

	$button_label = $is_active ? __( 'Retirer de la liste de souhaits', 'djs' ) : __( 'Ajouter a la liste de souhaits', 'djs' );

	ob_start();
	?>
	<button
		type="button"
		class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
		data-product-id="<?php echo esc_attr( $product_id ); ?>"
		aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>"
		aria-label="<?php echo esc_attr( $button_label ); ?>"
	>
		<span class="djs-wishlist-toggle__icon" data-icon-default="<?php echo esc_attr( djs_get_wishlist_icon_svg( false ) ); ?>" data-icon-active="<?php echo esc_attr( djs_get_wishlist_icon_svg( true ) ); ?>">
			<?php echo djs_get_wishlist_icon_svg( $is_active ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</span>
		<?php if ( 'single' === $context ) : ?>
			<span class="djs-wishlist-toggle__text">
				<?php echo esc_html( $button_label ); ?>
			</span>
		<?php endif; ?>
	</button>
	<?php

	return (string) ob_get_clean();
}

/**
 * Get wishlist product query.
 *
 * @return WP_Query
 */
function djs_get_wishlist_query() {
	$product_ids = djs_get_wishlist_product_ids();

	if ( empty( $product_ids ) ) {
		return new WP_Query(
			array(
				'post_type'      => 'product',
				'post__in'       => array( 0 ),
				'posts_per_page' => 0,
			)
		);
	}

	return new WP_Query(
		array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'post__in'       => $product_ids,
			'orderby'        => 'post__in',
		)
	);
}

/**
 * Render the wishlist shortcode.
 *
 * @return string
 */
function djs_render_wishlist_shortcode() {
	$query = djs_get_wishlist_query();

	ob_start();
	?>
	<section class="djs-wishlist-page" data-empty-message="<?php echo esc_attr__( 'Votre liste de souhaits est vide pour le moment.', 'djs' ); ?>">
		<?php if ( $query->have_posts() ) : ?>
			<?php woocommerce_product_loop_start(); ?>
			<?php while ( $query->have_posts() ) : ?>
				<?php $query->the_post(); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>
			<?php woocommerce_product_loop_end(); ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p class="djs-wishlist-page__empty"><?php esc_html_e( 'Votre liste de souhaits est vide pour le moment.', 'djs' ); ?></p>
		<?php endif; ?>
	</section>
	<?php

	return (string) ob_get_clean();
}
add_shortcode( 'djs_wishlist', 'djs_render_wishlist_shortcode' );

/**
 * Toggle a product in the wishlist.
 *
 * @return void
 */
function djs_ajax_toggle_wishlist() {
	check_ajax_referer( 'djs_ajax_nonce', 'nonce' );

	$product_id = isset( $_POST['product_id'] ) ? absint( wp_unslash( $_POST['product_id'] ) ) : 0;

	if ( ! $product_id || 'product' !== get_post_type( $product_id ) ) {
		wp_send_json_error(
			array(
				'message' => __( 'Produit invalide.', 'djs' ),
			),
			400
		);
	}

	$product_ids = djs_get_wishlist_product_ids();
	$is_active   = in_array( $product_id, $product_ids, true );

	if ( $is_active ) {
		$product_ids = array_values( array_diff( $product_ids, array( $product_id ) ) );
	} else {
		array_unshift( $product_ids, $product_id );
	}

	$product_ids = djs_sanitize_wishlist_product_ids( $product_ids );

	djs_save_wishlist_product_ids( $product_ids );

	wp_send_json_success(
		array(
			'product_id' => $product_id,
			'is_active'  => ! $is_active,
			'count'      => count( $product_ids ),
			'label'      => ! $is_active ? __( 'Retirer de la liste de souhaits', 'djs' ) : __( 'Ajouter a la liste de souhaits', 'djs' ),
		)
	);
}
add_action( 'wp_ajax_djs_toggle_wishlist', 'djs_ajax_toggle_wishlist' );
add_action( 'wp_ajax_nopriv_djs_toggle_wishlist', 'djs_ajax_toggle_wishlist' );
