<?php
/**
 * Template Name: About Page
 *
 * @package DJS
 */

get_header();

$djs_about_defaults = array(
	'hero_image_url'      => 'http://localhost/djs/wp-content/uploads/2026/03/215a4a6640b84ceebf93c217ad89e39e4fe400aa.jpg',
	'hero_image_alt'      => 'DJS Paris boutique',
	'hero_eyebrow'        => 'Notre histoire',
	'hero_title'          => 'DJS Paris',
	'hero_signature'      => 'Depuis 1998',
	'intro_eyebrow'       => 'Notre philosophie',
	'intro_quote'         => "Nous créons des vêtements qui transcendent les saisons, des\npièces conçues pour durer, pour voyager avec vous, et pour\nraconter votre histoire.",
	'story_1_eyebrow'     => '1998 — Les origines',
	'story_1_title'       => "Née d'une passion pour l'excellence",
	'story_1_text_1'      => "DJS Paris est née de la volonté d'offrir des pièces pensées pour traverser le temps\net accompagner une allure sensible et assurée. Dans notre premier atelier de la\nMaison Saint-Honoré, nous avons façonné une vision exigeante, entre tradition et grâce.",
	'story_1_text_2'      => "Chaque collection raconte l'histoire d'un savoir-faire transmis de génération en\ngénération, et d'un regard précis pour les matières nobles et les coupes d'une justesse rare.",
	'story_1_image_url'   => 'http://localhost/djs/wp-content/uploads/2026/03/5df03a1e2d35d0ac2e792d3490f0f97f95fa4c38.jpg',
	'story_1_image_alt'   => 'DJS Paris interior',
	'story_2_eyebrow'     => "Aujourd'hui",
	'story_2_title'       => 'Un vestiaire pour les femmes et hommes modernes',
	'story_2_text_1'      => "Aujourd'hui, DJS Paris imagine une maison de mode intemporelle, ouverte sur le monde.\nDes pièces épurées, conçues pour être portées avec aisance, encore et encore.",
	'story_2_text_2'      => "Notre vestiaire s'adresse à un client exigeant qui cherche des pièces durables,\npoétiques et pensées pour accompagner tous les gestes du quotidien.",
	'story_2_image_url'   => 'http://localhost/djs/wp-content/uploads/2026/03/4dd2e8afa57068b136e2609a21530fef9b6dcfff.jpg',
	'story_2_image_alt'   => 'DJS Paris fashion portrait',
	'values_eyebrow'      => 'Nos valeurs',
	'values_title'        => 'Ce qui nous définit',
	'value_1_number'      => '01',
	'value_1_label'       => 'Artisanat',
	'value_1_text'        => 'Chaque pièce est pensée et confectionnée avec soin, sens du détail et maîtrise du geste.',
	'value_2_number'      => '02',
	'value_2_label'       => 'Durabilité',
	'value_2_text'        => "Nous privilégions les matières d'exception et une production raisonnée pour accompagner le temps.",
	'value_3_number'      => '03',
	'value_3_label'       => 'Intemporalité',
	'value_3_text'        => 'Nos collections refusent les tendances rapides pour révéler une élégance durable et sereine.',
	'value_4_number'      => '04',
	'value_4_label'       => 'Transparence',
	'value_4_text'        => "Nous racontons l'origine de nos matières et la manière dont chaque vêtement prend vie.",
	'quote_text'          => "\"La vraie luxe, c'est de pouvoir choisir ce qui est beau,\njuste et durable.\"",
	'quote_meta'          => '— Fondateur, DJS Paris',
);

$djs_about_get_field = static function ( $name ) use ( $djs_about_defaults ) {
	$field_key = 'djs_about_' . $name;
	$value     = function_exists( 'get_field' ) ? get_field( $field_key ) : null;

	if ( null === $value || '' === $value ) {
		return $djs_about_defaults[ $name ];
	}

	return $value;
};

$djs_about_get_image = static function ( $name ) use ( $djs_about_get_field ) {
	$image = $djs_about_get_field( $name . '_image' );

	if ( is_array( $image ) && ! empty( $image['url'] ) ) {
		return array(
			'url' => $image['url'],
			'alt' => ! empty( $image['alt'] ) ? $image['alt'] : $djs_about_get_field( $name . '_image_alt' ),
		);
	}

	return array(
		'url' => $djs_about_get_field( $name . '_image_url' ),
		'alt' => $djs_about_get_field( $name . '_image_alt' ),
	);
};

$about_hero_image    = $djs_about_get_image( 'hero' );
$about_story_1_image = $djs_about_get_image( 'story_1' );
$about_story_2_image = $djs_about_get_image( 'story_2' );

