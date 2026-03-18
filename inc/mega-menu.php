<?php
/**
 * Mega menu helpers and menu-item fields.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Attach custom properties to nav menu items.
 *
 * @param WP_Post $menu_item Menu item object.
 *
 * @return WP_Post
 */
function djs_setup_mega_menu_item( $menu_item ) {
	$menu_item->djs_enable_mega_menu = (bool) get_post_meta( $menu_item->ID, '_djs_enable_mega_menu', true );
	$menu_item->djs_enable_promo     = (bool) get_post_meta( $menu_item->ID, '_djs_enable_promo', true );
	$menu_item->djs_promo_eyebrow    = (string) get_post_meta( $menu_item->ID, '_djs_promo_eyebrow', true );
	$menu_item->djs_promo_title      = (string) get_post_meta( $menu_item->ID, '_djs_promo_title', true );
	$menu_item->djs_promo_link_text  = (string) get_post_meta( $menu_item->ID, '_djs_promo_link_text', true );
	$menu_item->djs_promo_link_url   = (string) get_post_meta( $menu_item->ID, '_djs_promo_link_url', true );
	$menu_item->djs_highlight        = (bool) get_post_meta( $menu_item->ID, '_djs_highlight', true );
	$menu_item->djs_badge_text       = (string) get_post_meta( $menu_item->ID, '_djs_badge_text', true );

	return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'djs_setup_mega_menu_item' );

/**
 * Render custom nav menu fields.
 *
 * @param int     $item_id Menu item ID.
 * @param WP_Post $item Menu item object.
 * @param int     $depth Depth.
 * @param array   $args Arguments.
 * @param int     $id Nav menu ID.
 */
function djs_render_nav_menu_fields( $item_id, $item, $depth, $args, $id ) {
	?>
	<p class="description description-wide djs-menu-field">
		<label>
			<input type="checkbox" name="menu-item-djs-enable-mega-menu[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( ! empty( $item->djs_enable_mega_menu ) ); ?>>
			<?php esc_html_e( 'Enable Mega Menu', 'djs' ); ?>
		</label>
	</p>

	<p class="description description-wide djs-menu-field">
		<label>
			<input type="checkbox" name="menu-item-djs-enable-promo[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( ! empty( $item->djs_enable_promo ) ); ?>>
			<?php esc_html_e( 'Enable Promo Block', 'djs' ); ?>
		</label>
	</p>

	<p class="description description-wide djs-menu-field">
		<label for="edit-menu-item-djs-promo-eyebrow-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Promo Eyebrow', 'djs' ); ?><br>
			<input type="text" class="widefat" id="edit-menu-item-djs-promo-eyebrow-<?php echo esc_attr( $item_id ); ?>" name="menu-item-djs-promo-eyebrow[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->djs_promo_eyebrow ); ?>">
		</label>
	</p>

	<p class="description description-wide djs-menu-field">
		<label for="edit-menu-item-djs-promo-title-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Promo Title', 'djs' ); ?><br>
			<input type="text" class="widefat" id="edit-menu-item-djs-promo-title-<?php echo esc_attr( $item_id ); ?>" name="menu-item-djs-promo-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->djs_promo_title ); ?>">
		</label>
	</p>

	<p class="description description-wide djs-menu-field">
		<label for="edit-menu-item-djs-promo-link-text-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Promo Link Text', 'djs' ); ?><br>
			<input type="text" class="widefat" id="edit-menu-item-djs-promo-link-text-<?php echo esc_attr( $item_id ); ?>" name="menu-item-djs-promo-link-text[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->djs_promo_link_text ); ?>">
		</label>
	</p>

	<p class="description description-wide djs-menu-field">
		<label for="edit-menu-item-djs-promo-link-url-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Promo Link URL', 'djs' ); ?><br>
			<input type="url" class="widefat" id="edit-menu-item-djs-promo-link-url-<?php echo esc_attr( $item_id ); ?>" name="menu-item-djs-promo-link-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->djs_promo_link_url ); ?>">
		</label>
	</p>

	<p class="description description-wide djs-menu-field">
		<label>
			<input type="checkbox" name="menu-item-djs-highlight[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( ! empty( $item->djs_highlight ) ); ?>>
			<?php esc_html_e( 'Highlight', 'djs' ); ?>
		</label>
	</p>

	<p class="description description-wide djs-menu-field">
		<label for="edit-menu-item-djs-badge-text-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Badge Text', 'djs' ); ?><br>
			<input type="text" class="widefat" id="edit-menu-item-djs-badge-text-<?php echo esc_attr( $item_id ); ?>" name="menu-item-djs-badge-text[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->djs_badge_text ); ?>">
		</label>
	</p>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'djs_render_nav_menu_fields', 10, 5 );

/**
 * Save custom menu item fields.
 *
 * @param int $menu_id Menu ID.
 * @param int $menu_item_db_id Menu item DB ID.
 */
