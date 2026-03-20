<?php
/**
 * Template Name: Contact Page
 *
 * @package DJS
 */

get_header();

$djs_contact_defaults = array(
	'hero_eyebrow'         => 'Nous contacter',
	'hero_title'           => "Nous sommes\nà votre écoute",
	'form_title'           => 'Envoyez-nous un message',
	'name_label'           => 'Nom *',
	'name_placeholder'     => 'Votre nom',
	'email_label'          => 'Email *',
	'email_placeholder'    => 'votre@email.com',
	'subject_label'        => 'Sujet *',
	'subject_placeholder'  => '',
	'message_label'        => 'Message *',
	'message_placeholder'  => 'Votre message...',
	'submit_text'          => 'Envoyer le message',
	'details_title'        => 'Nos coordonnées',
	'store_title'          => 'Boutique',
	'store_line_1'         => '12 Rue du Faubourg Saint-Honoré',
	'store_line_2'         => '75008 Paris, France',
	'hours_title'          => 'Horaires d’ouverture',
	'hours_line_1'         => 'Lundi — Samedi : 10h00 — 19h30',
	'hours_line_2'         => 'Dimanche : 11h00 — 18h00',
	'email_title'          => 'Email',
	'email_1'              => 'contact@djs-paris.com',
	'email_2'              => 'presse@djs-paris.com',
	'phone_title'          => 'Téléphone',
	'phone_number'         => '+33 1 42 00 00 00',
	'follow_label'         => 'Suivez-nous',
	'social_1_label'       => '@djsparis',
	'social_1_url'         => '#',
	'social_2_label'       => 'DJS Paris',
	'social_2_url'         => '#',
	'map_text'             => 'Carte interactive',
	'map_embed'            => '',
);

$djs_contact_get_field = static function ( $name ) use ( $djs_contact_defaults ) {
	$field_key = 'djs_contact_' . $name;
	$value     = function_exists( 'get_field' ) ? get_field( $field_key ) : null;

	if ( null === $value || '' === $value ) {
		return $djs_contact_defaults[ $name ];
	}

	return $value;
};
?>

