<?php
/**
 * About page ACF fields.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register local ACF fields for the about page template.
 */
function djs_register_about_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_djs_about_page',
			'title'  => 'DJS About Page',
			'fields' => array(
				array(
					'key'   => 'field_djs_about_tab_hero',
					'label' => 'Hero',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_about_hero_image',
					'label'         => 'Hero image',
					'name'          => 'djs_about_hero_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => 'Optional. If empty, the current default hero image will be used.',
				),
				array(
					'key'           => 'field_djs_about_hero_image_alt',
					'label'         => 'Hero image alt',
					'name'          => 'djs_about_hero_image_alt',
					'type'          => 'text',
					'default_value' => 'DJS Paris boutique',
				),
				array(
					'key'           => 'field_djs_about_hero_eyebrow',
					'label'         => 'Hero eyebrow',
					'name'          => 'djs_about_hero_eyebrow',
					'type'          => 'text',
					'default_value' => 'Notre histoire',
				),
				array(
					'key'           => 'field_djs_about_hero_title',
					'label'         => 'Hero title',
					'name'          => 'djs_about_hero_title',
					'type'          => 'text',
					'default_value' => 'DJS Paris',
				),
				array(
					'key'           => 'field_djs_about_hero_signature',
					'label'         => 'Hero signature',
					'name'          => 'djs_about_hero_signature',
					'type'          => 'text',
					'default_value' => 'Depuis 1998',
				),
				array(
					'key'   => 'field_djs_about_tab_intro',
					'label' => 'Intro',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_about_intro_eyebrow',
					'label'         => 'Intro eyebrow',
					'name'          => 'djs_about_intro_eyebrow',
					'type'          => 'text',
					'default_value' => 'Notre philosophie',
				),
				array(
					'key'           => 'field_djs_about_intro_quote',
					'label'         => 'Intro quote',
					'name'          => 'djs_about_intro_quote',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => "Nous créons des vêtements qui transcendent les saisons, des\npièces conçues pour durer, pour voyager avec vous, et pour\nraconter votre histoire.",
				),
				array(
					'key'   => 'field_djs_about_tab_story_1',
					'label' => 'Story block 1',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_about_story_1_eyebrow',
					'label'         => 'Story block 1 eyebrow',
					'name'          => 'djs_about_story_1_eyebrow',
					'type'          => 'text',
					'default_value' => '1998 — Les origines',
				),
				array(
					'key'           => 'field_djs_about_story_1_title',
					'label'         => 'Story block 1 title',
					'name'          => 'djs_about_story_1_title',
					'type'          => 'text',
					'default_value' => "Née d'une passion pour l'excellence",
				),
				array(
					'key'           => 'field_djs_about_story_1_text_1',
					'label'         => 'Story block 1 paragraph 1',
					'name'          => 'djs_about_story_1_text_1',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => "DJS Paris est née de la volonté d'offrir des pièces pensées pour traverser le temps\net accompagner une allure sensible et assurée. Dans notre premier atelier de la\nMaison Saint-Honoré, nous avons façonné une vision exigeante, entre tradition et grâce.",
				),
				array(
					'key'           => 'field_djs_about_story_1_text_2',
					'label'         => 'Story block 1 paragraph 2',
					'name'          => 'djs_about_story_1_text_2',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => "Chaque collection raconte l'histoire d'un savoir-faire transmis de génération en\ngénération, et d'un regard précis pour les matières nobles et les coupes d'une justesse rare.",
				),
				array(
					'key'           => 'field_djs_about_story_1_image',
					'label'         => 'Story block 1 image',
					'name'          => 'djs_about_story_1_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => 'Optional. If empty, the current default image will be used.',
				),
				array(
					'key'           => 'field_djs_about_story_1_image_alt',
					'label'         => 'Story block 1 image alt',
					'name'          => 'djs_about_story_1_image_alt',
					'type'          => 'text',
					'default_value' => 'DJS Paris interior',
				),
				array(
					'key'   => 'field_djs_about_tab_story_2',
					'label' => 'Story block 2',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_about_story_2_eyebrow',
					'label'         => 'Story block 2 eyebrow',
					'name'          => 'djs_about_story_2_eyebrow',
					'type'          => 'text',
					'default_value' => "Aujourd'hui",
				),
				array(
					'key'           => 'field_djs_about_story_2_title',
					'label'         => 'Story block 2 title',
					'name'          => 'djs_about_story_2_title',
					'type'          => 'text',
					'default_value' => 'Un vestiaire pour les femmes et hommes modernes',
				),
				array(
					'key'           => 'field_djs_about_story_2_text_1',
					'label'         => 'Story block 2 paragraph 1',
					'name'          => 'djs_about_story_2_text_1',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => "Aujourd'hui, DJS Paris imagine une maison de mode intemporelle, ouverte sur le monde.\nDes pièces épurées, conçues pour être portées avec aisance, encore et encore.",
				),
				array(
					'key'           => 'field_djs_about_story_2_text_2',
					'label'         => 'Story block 2 paragraph 2',
					'name'          => 'djs_about_story_2_text_2',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => "Notre vestiaire s'adresse à un client exigeant qui cherche des pièces durables,\npoétiques et pensées pour accompagner tous les gestes du quotidien.",
				),
				array(
					'key'           => 'field_djs_about_story_2_image',
					'label'         => 'Story block 2 image',
					'name'          => 'djs_about_story_2_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => 'Optional. If empty, the current default image will be used.',
				),
				array(
					'key'           => 'field_djs_about_story_2_image_alt',
					'label'         => 'Story block 2 image alt',
					'name'          => 'djs_about_story_2_image_alt',
					'type'          => 'text',
					'default_value' => 'DJS Paris fashion portrait',
				),
				array(
					'key'   => 'field_djs_about_tab_values',
					'label' => 'Values',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_about_values_eyebrow',
					'label'         => 'Values eyebrow',
					'name'          => 'djs_about_values_eyebrow',
					'type'          => 'text',
					'default_value' => 'Nos valeurs',
				),
				array(
					'key'           => 'field_djs_about_values_title',
					'label'         => 'Values title',
					'name'          => 'djs_about_values_title',
					'type'          => 'text',
					'default_value' => 'Ce qui nous définit',
				),
				array(
					'key'           => 'field_djs_about_value_1_number',
					'label'         => 'Value 1 number',
					'name'          => 'djs_about_value_1_number',
					'type'          => 'text',
					'default_value' => '01',
				),
				array(
					'key'           => 'field_djs_about_value_1_label',
					'label'         => 'Value 1 label',
					'name'          => 'djs_about_value_1_label',
					'type'          => 'text',
					'default_value' => 'Artisanat',
				),
				array(
					'key'           => 'field_djs_about_value_1_text',
					'label'         => 'Value 1 text',
					'name'          => 'djs_about_value_1_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Chaque pièce est pensée et confectionnée avec soin, sens du détail et maîtrise du geste.',
				),
				array(
					'key'           => 'field_djs_about_value_2_number',
					'label'         => 'Value 2 number',
					'name'          => 'djs_about_value_2_number',
					'type'          => 'text',
					'default_value' => '02',
				),
				array(
					'key'           => 'field_djs_about_value_2_label',
					'label'         => 'Value 2 label',
					'name'          => 'djs_about_value_2_label',
					'type'          => 'text',
					'default_value' => 'Durabilité',
				),
				array(
					'key'           => 'field_djs_about_value_2_text',
					'label'         => 'Value 2 text',
					'name'          => 'djs_about_value_2_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "Nous privilégions les matières d'exception et une production raisonnée pour accompagner le temps.",
				),
				array(
					'key'           => 'field_djs_about_value_3_number',
					'label'         => 'Value 3 number',
					'name'          => 'djs_about_value_3_number',
					'type'          => 'text',
					'default_value' => '03',
				),
				array(
					'key'           => 'field_djs_about_value_3_label',
					'label'         => 'Value 3 label',
					'name'          => 'djs_about_value_3_label',
					'type'          => 'text',
					'default_value' => 'Intemporalité',
				),
				array(
					'key'           => 'field_djs_about_value_3_text',
					'label'         => 'Value 3 text',
					'name'          => 'djs_about_value_3_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => 'Nos collections refusent les tendances rapides pour révéler une élégance durable et sereine.',
				),
				array(
					'key'           => 'field_djs_about_value_4_number',
					'label'         => 'Value 4 number',
					'name'          => 'djs_about_value_4_number',
					'type'          => 'text',
					'default_value' => '04',
				),
				array(
					'key'           => 'field_djs_about_value_4_label',
					'label'         => 'Value 4 label',
					'name'          => 'djs_about_value_4_label',
					'type'          => 'text',
					'default_value' => 'Transparence',
				),
				array(
					'key'           => 'field_djs_about_value_4_text',
					'label'         => 'Value 4 text',
					'name'          => 'djs_about_value_4_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "Nous racontons l'origine de nos matières et la manière dont chaque vêtement prend vie.",
				),
				array(
					'key'   => 'field_djs_about_tab_quote',
					'label' => 'Quote',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_about_quote_text',
					'label'         => 'Quote text',
					'name'          => 'djs_about_quote_text',
					'type'          => 'textarea',
					'rows'          => 3,
					'default_value' => "\"La vraie luxe, c'est de pouvoir choisir ce qui est beau,\njuste et durable.\"",
				),
				array(
					'key'           => 'field_djs_about_quote_meta',
					'label'         => 'Quote meta',
					'name'          => 'djs_about_quote_meta',
					'type'          => 'text',
					'default_value' => '— Fondateur, DJS Paris',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'templates/about-page.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'djs_register_about_page_acf_fields' );
