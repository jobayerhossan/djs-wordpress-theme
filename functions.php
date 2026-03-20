<?php
/**
 * Theme functions and definitions
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup
 */ 
function djs_theme_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'djs', get_template_directory() . '/languages' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable featured images.
	add_theme_support( 'post-thumbnails' );

	// Register custom logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// WooCommerce support.
	add_theme_support( 'woocommerce' );

	// HTML5 support.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Register menus.
	register_nav_menus(
		array(
			'header_left_menu'   => __( 'Header Left Menu', 'djs' ),
			'header_right_menu'  => __( 'Header Right Menu', 'djs' ),
			'mobile_menu'        => __( 'Mobile Menu', 'djs' ),
			'footer_menu'        => __( 'Footer Navigation Menu', 'djs' ),
			'footer_service'     => __( 'Footer Service Client Menu', 'djs' ),
			'footer_legal'       => __( 'Footer Legal Pages Menu', 'djs' ),
		)
	);
}
add_action( 'after_setup_theme', 'djs_theme_setup' );

/**
 * Enqueue theme assets
 */
function djs_enqueue_assets() {

	$theme_version = wp_get_theme()->get( 'Version' );

	/*
	|--------------------------------------------------------------------------
	| Styles
	|--------------------------------------------------------------------------
	| Suggested files:
	| /assets/css/header.css
	| /assets/css/footer.css
	| /assets/css/utilities.css   => common classes like flex, grid, text-center
	| /assets/css/responsive.css
	| /assets/css/swiper-bundle.min.css
	*/

	wp_enqueue_style(
		'djs-swiper-style',
		get_template_directory_uri() . '/assets/css/swiper-bundle.min.css',
		array(),
		'11.2.6'
	);

	wp_enqueue_style(
		'djs-header-style',
		get_template_directory_uri() . '/assets/css/header.css',
		array(),
		$theme_version
	);

	wp_enqueue_style(
		'djs-footer-style',
		get_template_directory_uri() . '/assets/css/footer.css',
		array(),
		$theme_version
	);

	wp_enqueue_style(
		'djs-utilities-style',
		get_template_directory_uri() . '/assets/css/utilities.css',
		array(),
		$theme_version
	);

	wp_enqueue_style(
		'djs-responsive-style',
		get_template_directory_uri() . '/assets/css/responsive.css',
		array(
			'djs-header-style',
			'djs-footer-style',
			'djs-utilities-style',
		),
		$theme_version
	);

	// Main style.css
	wp_enqueue_style(
		'djs-main-style',
		get_stylesheet_uri(),
		array(
			'djs-swiper-style',
			'djs-header-style',
			'djs-footer-style',
			'djs-utilities-style',
			'djs-responsive-style',
		),
		$theme_version
	);


	if ( is_page_template( 'templates/homepage.php' ) ) {
		wp_enqueue_style(
			'djs-homepage-style',
			get_template_directory_uri() . '/assets/css/homepage.css',
			array(),
			$theme_version
		);
	}

	if ( is_page_template( 'templates/about-page.php' ) ) {
		wp_enqueue_style(
			'djs-about-page-style',
			get_template_directory_uri() . '/assets/css/about-page.css',
			array( 'djs-main-style' ),
			$theme_version
		);
	}

	if ( is_page_template( 'templates/contact-page.php' ) ) {
		wp_enqueue_style(
			'djs-contact-page-style',
			get_template_directory_uri() . '/assets/css/contact-page.css',
			array( 'djs-main-style' ),
			$theme_version
		);
	}

	wp_enqueue_style(
		'djs-products',
		get_template_directory_uri() . '/assets/css/products.css',
		array(),
		$theme_version
	);

	wp_enqueue_style(
		'djs-wishlist-style',
		get_template_directory_uri() . '/assets/css/wishlist.css',
		array( 'djs-products' ),
		$theme_version
	);

	if ( is_product() ) {
		wp_enqueue_style(
			'djs-single-product-style',
			get_template_directory_uri() . '/assets/css/single-product.css',
			array( 'djs-main-style', 'djs-products' ),
			$theme_version
		);
	}

	if ( is_cart() ) {
		wp_enqueue_style(
			'djs-cart-page-style',
			get_template_directory_uri() . '/assets/css/cart-page.css',
			array( 'djs-main-style', 'djs-products' ),
			$theme_version
		);
	}

	if ( is_checkout() ) {
		wp_enqueue_style(
			'djs-checkout-page-style',
			get_template_directory_uri() . '/assets/css/checkout.css',
			array( 'djs-main-style', 'djs-products' ),
			$theme_version
		);
	}

	if ( is_account_page() ) {
		wp_enqueue_style(
			'djs-account-page-style',
			get_template_directory_uri() . '/assets/css/account-page.css',
			array( 'djs-main-style' ),
			$theme_version
		);
	}

	/*
	|--------------------------------------------------------------------------
	| Scripts
	|--------------------------------------------------------------------------
	| Suggested files:
	| /assets/js/swiper-bundle.min.js
	| /assets/js/custom.js
	*/
	wp_enqueue_script(
		'djs-swiper-script',
		get_template_directory_uri() . '/assets/js/swiper-bundle.min.js',
		array(),
		'11.2.6',
		true
	);

	wp_enqueue_script(
		'djs-custom-script',
		get_template_directory_uri() . '/assets/js/custom.js',
		array( 'jquery', 'djs-swiper-script' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'djs-wishlist-script',
		get_template_directory_uri() . '/assets/js/wishlist.js',
		array( 'jquery', 'djs-custom-script' ),
		$theme_version,
		true
	);

	wp_localize_script(
		'djs-custom-script',
		'djs_ajax_obj',
		array(
			'ajax_url'           => admin_url( 'admin-ajax.php' ),
			'nonce'              => wp_create_nonce( 'djs_ajax_nonce' ),
			'current_product_id' => is_product() ? get_the_ID() : 0,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'djs_enqueue_assets' );


require_once get_template_directory() . '/inc/woocommerce.php';
require_once get_template_directory() . '/inc/product-filter.php';
require_once get_template_directory() . '/inc/single-product-acf.php';
require_once get_template_directory() . '/inc/homepage-acf.php';
require_once get_template_directory() . '/inc/about-page-acf.php';
require_once get_template_directory() . '/inc/contact-page-acf.php';
require_once get_template_directory() . '/inc/contact-page.php';
require_once get_template_directory() . '/inc/account.php';
require_once get_template_directory() . '/inc/mega-menu.php';
require_once get_template_directory() . '/inc/footer-newsletter.php';
require_once get_template_directory() . '/inc/page-settings.php';
require_once get_template_directory() . '/inc/recently-viewed.php';
require_once get_template_directory() . '/inc/cart-ajax.php';
require_once get_template_directory() . '/inc/wishlist.php';
require_once get_template_directory() . '/inc/theme-customizer.php';