<main class="djs-contact-page">
	<section class="djs-contact-page__hero">
		<div class="djs-container">
			<div class="djs-contact-page__hero-inner">
				<div class="djs-contact-page__eyebrow"><?php echo esc_html( $djs_contact_get_field( 'hero_eyebrow' ) ); ?></div>
				<h1 class="djs-contact-page__title"><?php echo nl2br( esc_html( $djs_contact_get_field( 'hero_title' ) ) ); ?></h1>
			</div>
		</div>
	</section>

	<section class="djs-contact-page__content">
		<div class="djs-container">
			<div class="djs-contact-layout">
				<div class="djs-contact-form-wrap">
					<h2 class="djs-contact-section-title"><?php echo esc_html( $djs_contact_get_field( 'form_title' ) ); ?></h2>

					<form class="djs-contact-form" id="djs-contact-form" novalidate>
						<div class="djs-contact-form__grid">
							<div class="djs-contact-field">
								<label for="djs-contact-name"><?php echo esc_html( $djs_contact_get_field( 'name_label' ) ); ?></label>
								<input type="text" id="djs-contact-name" name="name" placeholder="<?php echo esc_attr( $djs_contact_get_field( 'name_placeholder' ) ); ?>" required>
							</div>

							<div class="djs-contact-field">
								<label for="djs-contact-email"><?php echo esc_html( $djs_contact_get_field( 'email_label' ) ); ?></label>
								<input type="email" id="djs-contact-email" name="email" placeholder="<?php echo esc_attr( $djs_contact_get_field( 'email_placeholder' ) ); ?>" required>
							</div>
						</div>

						<div class="djs-contact-field">
							<label for="djs-contact-subject"><?php echo esc_html( $djs_contact_get_field( 'subject_label' ) ); ?></label>
							<input type="text" id="djs-contact-subject" name="subject" placeholder="<?php echo esc_attr( $djs_contact_get_field( 'subject_placeholder' ) ); ?>" required>
						</div>

						<div class="djs-contact-field">
							<label for="djs-contact-message"><?php echo esc_html( $djs_contact_get_field( 'message_label' ) ); ?></label>
							<textarea id="djs-contact-message" name="message" placeholder="<?php echo esc_attr( $djs_contact_get_field( 'message_placeholder' ) ); ?>" required></textarea>
						</div>

						

						<button type="submit" class="djs-contact-form__submit">
							<?php echo esc_html( $djs_contact_get_field( 'submit_text' ) ); ?>
						</button>

						<div class="djs-contact-form__status" aria-live="polite"></div>
					</form>
				</div>

				<div class="djs-contact-info">
					<h2 class="djs-contact-section-title"><?php echo esc_html( $djs_contact_get_field( 'details_title' ) ); ?></h2>

					<div class="djs-contact-info__list">
						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><path d="M12 21s-6-5.29-6-11a6 6 0 1 1 12 0c0 5.71-6 11-6 11Z" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3><?php echo esc_html( $djs_contact_get_field( 'store_title' ) ); ?></h3>
								<p><?php echo esc_html( $djs_contact_get_field( 'store_line_1' ) ); ?></p>
								<p><?php echo esc_html( $djs_contact_get_field( 'store_line_2' ) ); ?></p>
							</div>
						</div>

						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M12 8v4l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3><?php echo esc_html( $djs_contact_get_field( 'hours_title' ) ); ?></h3>
								<p><?php echo esc_html( $djs_contact_get_field( 'hours_line_1' ) ); ?></p>
								<p><?php echo esc_html( $djs_contact_get_field( 'hours_line_2' ) ); ?></p>
							</div>
						</div>

						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><path d="M4 7.5 12 13l8-5.5" stroke="currentColor" stroke-width="1.5"/><rect x="3.25" y="5.25" width="17.5" height="13.5" rx="1.75" stroke="currentColor" stroke-width="1.5"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3><?php echo esc_html( $djs_contact_get_field( 'email_title' ) ); ?></h3>
								<p><a href="mailto:<?php echo antispambot( esc_attr( $djs_contact_get_field( 'email_1' ) ) ); ?>"><?php echo esc_html( antispambot( $djs_contact_get_field( 'email_1' ) ) ); ?></a></p>
								<p><a href="mailto:<?php echo antispambot( esc_attr( $djs_contact_get_field( 'email_2' ) ) ); ?>"><?php echo esc_html( antispambot( $djs_contact_get_field( 'email_2' ) ) ); ?></a></p>
							</div>
						</div>

						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><path d="M7.5 4.5h2l1.1 4.2-1.8 1.8a14 14 0 0 0 4.9 4.9l1.8-1.8 4.2 1.1v2a1.5 1.5 0 0 1-1.5 1.5A15.75 15.75 0 0 1 4.5 6A1.5 1.5 0 0 1 6 4.5h1.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3><?php echo esc_html( $djs_contact_get_field( 'phone_title' ) ); ?></h3>
								<p><a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $djs_contact_get_field( 'phone_number' ) ) ); ?>"><?php echo esc_html( $djs_contact_get_field( 'phone_number' ) ); ?></a></p>
							</div>
						</div>
					</div>

					<div class="djs-contact-follow">
						<div class="djs-contact-follow__label"><?php echo esc_html( $djs_contact_get_field( 'follow_label' ) ); ?></div>
						<div class="djs-contact-follow__links">
							<a href="<?php echo esc_url( $djs_contact_get_field( 'social_1_url' ) ); ?>" aria-label="<?php echo esc_attr( $djs_contact_get_field( 'social_1_label' ) ); ?>"><?php echo esc_html( $djs_contact_get_field( 'social_1_label' ) ); ?></a>
							<a href="<?php echo esc_url( $djs_contact_get_field( 'social_2_url' ) ); ?>" aria-label="<?php echo esc_attr( $djs_contact_get_field( 'social_2_label' ) ); ?>"><?php echo esc_html( $djs_contact_get_field( 'social_2_label' ) ); ?></a>
						</div>
					</div>

					<div class="djs-contact-map-placeholder">
						<?php if ( $djs_contact_get_field( 'map_embed' ) ) : ?>
							<?php echo wp_kses_post( $djs_contact_get_field( 'map_embed' ) ); ?>
						<?php else : ?>
							<?php echo esc_html( $djs_contact_get_field( 'map_text' ) ); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
