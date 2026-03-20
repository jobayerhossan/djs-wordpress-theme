<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php $djs_account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>
<?php
$djs_header_topbar_text     = djs_get_theme_text( 'header_topbar_text', 'LIVRAISON OFFERTE DÈS 200€ — RETOURS GRATUITS 30 JOURS' );
$djs_mobile_account_label   = djs_get_theme_text( 'mobile_account_label', 'COMPTE' );
$djs_mobile_stores_label    = djs_get_theme_text( 'mobile_stores_label', 'BOUTIQUES' );
$djs_mobile_help_label      = djs_get_theme_text( 'mobile_help_label', 'AIDE' );
$djs_search_eyebrow         = djs_get_theme_text( 'search_overlay_eyebrow', 'Rechercher' );
$djs_search_placeholder     = djs_get_theme_text( 'search_placeholder', 'Rechercher un produit, une catégorie...' );
$djs_search_tags_raw        = djs_get_theme_text( 'search_tags', "Manteaux|manteaux\nRobes|robes\nPulls|pulls\nSneakers|sneakers\nSacs|sacs" );
$djs_search_tags            = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $djs_search_tags_raw ) ) );
?>

<header class="site-header">
	<div class="header-topbar desktop-topbar">
		<div class="djs-container">
			<p class="header-topbar-text"><?php echo esc_html( $djs_header_topbar_text ); ?></p>
		</div>
	</div>

	<div class="header-main">
		<div class="djs-container">
			<div class="header-main-wrap">

				<div class="header-left desktop-only">
					<?php djs_render_header_mega_menu(); ?>
				</div>

				<div class="mobile-menu-toggle mobile-only">
					<button type="button" class="mobile-nav-open" aria-label="<?php esc_attr_e( 'Open menu', 'djs' ); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/bar.svg" alt="">
					</button>
				</div>

				<div class="header-logo">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-text">
							<?php bloginfo( 'name' ); ?>
						</a>
					<?php endif; ?>
				</div>

				<div class="header-right">
					<div class="desktop-right-menu desktop-only">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'header_right_menu',
								'container'      => false,
								'menu_class'     => 'header-menu header-menu-right',
								'fallback_cb'    => false,
							)
						);
						?>
					</div>

					<div class="header-icons">
						<button type="button" class="header-icon header-search djs-search-toggle" aria-label="<?php esc_attr_e( 'Search', 'djs' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Search.svg' ); ?>" alt="<?php esc_attr_e( 'Search', 'djs' ); ?>">
						</button>

						<a href="<?php echo esc_url( $djs_account_url ); ?>" class="header-icon header-account" aria-label="<?php esc_attr_e( 'Account', 'djs' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/User.svg' ); ?>" alt="<?php esc_attr_e( 'Account', 'djs' ); ?>">
						</a>

						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-icon header-cart" aria-label="<?php esc_attr_e( 'Cart', 'djs' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ShoppingBag.svg' ); ?>" alt="<?php esc_attr_e( 'Cart', 'djs' ); ?>">
							<span class="header-cart-count">
								<?php echo WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?>
							</span>
						</a>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="mobile-nav">
		<div class="mobile-nav-inner">

			<div class="mobile-nav-topbar">
				<p><?php echo esc_html( $djs_header_topbar_text ); ?></p>
				<button type="button" class="mobile-nav-close-top" aria-label="<?php esc_attr_e( 'Close menu', 'djs' ); ?>">×</button>
			</div>

			<div class="mobile-nav-header">
				<div class="mobile-nav-logo">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-text">
							<?php bloginfo( 'name' ); ?>
						</a>
					<?php endif; ?>
				</div>

				<div class="mobile-nav-header-right">
					<button type="button" class="header-icon djs-search-toggle" aria-label="<?php esc_attr_e( 'Search', 'djs' ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Search.svg' ); ?>" alt="">
					</button>

					<a href="<?php echo esc_url( $djs_account_url ); ?>" class="header-icon" aria-label="<?php esc_attr_e( 'Account', 'djs' ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/User.svg' ); ?>" alt="<?php esc_attr_e( 'Account', 'djs' ); ?>">
					</a>

					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-icon header-cart" aria-label="<?php esc_attr_e( 'Cart', 'djs' ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ShoppingBag.svg' ); ?>" alt="">
						<span class="header-cart-count">
							<?php echo WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?>
						</span>
					</a>

					<button type="button" class="mobile-nav-close" aria-label="<?php esc_attr_e( 'Close menu', 'djs' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x" data-fg-cqpb75="1.35:2.14856:/src/app/components/Navbar.tsx:495:17:18481:49:e:X::::::TvS" data-fgid-cqpb75=":rpb:"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
					</button>
				</div>
			</div>

			<div class="mobile-nav-menu-wrap">
				<?php
				$mobile_menu_location = has_nav_menu( 'mobile_menu' ) ? 'mobile_menu' : 'header_left_menu';

				wp_nav_menu(
					array(
						'theme_location' => $mobile_menu_location,
						'container'      => false,
						'menu_class'     => 'mobile-nav-menu',
						'fallback_cb'    => false,
					)
				);
				?>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header_right_menu',
						'container'      => false,
						'menu_class'     => 'mobile-nav-menu mobile-nav-menu-secondary',
						'fallback_cb'    => false,
					)
				);
				?>
			</div>

			<div class="mobile-nav-bottom">
				<ul class="mobile-nav-links">
					<li>
						<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/User.svg' ); ?>" alt="">
							<span><?php echo esc_html( $djs_mobile_account_label ); ?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ShoppingBag.svg' ); ?>" alt="">
							<span><?php echo esc_html( $djs_mobile_stores_label ); ?></span>
						</a>
					</li>
					<li>
						<button type="button" class="djs-search-toggle mobile-nav-link-button" aria-label="<?php esc_attr_e( 'Search', 'djs' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Search.svg' ); ?>" alt="">
							<span><?php echo esc_html( $djs_mobile_help_label ); ?></span>
						</button>
					</li>
				</ul>
			</div>

		</div>
	</div>
