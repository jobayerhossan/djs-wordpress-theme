<?php
/**
 * Contact page ACF fields.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register local ACF fields for the contact page template.
 */
function djs_register_contact_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_djs_contact_page',
			'title'  => 'DJS Contact Page',
			'fields' => array(
				array(
					'key'   => 'field_djs_contact_tab_hero',
					'label' => 'Hero',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_contact_hero_eyebrow',
					'label'         => 'Hero eyebrow',
					'name'          => 'djs_contact_hero_eyebrow',
					'type'          => 'text',
					'default_value' => 'Nous contacter',
				),
				array(
					'key'           => 'field_djs_contact_hero_title',
					'label'         => 'Hero title',
					'name'          => 'djs_contact_hero_title',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => "Nous sommes\nà votre écoute",
				),
				array(
					'key'   => 'field_djs_contact_tab_form',
					'label' => 'Form',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_contact_form_title',
					'label'         => 'Form title',
					'name'          => 'djs_contact_form_title',
					'type'          => 'text',
					'default_value' => 'Envoyez-nous un message',
				),
				array(
					'key'           => 'field_djs_contact_name_label',
					'label'         => 'Name label',
					'name'          => 'djs_contact_name_label',
					'type'          => 'text',
					'default_value' => 'Nom *',
				),
				array(
					'key'           => 'field_djs_contact_name_placeholder',
					'label'         => 'Name placeholder',
					'name'          => 'djs_contact_name_placeholder',
					'type'          => 'text',
					'default_value' => 'Votre nom',
				),
				array(
					'key'           => 'field_djs_contact_email_label',
					'label'         => 'Email label',
					'name'          => 'djs_contact_email_label',
					'type'          => 'text',
					'default_value' => 'Email *',
				),
				array(
					'key'           => 'field_djs_contact_email_placeholder',
					'label'         => 'Email placeholder',
					'name'          => 'djs_contact_email_placeholder',
					'type'          => 'text',
					'default_value' => 'votre@email.com',
				),
				array(
					'key'           => 'field_djs_contact_subject_label',
					'label'         => 'Subject label',
					'name'          => 'djs_contact_subject_label',
					'type'          => 'text',
					'default_value' => 'Sujet *',
				),
				array(
					'key'           => 'field_djs_contact_subject_placeholder',
					'label'         => 'Subject placeholder',
					'name'          => 'djs_contact_subject_placeholder',
					'type'          => 'text',
					'default_value' => '',
				),
				array(
					'key'           => 'field_djs_contact_message_label',
					'label'         => 'Message label',
					'name'          => 'djs_contact_message_label',
					'type'          => 'text',
					'default_value' => 'Message *',
				),
				array(
					'key'           => 'field_djs_contact_message_placeholder',
					'label'         => 'Message placeholder',
					'name'          => 'djs_contact_message_placeholder',
					'type'          => 'text',
					'default_value' => 'Votre message...',
				),
				array(
					'key'           => 'field_djs_contact_submit_text',
					'label'         => 'Submit button text',
					'name'          => 'djs_contact_submit_text',
					'type'          => 'text',
					'default_value' => 'Envoyer le message',
				),
				array(
					'key'   => 'field_djs_contact_tab_details',
					'label' => 'Contact details',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_contact_details_title',
					'label'         => 'Details title',
					'name'          => 'djs_contact_details_title',
					'type'          => 'text',
					'default_value' => 'Nos coordonnées',
				),
				array(
					'key'           => 'field_djs_contact_store_title',
					'label'         => 'Store title',
					'name'          => 'djs_contact_store_title',
					'type'          => 'text',
					'default_value' => 'Boutique',
				),
				array(
					'key'           => 'field_djs_contact_store_line_1',
					'label'         => 'Store address line 1',
					'name'          => 'djs_contact_store_line_1',
					'type'          => 'text',
					'default_value' => '12 Rue du Faubourg Saint-Honoré',
				),
				array(
					'key'           => 'field_djs_contact_store_line_2',
					'label'         => 'Store address line 2',
					'name'          => 'djs_contact_store_line_2',
					'type'          => 'text',
					'default_value' => '75008 Paris, France',
				),
				array(
					'key'           => 'field_djs_contact_hours_title',
					'label'         => 'Opening hours title',
					'name'          => 'djs_contact_hours_title',
					'type'          => 'text',
					'default_value' => 'Horaires d’ouverture',
				),
				array(
					'key'           => 'field_djs_contact_hours_line_1',
					'label'         => 'Opening hours line 1',
					'name'          => 'djs_contact_hours_line_1',
					'type'          => 'text',
					'default_value' => 'Lundi — Samedi : 10h00 — 19h30',
				),
				array(
					'key'           => 'field_djs_contact_hours_line_2',
					'label'         => 'Opening hours line 2',
					'name'          => 'djs_contact_hours_line_2',
					'type'          => 'text',
					'default_value' => 'Dimanche : 11h00 — 18h00',
				),
				array(
					'key'           => 'field_djs_contact_email_title',
					'label'         => 'Email section title',
					'name'          => 'djs_contact_email_title',
					'type'          => 'text',
					'default_value' => 'Email',
				),
				array(
					'key'           => 'field_djs_contact_email_1',
					'label'         => 'Email 1',
					'name'          => 'djs_contact_email_1',
					'type'          => 'email',
					'default_value' => 'contact@djs-paris.com',
				),
				array(
					'key'           => 'field_djs_contact_email_2',
					'label'         => 'Email 2',
					'name'          => 'djs_contact_email_2',
					'type'          => 'email',
					'default_value' => 'presse@djs-paris.com',
				),
				array(
					'key'           => 'field_djs_contact_phone_title',
					'label'         => 'Phone section title',
					'name'          => 'djs_contact_phone_title',
					'type'          => 'text',
					'default_value' => 'Téléphone',
				),
				array(
					'key'           => 'field_djs_contact_phone_number',
					'label'         => 'Phone number',
					'name'          => 'djs_contact_phone_number',
					'type'          => 'text',
					'default_value' => '+33 1 42 00 00 00',
				),
				array(
					'key'   => 'field_djs_contact_tab_social',
					'label' => 'Social and map',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_djs_contact_follow_label',
					'label'         => 'Follow label',
					'name'          => 'djs_contact_follow_label',
					'type'          => 'text',
					'default_value' => 'Suivez-nous',
				),
				array(
					'key'           => 'field_djs_contact_social_1_label',
					'label'         => 'Social link 1 label',
					'name'          => 'djs_contact_social_1_label',
					'type'          => 'text',
					'default_value' => '@djsparis',
				),
				array(
					'key'           => 'field_djs_contact_social_1_url',
					'label'         => 'Social link 1 URL',
					'name'          => 'djs_contact_social_1_url',
					'type'          => 'url',
					'default_value' => '#',
				),
				array(
					'key'           => 'field_djs_contact_social_2_label',
					'label'         => 'Social link 2 label',
					'name'          => 'djs_contact_social_2_label',
					'type'          => 'text',
					'default_value' => 'DJS Paris',
				),
				array(
					'key'           => 'field_djs_contact_social_2_url',
					'label'         => 'Social link 2 URL',
					'name'          => 'djs_contact_social_2_url',
					'type'          => 'url',
					'default_value' => '#',
				),
				array(
					'key'           => 'field_djs_contact_map_text',
					'label'         => 'Map placeholder text',
					'name'          => 'djs_contact_map_text',
					'type'          => 'text',
					'default_value' => 'Carte interactive',
				),
				array(
					'key'           => 'field_djs_contact_map_embed',
					'label'         => 'Map embed code',
					'name'          => 'djs_contact_map_embed',
					'type'          => 'textarea',
					'rows'          => 5,
					'instructions'  => 'Optional. Paste iframe/embed HTML here. If empty, the placeholder text will be shown.',
					'default_value' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'templates/contact-page.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'djs_register_contact_page_acf_fields' );