function djs_save_nav_menu_fields( $menu_id, $menu_item_db_id ) {
	$checkbox_fields = array(
		'_djs_enable_mega_menu' => 'menu-item-djs-enable-mega-menu',
		'_djs_enable_promo'     => 'menu-item-djs-enable-promo',
		'_djs_highlight'        => 'menu-item-djs-highlight',
	);

	foreach ( $checkbox_fields as $meta_key => $field_key ) {
		$value = isset( $_POST[ $field_key ][ $menu_item_db_id ] ) ? '1' : '';
		update_post_meta( $menu_item_db_id, $meta_key, $value );
	}

	$text_fields = array(
		'_djs_promo_eyebrow'   => 'menu-item-djs-promo-eyebrow',
		'_djs_promo_title'     => 'menu-item-djs-promo-title',
		'_djs_promo_link_text' => 'menu-item-djs-promo-link-text',
		'_djs_badge_text'      => 'menu-item-djs-badge-text',
	);

	foreach ( $text_fields as $meta_key => $field_key ) {
		$value = isset( $_POST[ $field_key ][ $menu_item_db_id ] ) ? sanitize_text_field( wp_unslash( $_POST[ $field_key ][ $menu_item_db_id ] ) ) : '';
		update_post_meta( $menu_item_db_id, $meta_key, $value );
	}

	$url = isset( $_POST['menu-item-djs-promo-link-url'][ $menu_item_db_id ] ) ? esc_url_raw( wp_unslash( $_POST['menu-item-djs-promo-link-url'][ $menu_item_db_id ] ) ) : '';
	update_post_meta( $menu_item_db_id, '_djs_promo_link_url', $url );
}
add_action( 'wp_update_nav_menu_item', 'djs_save_nav_menu_fields', 10, 2 );

/**
 * Get hierarchical menu tree for a theme location.
 *
 * @param string $theme_location Theme location.
 *
 * @return array<int, array<string, mixed>>
 */
function djs_get_menu_tree( $theme_location ) {
	$locations = get_nav_menu_locations();

	if ( empty( $locations[ $theme_location ] ) ) {
		return array();
	}

	$items = wp_get_nav_menu_items( $locations[ $theme_location ] );

	if ( empty( $items ) ) {
		return array();
	}

	$indexed = array();

	foreach ( $items as $item ) {
		$indexed[ $item->ID ] = array(
			'item'     => $item,
			'children' => array(),
		);
	}

	$tree = array();

	foreach ( $indexed as $item_id => &$node ) {
		$parent_id = (int) $node['item']->menu_item_parent;

		if ( $parent_id && isset( $indexed[ $parent_id ] ) ) {
			$indexed[ $parent_id ]['children'][] = &$node;
		} else {
			$tree[] = &$node;
		}
	}
	unset( $node );

	return $tree;
}

/**
 * Render the desktop mega menu for the left header navigation.
 */
function djs_render_header_mega_menu() {
	$tree = djs_get_menu_tree( 'header_left_menu' );

	if ( empty( $tree ) ) {
		return;
	}
	?>
	<ul class="header-menu header-menu-left header-mega-menu">
		<?php foreach ( $tree as $node ) : ?>
			<?php
			$item          = $node['item'];
			$children      = $node['children'];
			$has_mega      = ! empty( $children ) && ! empty( $item->djs_enable_mega_menu );
			$has_promo     = $has_mega && ! empty( $item->djs_enable_promo ) && ( $item->djs_promo_eyebrow || $item->djs_promo_title || ( $item->djs_promo_link_text && $item->djs_promo_link_url ) );
			$item_classes  = array( 'header-menu-item' );
			$item_classes[] = $has_mega ? 'menu-item-has-mega-menu' : '';

			if ( ! empty( $item->classes ) && is_array( $item->classes ) ) {
				$item_classes = array_merge( $item_classes, array_filter( $item->classes ) );
			}
			?>
			<li class="<?php echo esc_attr( implode( ' ', array_filter( $item_classes ) ) ); ?>">
				<a href="<?php echo esc_url( $item->url ); ?>" class="header-menu__link">
					<?php echo esc_html( $item->title ); ?>
				</a>

				<?php if ( $has_mega ) : ?>
					<div class="header-mega-panel">
						<div class="header-mega-panel__inner djs-container <?php echo $has_promo ? 'has-promo' : 'no-promo'; ?>">
							<?php if ( $has_promo ) : ?>
								<div class="header-mega-panel__promo">
									<?php if ( $item->djs_promo_eyebrow ) : ?>
										<div class="header-mega-panel__promo-eyebrow"><?php echo esc_html( $item->djs_promo_eyebrow ); ?></div>
									<?php endif; ?>

									<?php if ( $item->djs_promo_title ) : ?>
										<div class="header-mega-panel__promo-title"><?php echo wp_kses_post( nl2br( esc_html( $item->djs_promo_title ) ) ); ?></div>
									<?php endif; ?>

									<?php if ( $item->djs_promo_link_text && $item->djs_promo_link_url ) : ?>
										<a href="<?php echo esc_url( $item->djs_promo_link_url ); ?>" class="header-mega-panel__promo-link">
											<?php echo esc_html( $item->djs_promo_link_text ); ?> <span aria-hidden="true">→</span>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<div class="header-mega-panel__columns columns-<?php echo esc_attr( count( $children ) ); ?>">
								<?php foreach ( $children as $column ) : ?>
									<div class="header-mega-panel__column">
										<div class="header-mega-panel__column-title">
											<?php echo esc_html( $column['item']->title ); ?>
										</div>

										<?php if ( ! empty( $column['children'] ) ) : ?>
											<ul class="header-mega-panel__links">
												<?php foreach ( $column['children'] as $link_node ) : ?>
													<?php $link_item = $link_node['item']; ?>
													<li class="<?php echo ! empty( $link_item->djs_highlight ) ? 'is-highlight' : ''; ?>">
														<a href="<?php echo esc_url( $link_item->url ); ?>">
															<span><?php echo esc_html( $link_item->title ); ?></span>
															<?php if ( $link_item->djs_badge_text ) : ?>
																<em class="header-mega-panel__badge"><?php echo esc_html( $link_item->djs_badge_text ); ?></em>
															<?php endif; ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}