</header>



<div class="djs-search-overlay">
	<div class="djs-search-overlay__inner">
		<button type="button" class="djs-search-overlay__close" aria-label="<?php esc_attr_e( 'Close search', 'djs' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<path d="M18 6L6 18" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6 6L18 18" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>

		<div class="djs-search-overlay__content">
			<div class="djs-search-overlay__eyebrow"><?php echo esc_html( $djs_search_eyebrow ); ?></div>

			<form role="search" method="get" class="djs-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="djs-product-search">
					<?php esc_html_e( 'Search for:', 'djs' ); ?>
				</label>

				<input
					type="search"
					id="djs-product-search"
					class="djs-search-form__input"
					placeholder="<?php echo esc_attr( $djs_search_placeholder ); ?>"
					value="<?php echo get_search_query(); ?>"
					name="s"
					autocomplete="off"
				>

				<input type="hidden" name="post_type" value="product">

				<button type="submit" class="djs-search-form__button" aria-label="<?php esc_attr_e( 'Search', 'djs' ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Search.svg' ); ?>" alt="<?php esc_attr_e( 'Search', 'djs' ); ?>">
				</button>
			</form>

			<div class="djs-search-overlay__tags">
				<?php foreach ( $djs_search_tags as $djs_search_tag_line ) : ?>
					<?php
					$djs_search_tag_parts = array_map( 'trim', explode( '|', $djs_search_tag_line, 2 ) );
					$djs_search_tag_label = $djs_search_tag_parts[0] ?? '';
					$djs_search_tag_query = $djs_search_tag_parts[1] ?? $djs_search_tag_label;
					?>
					<?php if ( $djs_search_tag_label && $djs_search_tag_query ) : ?>
						<a href="<?php echo esc_url( add_query_arg( array( 's' => $djs_search_tag_query, 'post_type' => 'product' ), home_url( '/' ) ) ); ?>"><?php echo esc_html( $djs_search_tag_label ); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
