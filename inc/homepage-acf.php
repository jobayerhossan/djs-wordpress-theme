<?php
/**
 * Homepage ACF fields.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register local ACF fields for the homepage template.
 */
function djs_register_homepage_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_djs_homepage',
			'title'  => 'DJS Homepage',
			'fields' => array(
				array(
					'key'   => 'field_djs_home_tab_hero',
					'label' => 'Hero',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_home_hero_image',
					'label'         => 'Hero image',
					'name'          => 'djs_home_hero_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => 'Optional. If empty, the current default hero image will be used.',
				),
				array(
					'key'           => 'field_djs_home_hero_image_alt',
					'label'         => 'Hero image alt',
					'name'          => 'djs_home_hero_image_alt',
					'type'          => 'text',
					'default_value' => 'Collection Automne 2026',
				),
				array(
					'key'           => 'field_djs_home_hero_subtitle',
					'label'         => 'Hero subtitle',
					'name'          => 'djs_home_hero_subtitle',
					'type'          => 'text',
					'default_value' => 'L’ÉLÉGANCE À L’ÉTAT PUR',
				),
				array(
					'key'           => 'field_djs_home_hero_title',
					'label'         => 'Hero title',
					'name'          => 'djs_home_hero_title',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => "Collection\nAutomne 2026",
				),
				array(
					'key'           => 'field_djs_home_hero_button_text',
					'label'         => 'Hero button text',
					'name'          => 'djs_home_hero_button_text',
					'type'          => 'text',
					'default_value' => 'Découvrir',
				),
				array(
					'key'           => 'field_djs_home_hero_button_url',
					'label'         => 'Hero button URL',
					'name'          => 'djs_home_hero_button_url',
					'type'          => 'url',
					'default_value' => '',
				),
				array(
					'key'   => 'field_djs_home_tab_announcement',
					'label' => 'Announcement bar',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_home_announcement_items',
					'label'         => 'Announcement items',
					'name'          => 'djs_home_announcement_items',
					'type'          => 'textarea',
					'instructions'  => 'One line per announcement item. These lines will loop in the slider.',
					'rows'          => 7,
					'default_value' => "SAVOIR-FAIRE FRANÇAIS\nLIVRAISON OFFERTE\nNOUVELLE COLLECTION 2026\nNOUVEAU · MANTEAUX\nROBES · EXCLUSIVITÉ\nSAVOIR-FAIRE FRANÇAIS\nLIVRAISON OFFERTE",
				),
				array(
					'key'   => 'field_djs_home_tab_featured',
					'label' => 'Featured products',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_home_featured_eyebrow',
					'label'         => 'Featured eyebrow',
					'name'          => 'djs_home_featured_eyebrow',
					'type'          => 'text',
					'default_value' => 'Sélection',
				),
				array(
					'key'           => 'field_djs_home_featured_title',
					'label'         => 'Featured title',
					'name'          => 'djs_home_featured_title',
					'type'          => 'text',
					'default_value' => 'Pièces du Moment',
				),
				array(
					'key'           => 'field_djs_home_featured_link_text',
					'label'         => 'Featured link text',
					'name'          => 'djs_home_featured_link_text',
					'type'          => 'text',
					'default_value' => 'Voir tout',
				),
				array(
					'key'           => 'field_djs_home_featured_count',
					'label'         => 'Featured product count',
					'name'          => 'djs_home_featured_count',
					'type'          => 'number',
					'default_value' => 3,
					'min'           => 1,
					'max'           => 12,
				),
				array(
					'key'   => 'field_djs_home_tab_editorial',
					'label' => 'Editorial cards',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_home_editorial_1_image',
					'label'         => 'Card 1 image',
					'name'          => 'djs_home_editorial_1_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => 'Optional. If empty, the current default image will be used.',
				),
				array(
					'key'           => 'field_djs_home_editorial_1_image_alt',
					'label'         => 'Card 1 image alt',
					'name'          => 'djs_home_editorial_1_image_alt',
					'type'          => 'text',
					'default_value' => 'Collection Femme',
				),
				array(
					'key'           => 'field_djs_home_editorial_1_eyebrow',
					'label'         => 'Card 1 eyebrow',
					'name'          => 'djs_home_editorial_1_eyebrow',
					'type'          => 'text',
					'default_value' => 'Femme',
				),
				array(
					'key'           => 'field_djs_home_editorial_1_title',
					'label'         => 'Card 1 title',
					'name'          => 'djs_home_editorial_1_title',
					'type'          => 'text',
					'default_value' => 'Collection Femme',
				),
				array(
					'key'           => 'field_djs_home_editorial_1_link_text',
					'label'         => 'Card 1 link text',
					'name'          => 'djs_home_editorial_1_link_text',
					'type'          => 'text',
					'default_value' => 'Découvrir',
				),
				array(
					'key'           => 'field_djs_home_editorial_1_link_url',
					'label'         => 'Card 1 link URL',
					'name'          => 'djs_home_editorial_1_link_url',
					'type'          => 'url',
					'default_value' => '',
				),
				array(
					'key'           => 'field_djs_home_editorial_2_image',
					'label'         => 'Card 2 image',
					'name'          => 'djs_home_editorial_2_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => 'Optional. If empty, the current default image will be used.',
				),
				array(
					'key'           => 'field_djs_home_editorial_2_image_alt',
					'label'         => 'Card 2 image alt',
					'name'          => 'djs_home_editorial_2_image_alt',
					'type'          => 'text',
					'default_value' => 'Notre Histoire',
				),
				array(
					'key'           => 'field_djs_home_editorial_2_eyebrow',
					'label'         => 'Card 2 eyebrow',
					'name'          => 'djs_home_editorial_2_eyebrow',
					'type'          => 'text',
					'default_value' => 'Savoir-faire',
				),
				array(
					'key'           => 'field_djs_home_editorial_2_title',
					'label'         => 'Card 2 title',
					'name'          => 'djs_home_editorial_2_title',
					'type'          => 'text',
					'default_value' => 'Notre Histoire',
				),
				array(
					'key'           => 'field_djs_home_editorial_2_link_text',
					'label'         => 'Card 2 link text',
					'name'          => 'djs_home_editorial_2_link_text',
					'type'          => 'text',
					'default_value' => 'En savoir plus',
				),
				array(
					'key'           => 'field_djs_home_editorial_2_link_url',
					'label'         => 'Card 2 link URL',
					'name'          => 'djs_home_editorial_2_link_url',
					'type'          => 'url',
					'default_value' => '',
				),
				array(
					'key'   => 'field_djs_home_tab_vision',
					'label' => 'Vision',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_home_vision_eyebrow',
					'label'         => 'Vision eyebrow',
					'name'          => 'djs_home_vision_eyebrow',
					'type'          => 'text',
					'default_value' => 'Notre Vision',
				),
				array(
					'key'           => 'field_djs_home_vision_quote',
					'label'         => 'Vision quote',
					'name'          => 'djs_home_vision_quote',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => "\"La mode n'est pas seulement ce que vous portez —\nc'est la façon dont vous vous sentez, ce que vous\nexprimez, ce que vous devenez.\"",
				),
				array(
					'key'           => 'field_djs_home_vision_meta',
					'label'         => 'Vision meta',
					'name'          => 'djs_home_vision_meta',
					'type'          => 'text',
					'default_value' => '— DJS PARIS, DEPUIS 1998',
				),
				array(
					'key'   => 'field_djs_home_tab_campaign',
					'label' => 'Campaign banner',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_home_campaign_image',
					'label'         => 'Campaign image',
					'name'          => 'djs_home_campaign_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => 'Optional. If empty, the current default image will be used.',
				),
				array(
					'key'           => 'field_djs_home_campaign_image_alt',
					'label'         => 'Campaign image alt',
					'name'          => 'djs_home_campaign_image_alt',
					'type'          => 'text',
					'default_value' => 'La Nouvelle Saison',
				),
				array(
					'key'           => 'field_djs_home_campaign_eyebrow',
					'label'         => 'Campaign eyebrow',
					'name'          => 'djs_home_campaign_eyebrow',
					'type'          => 'text',
					'default_value' => 'Lookbook AH 2026',
				),
				array(
					'key'           => 'field_djs_home_campaign_title',
					'label'         => 'Campaign title',
					'name'          => 'djs_home_campaign_title',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => "La Nouvelle\nSaison",
				),
				array(
					'key'           => 'field_djs_home_campaign_button_text',
					'label'         => 'Campaign button text',
					'name'          => 'djs_home_campaign_button_text',
					'type'          => 'text',
					'default_value' => 'Explorer la collection',
				),
				array(
					'key'           => 'field_djs_home_campaign_button_url',
					'label'         => 'Campaign button URL',
					'name'          => 'djs_home_campaign_button_url',
					'type'          => 'url',
					'default_value' => '',
				),
				array(
					'key'   => 'field_djs_home_tab_values',
					'label' => 'Values',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_home_value_1_icon',
					'label'         => 'Value 1 icon',
					'name'          => 'djs_home_value_1_icon',
					'type'          => 'text',
					'default_value' => '◈',
				),
				array(
					'key'           => 'field_djs_home_value_1_title',
					'label'         => 'Value 1 title',
					'name'          => 'djs_home_value_1_title',
					'type'          => 'text',
					'default_value' => 'Savoir-faire Artisanal',
				),
				array(
					'key'           => 'field_djs_home_value_1_text',
					'label'         => 'Value 1 text',
					'name'          => 'djs_home_value_1_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Chaque pièce est confectionnée dans nos ateliers parisiens avec une attention particulière au détail.',
				),
				array(
					'key'           => 'field_djs_home_value_2_icon',
					'label'         => 'Value 2 icon',
					'name'          => 'djs_home_value_2_icon',
					'type'          => 'text',
					'default_value' => '◇',
				),
				array(
					'key'           => 'field_djs_home_value_2_title',
					'label'         => 'Value 2 title',
					'name'          => 'djs_home_value_2_title',
					'type'          => 'text',
					'default_value' => 'Matières Nobles',
				),
				array(
					'key'           => 'field_djs_home_value_2_text',
					'label'         => 'Value 2 text',
					'name'          => 'djs_home_value_2_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Nous sélectionnons uniquement les matières les plus naturelles — cachemire, soie, lin et laine mérinos.',
				),
				array(
					'key'           => 'field_djs_home_value_3_icon',
					'label'         => 'Value 3 icon',
					'name'          => 'djs_home_value_3_icon',
					'type'          => 'text',
					'default_value' => '◎',
				),
				array(
					'key'           => 'field_djs_home_value_3_title',
					'label'         => 'Value 3 title',
					'name'          => 'djs_home_value_3_title',
					'type'          => 'text',
					'default_value' => 'Mode Responsable',
				),
				array(
					'key'           => 'field_djs_home_value_3_text',
					'label'         => 'Value 3 text',
					'name'          => 'djs_home_value_3_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Nos créations sont pensées pour durer. Nous privilégions la qualité à la quantité.',
				),
				array(
					'key'           => 'field_djs_home_value_4_icon',
					'label'         => 'Value 4 icon',
					'name'          => 'djs_home_value_4_icon',
					'type'          => 'text',
					'default_value' => '◉',
				),
				array(
					'key'           => 'field_djs_home_value_4_title',
					'label'         => 'Value 4 title',
					'name'          => 'djs_home_value_4_title',
					'type'          => 'text',
					'default_value' => 'Livraison Offerte',
				),
				array(
					'key'           => 'field_djs_home_value_4_text',
					'label'         => 'Value 4 text',
					'name'          => 'djs_home_value_4_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "Livraison express offerte dès 200€ d'achat. Retours gratuits sous 30 jours.",
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'templates/homepage.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'djs_register_homepage_acf_fields' );
