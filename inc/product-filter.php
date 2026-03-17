<?php 
/**
 * AJAX product filter
 */
function djs_ajax_filter_products() {
	check_ajax_referer( 'djs_ajax_nonce', 'nonce' );

	$paged       = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : 1;
	$order       = isset( $_POST['order'] ) ? sanitize_text_field( $_POST['order'] ) : 'menu_order';
	$categories  = isset( $_POST['categories'] ) ? array_map( 'sanitize_text_field', (array) $_POST['categories'] ) : array();
	$genre       = isset( $_POST['genre'] ) ? array_map( 'sanitize_text_field', (array) $_POST['genre'] ) : array();
	$color       = isset( $_POST['color'] ) ? array_map( 'sanitize_text_field', (array) $_POST['color'] ) : array();
	$size        = isset( $_POST['size'] ) ? array_map( 'sanitize_text_field', (array) $_POST['size'] ) : array();
	$current_id  = isset( $_POST['current_term_id'] ) ? absint( $_POST['current_term_id'] ) : 0;
	$current_tax = isset( $_POST['current_taxonomy'] ) ? sanitize_text_field( $_POST['current_taxonomy'] ) : '';
	$search_term = isset( $_POST['search_term'] ) ? sanitize_text_field( wp_unslash( $_POST['search_term'] ) ) : '';

	$tax_query = array(
		'relation' => 'AND',
	);

	/**
	 * Keep current archive context only if the matching taxonomy
	 * is NOT already being filtered manually from query string.
	 */
	if ( $current_id && $current_tax ) {
		$skip_current_context = false;

		if ( 'product_cat' === $current_tax && ! empty( $categories ) ) {
			$skip_current_context = true;
		}

		if ( 'pa_genre' === $current_tax && ! empty( $genre ) ) {
			$skip_current_context = true;
		}

		if ( 'pa_couleurs' === $current_tax && ! empty( $color ) ) {
			$skip_current_context = true;
		}

		if ( 'pa_taille' === $current_tax && ! empty( $size ) ) {
			$skip_current_context = true;
		}

		if ( ! $skip_current_context ) {
			$tax_query[] = array(
				'taxonomy' => $current_tax,
				'field'    => 'term_id',
				'terms'    => array( $current_id ),
			);
		}
	}

	if ( ! empty( $categories ) ) {
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $categories,
		);
	}

	if ( ! empty( $genre ) ) {
		$tax_query[] = array(
			'taxonomy' => 'pa_genre',
			'field'    => 'slug',
			'terms'    => $genre,
		);
	}

	if ( ! empty( $color ) ) {
		$tax_query[] = array(
			'taxonomy' => 'pa_couleurs',
			'field'    => 'slug',
			'terms'    => $color,
		);
	}

	if ( ! empty( $size ) ) {
		$tax_query[] = array(
			'taxonomy' => 'pa_taille',
			'field'    => 'slug',
			'terms'    => $size,
		);
	}

	$args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'paged'          => $paged,
		'posts_per_page' => 9,
		'tax_query'      => count( $tax_query ) > 1 ? $tax_query : array(),
	);

	if ( ! empty( $search_term ) ) {
		$args['s'] = $search_term;
	}

	switch ( $order ) {
		case 'date':
			$args['orderby'] = 'date';
			$args['order']   = 'DESC';
			break;

		case 'price_asc':
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = '_price';
			$args['order']    = 'ASC';
			break;

		case 'price_desc':
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = '_price';
			$args['order']    = 'DESC';
			break;

		case 'menu_order':
		default:
			$args['orderby'] = array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			);
			break;
	}

	$query = new WP_Query( $args );

	ob_start();

	if ( $query->have_posts() ) {
		woocommerce_product_loop_start();

		while ( $query->have_posts() ) {
			$query->the_post();
			wc_get_template_part( 'content', 'product' );
		}

		woocommerce_product_loop_end();
	} else {
		echo '<div class="djs-no-products">
					<h2>Aucun résultat</h2>
					<p>Modifiez vos filtres pour afficher des produits.</p>
					<button class="btn btn-border djs-filter-reset">Effacer les filtres</button>
				</div>';
	}

	$products_html = ob_get_clean();

	ob_start();

	$pagination = paginate_links(
		array(
			'total'      => $query->max_num_pages,
			'current'    => max( 1, $paged ),
			'prev_text'  => '&larr;',
			'next_text'  => '&rarr;',
			'type'       => 'list',
		)
	);

	if ( $pagination ) {
		echo $pagination;
	}

	$pagination_html = ob_get_clean();

	wp_reset_postdata();

	wp_send_json_success(
		array(
			'products'   => $products_html,
			'pagination' => $pagination_html,
			'found'      => intval( $query->found_posts ),
			'max_pages'  => intval( $query->max_num_pages ),
		)
	);
}
add_action( 'wp_ajax_djs_ajax_filter_products', 'djs_ajax_filter_products' );
add_action( 'wp_ajax_nopriv_djs_ajax_filter_products', 'djs_ajax_filter_products' );