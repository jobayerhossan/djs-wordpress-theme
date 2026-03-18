<?php
/**
 * Template Name: Contact Page
 *
 * @package DJS
 */

get_header();
?>

<main class="djs-contact-page">
	<section class="djs-contact-page__hero">
		<div class="djs-container">
			<div class="djs-contact-page__hero-inner">
				<div class="djs-contact-page__eyebrow">Nous contacter</div>
				<h1 class="djs-contact-page__title">Nous sommes<br>à votre écoute</h1>
			</div>
		</div>
	</section>

	<section class="djs-contact-page__content">
		<div class="djs-container">
			<div class="djs-contact-layout">
				<div class="djs-contact-form-wrap">
					<h2 class="djs-contact-section-title">Envoyez-nous un message</h2>

					<form class="djs-contact-form" id="djs-contact-form" novalidate>
						<div class="djs-contact-form__grid">
							<div class="djs-contact-field">
								<label for="djs-contact-name">Nom *</label>
								<input type="text" id="djs-contact-name" name="name" placeholder="Votre nom" required>
							</div>

							<div class="djs-contact-field">
								<label for="djs-contact-email">Email *</label>
								<input type="email" id="djs-contact-email" name="email" placeholder="votre@email.com" required>
							</div>
						</div>

						<div class="djs-contact-field">
							<label for="djs-contact-subject">Sujet *</label>
							<input type="text" id="djs-contact-subject" name="subject" required>
						</div>

						<div class="djs-contact-field">
							<label for="djs-contact-message">Message *</label>
							<textarea id="djs-contact-message" name="message" placeholder="Votre message..." required></textarea>
						</div>

						<div class="djs-contact-form__status" aria-live="polite"></div>

						<button type="submit" class="djs-contact-form__submit">
							Envoyer le message
						</button>
					</form>
				</div>

				<div class="djs-contact-info">
					<h2 class="djs-contact-section-title">Nos coordonnées</h2>

					<div class="djs-contact-info__list">
						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><path d="M12 21s-6-5.29-6-11a6 6 0 1 1 12 0c0 5.71-6 11-6 11Z" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3>Boutique</h3>
								<p>12 Rue du Faubourg Saint-Honoré</p>
								<p>75008 Paris, France</p>
							</div>
						</div>

						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M12 8v4l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3>Horaires d’ouverture</h3>
								<p>Lundi — Samedi : 10h00 — 19h30</p>
								<p>Dimanche : 11h00 — 18h00</p>
							</div>
						</div>

						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><path d="M4 7.5 12 13l8-5.5" stroke="currentColor" stroke-width="1.5"/><rect x="3.25" y="5.25" width="17.5" height="13.5" rx="1.75" stroke="currentColor" stroke-width="1.5"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3>Email</h3>
								<p><a href="mailto:contact@djs-paris.com">contact@djs-paris.com</a></p>
								<p><a href="mailto:presse@djs-paris.com">presse@djs-paris.com</a></p>
							</div>
						</div>

						<div class="djs-contact-info__item">
							<div class="djs-contact-info__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none"><path d="M7.5 4.5h2l1.1 4.2-1.8 1.8a14 14 0 0 0 4.9 4.9l1.8-1.8 4.2 1.1v2a1.5 1.5 0 0 1-1.5 1.5A15.75 15.75 0 0 1 4.5 6A1.5 1.5 0 0 1 6 4.5h1.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
							</div>
							<div class="djs-contact-info__content">
								<h3>Téléphone</h3>
								<p><a href="tel:+33142000000">+33 1 42 00 00 00</a></p>
							</div>
						</div>
					</div>

					<div class="djs-contact-follow">
						<div class="djs-contact-follow__label">Suivez-nous</div>
						<div class="djs-contact-follow__links">
							<a href="#" aria-label="Instagram">@djsparis</a>
							<a href="#" aria-label="Facebook">DJS Paris</a>
						</div>
					</div>

					<div class="djs-contact-map-placeholder">Carte interactive</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
