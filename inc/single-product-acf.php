<?php
/**
 * Local ACF fields for the single product layout.
 *
 * @package DJS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register local ACF fields for WooCommerce products.
 */
function djs_register_single_product_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_djs_single_product',
			'title'  => 'DJS Single Product',
			'fields' => array(
				array(
					'key'           => 'field_djs_product_badge',
					'label'         => 'Product badge',
					'name'          => 'djs_product_badge',
					'type'          => 'text',
					'instructions'  => 'Optional label shown under the price, for example Nouveau.',
					'default_value' => '',
				),
				array(
					'key'           => 'field_djs_size_guide_url',
					'label'         => 'Size guide URL',
					'name'          => 'djs_size_guide_url',
					'type'          => 'url',
					'instructions'  => 'Optional link displayed next to the size selector.',
					'default_value' => '',
				),
				array(
					'key'           => 'field_djs_find_my_size_url',
					'label'         => 'Find my size URL',
					'name'          => 'djs_find_my_size_url',
					'type'          => 'url',
					'instructions'  => 'Optional helper link displayed below the variation selector.',
					'default_value' => '',
				),
				array(
					'key'           => 'field_djs_size_fit_content',
					'label'         => 'Size & fit content',
					'name'          => 'djs_size_fit_content',
					'type'          => 'wysiwyg',
					'tabs'          => 'all',
					'toolbar'       => 'basic',
					'media_upload'  => 0,
					'instructions'  => 'Content for the Taille & coupes accordion.',
				),
				array(
					'key'           => 'field_djs_composition_care_content',
					'label'         => 'Composition & care content',
					'name'          => 'djs_composition_care_content',
					'type'          => 'wysiwyg',
					'tabs'          => 'all',
					'toolbar'       => 'basic',
					'media_upload'  => 0,
					'instructions'  => 'Content for the Composition & guide d’entretien accordion.',
				),
				array(
					'key'           => 'field_djs_responsibility_content',
					'label'         => 'Responsibility content',
					'name'          => 'djs_responsibility_content',
					'type'          => 'wysiwyg',
					'tabs'          => 'all',
					'toolbar'       => 'basic',
					'media_upload'  => 0,
					'instructions'  => 'Content for the Responsabilité accordion.',
				),
				array(
					'key'           => 'field_djs_delivery_returns_content',
					'label'         => 'Delivery & returns content',
					'name'          => 'djs_delivery_returns_content',
					'type'          => 'wysiwyg',
					'tabs'          => 'all',
					'toolbar'       => 'basic',
					'media_upload'  => 0,
					'instructions'  => 'Content for the Livraisons et retours accordion.',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'product',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'djs_register_single_product_acf_fields' );