$about_values = array(
	array(
		'number' => $djs_about_get_field( 'value_1_number' ),
		'label'  => $djs_about_get_field( 'value_1_label' ),
		'text'   => $djs_about_get_field( 'value_1_text' ),
	),
	array(
		'number' => $djs_about_get_field( 'value_2_number' ),
		'label'  => $djs_about_get_field( 'value_2_label' ),
		'text'   => $djs_about_get_field( 'value_2_text' ),
	),
	array(
		'number' => $djs_about_get_field( 'value_3_number' ),
		'label'  => $djs_about_get_field( 'value_3_label' ),
		'text'   => $djs_about_get_field( 'value_3_text' ),
	),
	array(
		'number' => $djs_about_get_field( 'value_4_number' ),
		'label'  => $djs_about_get_field( 'value_4_label' ),
		'text'   => $djs_about_get_field( 'value_4_text' ),
	),
);
?>

<main class="djs-about-page">
	<section class="djs-about-hero">
		<div class="djs-about-hero__bg">
			<img src="<?php echo esc_url( $about_hero_image['url'] ); ?>" alt="<?php echo esc_attr( $about_hero_image['alt'] ); ?>">
		</div>

		<div class="djs-about-hero__overlay"></div>

		<div class="djs-about-hero__content">
			<div class="djs-about-hero__eyebrow"><?php echo esc_html( $djs_about_get_field( 'hero_eyebrow' ) ); ?></div>
			<h1 class="djs-about-hero__title"><?php echo esc_html( $djs_about_get_field( 'hero_title' ) ); ?></h1>
			<div class="djs-about-hero__signature"><?php echo esc_html( $djs_about_get_field( 'hero_signature' ) ); ?></div>
		</div>
	</section>

	<section class="djs-about-intro">
		<div class="djs-container">
			<div class="djs-about-intro__inner">
				<div class="djs-about-intro__eyebrow"><?php echo esc_html( $djs_about_get_field( 'intro_eyebrow' ) ); ?></div>
				<h2 class="djs-about-intro__quote">
					<?php echo nl2br( esc_html( $djs_about_get_field( 'intro_quote' ) ) ); ?>
				</h2>
			</div>
		</div>
	</section>

	<section class="djs-about-story djs-about-story--first">
		<div class="djs-container">
			<div class="djs-about-story__grid">
				<div class="djs-about-story__content">
					<div class="djs-about-story__eyebrow"><?php echo esc_html( $djs_about_get_field( 'story_1_eyebrow' ) ); ?></div>
					<h2 class="djs-about-story__title"><?php echo esc_html( $djs_about_get_field( 'story_1_title' ) ); ?></h2>
					<p><?php echo nl2br( esc_html( $djs_about_get_field( 'story_1_text_1' ) ) ); ?></p>
					<p><?php echo nl2br( esc_html( $djs_about_get_field( 'story_1_text_2' ) ) ); ?></p>
				</div>

				<div class="djs-about-story__media">
					<img src="<?php echo esc_url( $about_story_1_image['url'] ); ?>" alt="<?php echo esc_attr( $about_story_1_image['alt'] ); ?>">
				</div>
			</div>
		</div>
	</section>

	<section class="djs-about-story djs-about-story--reverse">
		<div class="djs-container">
			<div class="djs-about-story__grid">
				<div class="djs-about-story__media">
					<img src="<?php echo esc_url( $about_story_2_image['url'] ); ?>" alt="<?php echo esc_attr( $about_story_2_image['alt'] ); ?>">
				</div>

				<div class="djs-about-story__content">
					<div class="djs-about-story__eyebrow"><?php echo esc_html( $djs_about_get_field( 'story_2_eyebrow' ) ); ?></div>
					<h2 class="djs-about-story__title"><?php echo esc_html( $djs_about_get_field( 'story_2_title' ) ); ?></h2>
					<p><?php echo nl2br( esc_html( $djs_about_get_field( 'story_2_text_1' ) ) ); ?></p>
					<p><?php echo nl2br( esc_html( $djs_about_get_field( 'story_2_text_2' ) ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="djs-about-values">
		<div class="djs-container">
			<div class="djs-about-values__inner">
				<div class="djs-about-values__eyebrow"><?php echo esc_html( $djs_about_get_field( 'values_eyebrow' ) ); ?></div>
				<h2 class="djs-about-values__title"><?php echo esc_html( $djs_about_get_field( 'values_title' ) ); ?></h2>

				<div class="djs-about-values__grid">
					<?php foreach ( $about_values as $about_value ) : ?>
						<div class="djs-about-value">
							<div class="djs-about-value__number"><?php echo esc_html( $about_value['number'] ); ?></div>
							<h3 class="djs-about-value__label"><?php echo esc_html( $about_value['label'] ); ?></h3>
							<p><?php echo esc_html( $about_value['text'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="djs-about-quote">
		<div class="djs-container">
			<div class="djs-about-quote__inner">
				<blockquote class="djs-about-quote__text">
					<?php echo nl2br( esc_html( $djs_about_get_field( 'quote_text' ) ) ); ?>
				</blockquote>
				<div class="djs-about-quote__meta"><?php echo esc_html( $djs_about_get_field( 'quote_meta' ) ); ?></div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
