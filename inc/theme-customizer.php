<?php
/**
 * Theme static text Customizer settings.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get theme text with a default fallback.
 *
 * @param string $key Theme mod key.
 * @param string $default Default value.
 *
 * @return string
 */
function djs_get_theme_text( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );

	return is_string( $value ) ? $value : $default;
}

/**
 * Sanitize footer copyright text while allowing safe inline HTML.
 *
 * @param string $value Footer copyright value.
 *
 * @return string
 */
function djs_sanitize_footer_copy_html( $value ) {
	return wp_kses_post( $value );
}

/**
 * Register static text settings in the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function djs_register_theme_text_customizer( $wp_customize ) {
	$wp_customize->add_panel(
		'djs_theme_texts',
		array(
			'title'       => __( 'DJS Theme Texts', 'djs' ),
			'priority'    => 155,
			'description' => __( 'Manage static texts used across the theme templates.', 'djs' ),
		)
	);

	$sections = array(
		'djs_header_texts'   => array(
			'title'    => __( 'Header', 'djs' ),
			'priority' => 10,
		),
		'djs_mobile_texts'   => array(
			'title'    => __( 'Mobile Menu', 'djs' ),
			'priority' => 20,
		),
		'djs_search_texts'   => array(
			'title'    => __( 'Search Overlay', 'djs' ),
			'priority' => 30,
		),
		'djs_footer_texts'   => array(
			'title'    => __( 'Footer', 'djs' ),
			'priority' => 40,
		),
		'djs_fallback_texts' => array(
			'title'    => __( 'Fallback Templates', 'djs' ),
			'priority' => 50,
		),
	);

	foreach ( $sections as $section_id => $section ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => $section['title'],
				'priority' => $section['priority'],
				'panel'    => 'djs_theme_texts',
			)
		);
	}

	$fields = array(
		'header_topbar_text' => array(
			'section' => 'djs_header_texts',
			'label'   => __( 'Topbar text', 'djs' ),
			'type'    => 'text',
			'default' => 'LIVRAISON OFFERTE DÈS 200€ — RETOURS GRATUITS 30 JOURS',
		),
		'mobile_account_label' => array(
			'section' => 'djs_mobile_texts',
			'label'   => __( 'Account label', 'djs' ),
			'type'    => 'text',
			'default' => 'COMPTE',
		),
		'mobile_stores_label' => array(
			'section' => 'djs_mobile_texts',
			'label'   => __( 'Stores label', 'djs' ),
			'type'    => 'text',
			'default' => 'BOUTIQUES',
		),
		'mobile_stores_url' => array(
			'section' => 'djs_mobile_texts',
			'label'   => __( 'Stores URL', 'djs' ),
			'type'    => 'url',
			'default' => '#',
		),
		'mobile_help_label' => array(
			'section' => 'djs_mobile_texts',
			'label'   => __( 'Help label', 'djs' ),
			'type'    => 'text',
			'default' => 'AIDE',
		),
		'mobile_help_url' => array(
			'section' => 'djs_mobile_texts',
			'label'   => __( 'Help URL', 'djs' ),
			'type'    => 'url',
			'default' => '#',
		),
		'mobile_locale_text' => array(
			'section' => 'djs_mobile_texts',
			'label'   => __( 'Locale text', 'djs' ),
			'type'    => 'text',
			'default' => 'FRANCE — FRANÇAIS (EUR — €)',
		),
		'search_overlay_eyebrow' => array(
			'section' => 'djs_search_texts',
			'label'   => __( 'Overlay eyebrow', 'djs' ),
			'type'    => 'text',
			'default' => 'Rechercher',
		),
		'search_placeholder' => array(
			'section' => 'djs_search_texts',
			'label'   => __( 'Search placeholder', 'djs' ),
			'type'    => 'text',
			'default' => 'Rechercher un produit, une catégorie...',
		),
		'search_tags' => array(
			'section'     => 'djs_search_texts',
			'label'       => __( 'Search quick links', 'djs' ),
			'type'        => 'textarea',
			'default'     => "Manteaux|manteaux\nRobes|robes\nPulls|pulls\nSneakers|sneakers\nSacs|sacs",
			'description' => __( 'One item per line using the format Label|search-term.', 'djs' ),
		),
		'footer_newsletter_title' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Newsletter title', 'djs' ),
			'type'    => 'text',
			'default' => 'Rejoignez la communauté DJS',
		),
		'footer_newsletter_text' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Newsletter text', 'djs' ),
			'type'    => 'text',
			'default' => 'Nouvelles collections et événements exclusifs.',
		),
		'footer_newsletter_placeholder' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Newsletter email placeholder', 'djs' ),
			'type'    => 'text',
			'default' => 'Votre adresse e-mail',
		),
		'footer_newsletter_button' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Newsletter button text', 'djs' ),
			'type'    => 'text',
			'default' => 'S’INSCRIRE',
		),
		'footer_description' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Footer description', 'djs' ),
			'type'    => 'textarea',
			'default' => 'Mode de luxe française, créée avec passion et savoir-faire artisanal depuis Paris.',
		),
		'footer_nav_title' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Footer navigation title', 'djs' ),
			'type'    => 'text',
			'default' => 'Boutique',
		),
		'footer_service_title' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Footer service title', 'djs' ),
			'type'    => 'text',
			'default' => 'Service Client',
		),
		'footer_store_title' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Footer store title', 'djs' ),
			'type'    => 'text',
			'default' => 'Boutique Paris',
		),
		'footer_address' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Footer address', 'djs' ),
			'type'    => 'textarea',
			'default' => "12 Rue du Faubourg Saint-Honoré\n75008 Paris, France",
		),
		'footer_hours' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Footer opening hours', 'djs' ),
			'type'    => 'textarea',
			'default' => "Lun — Sam : 10h — 19h\nDimanche : 11h — 18h",
		),
		'footer_contact' => array(
			'section' => 'djs_footer_texts',
			'label'   => __( 'Footer contact details', 'djs' ),
			'type'    => 'textarea',
			'default' => "contact@djs-paris.com\n+33 1 42 00 00 00",
		),
		'footer_copy' => array(
			'section'     => 'djs_footer_texts',
			'label'       => __( 'Footer copyright', 'djs' ),
			'type'        => 'textarea',
			'default'     => '© {year} DJS Paris. Tous droits réservés - Designed by Refresh Services',
			'description' => __( 'Use {year} to display the current year automatically. Safe HTML such as links is allowed.', 'djs' ),
		),
		'404_title' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( '404 title', 'djs' ),
			'type'    => 'text',
			'default' => '404',
		),
		'404_message' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( '404 message', 'djs' ),
			'type'    => 'text',
			'default' => 'La page que vous recherchez semble introuvable.',
		),
		'404_submessage' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( '404 submessage', 'djs' ),
			'type'    => 'text',
			'default' => 'Elle a peut-être été déplacée, supprimée ou son adresse est incorrecte.',
		),
		'404_button_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( '404 button text', 'djs' ),
			'type'    => 'text',
			'default' => 'Retour à l’accueil',
		),
		'blog_index_title' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Blog index default title', 'djs' ),
			'type'    => 'text',
			'default' => 'Journal',
		),
		'blog_read_more' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Read more text', 'djs' ),
			'type'    => 'text',
			'default' => 'Lire la suite',
		),
		'blog_empty_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Blog empty text', 'djs' ),
			'type'    => 'text',
			'default' => 'Aucun article n’a été publié pour le moment.',
		),
		'pagination_prev_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Pagination previous text', 'djs' ),
			'type'    => 'text',
			'default' => 'Précédent',
		),
		'pagination_next_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Pagination next text', 'djs' ),
			'type'    => 'text',
			'default' => 'Suivant',
		),
		'search_results_prefix' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Search results prefix', 'djs' ),
			'type'    => 'text',
			'default' => 'Résultats pour :',
		),
		'search_empty_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Search empty text', 'djs' ),
			'type'    => 'text',
			'default' => 'Aucun résultat ne correspond à votre recherche.',
		),
		'archive_empty_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Archive empty text', 'djs' ),
			'type'    => 'text',
			'default' => 'Aucun contenu disponible dans cette archive.',
		),
		'single_prev_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Single previous post text', 'djs' ),
			'type'    => 'text',
			'default' => 'Article précédent',
		),
		'single_next_text' => array(
			'section' => 'djs_fallback_texts',
			'label'   => __( 'Single next post text', 'djs' ),
			'type'    => 'text',
			'default' => 'Article suivant',
		),
	);

	foreach ( $fields as $setting_id => $field ) {
		$sanitize_callback = 'sanitize_text_field';

		if ( 'footer_copy' === $setting_id ) {
			$sanitize_callback = 'djs_sanitize_footer_copy_html';
		} elseif ( 'textarea' === $field['type'] ) {
			$sanitize_callback = 'sanitize_textarea_field';
		} elseif ( 'url' === $field['type'] ) {
			$sanitize_callback = 'esc_url_raw';
		}

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => $sanitize_callback,
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $field['label'],
				'section'     => $field['section'],
				'type'        => $field['type'],
				'description' => isset( $field['description'] ) ? $field['description'] : '',
			)
		);
	}
}
add_action( 'customize_register', 'djs_register_theme_text_customizer' );
