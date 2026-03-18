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

<header class="site-header">
	<div class="header-topbar desktop-topbar">
		<div class="djs-container">
			<p class="header-topbar-text">LIVRAISON OFFERTE DÈS 200€ — RETOURS GRATUITS 30 JOURS</p>
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

						<a href="#" class="header-icon header-account" aria-label="<?php esc_attr_e( 'Account', 'djs' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/User.svg' ); ?>" alt="<?php esc_attr_e( 'Wishlist', 'djs' ); ?>">
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
				<p>LIVRAISON OFFERTE DÈS 200€ — RETOURS GRATUITS 30 JOURS</p>
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
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-icon" aria-label="<?php esc_attr_e( 'Search', 'djs' ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Search.svg' ); ?>" alt="">
					</a>

					<a href="#" class="header-icon" aria-label="<?php esc_attr_e( 'Wishlist', 'djs' ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/heart.svg' ); ?>" alt="">
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
				wp_nav_menu(
					array(
						'theme_location' => 'header_left_menu',
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
							<span>COMPTE</span>
						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ShoppingBag.svg' ); ?>" alt="">
							<span>BOUTIQUES</span>
						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Search.svg' ); ?>" alt="">
							<span>AIDE</span>
						</a>
					</li>
				</ul>

				<div class="mobile-nav-locale">
					<span>FRANCE — FRANÇAIS (EUR — €)</span>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ArrowRight.svg' ); ?>" alt="">
				</div>
			</div>

		</div>
	</div>
</header>



<div class="djs-search-overlay">
	<div class="djs-search-overlay__inner">
		<button type="button" class="djs-search-overlay__close" aria-label="<?php esc_attr_e( 'Close search', 'djs' ); ?>">×</button>

		<div class="djs-search-overlay__content">
			<div class="djs-search-overlay__eyebrow">Rechercher</div>

			<form role="search" method="get" class="djs-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="djs-product-search">
					<?php esc_html_e( 'Search for:', 'djs' ); ?>
				</label>

				<input
					type="search"
					id="djs-product-search"
					class="djs-search-form__input"
					placeholder="Rechercher un produit, une catégorie..."
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
				<a href="<?php echo esc_url( add_query_arg( array( 's' => 'manteaux', 'post_type' => 'product' ), home_url( '/' ) ) ); ?>">Manteaux</a>
				<a href="<?php echo esc_url( add_query_arg( array( 's' => 'robes', 'post_type' => 'product' ), home_url( '/' ) ) ); ?>">Robes</a>
				<a href="<?php echo esc_url( add_query_arg( array( 's' => 'pulls', 'post_type' => 'product' ), home_url( '/' ) ) ); ?>">Pulls</a>
				<a href="<?php echo esc_url( add_query_arg( array( 's' => 'sneakers', 'post_type' => 'product' ), home_url( '/' ) ) ); ?>">Sneakers</a>
				<a href="<?php echo esc_url( add_query_arg( array( 's' => 'sacs', 'post_type' => 'product' ), home_url( '/' ) ) ); ?>">Sacs</a>
			</div>
		</div>
	</div>
</div>
