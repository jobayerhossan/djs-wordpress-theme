<?php
/**
 * Template Name: About Page
 *
 * @package DJS
 */

get_header();
?>

<main class="djs-about-page">
	<section class="djs-about-hero">
		<div class="djs-about-hero__bg">
			<img src="http://localhost/djs/wp-content/uploads/2026/03/215a4a6640b84ceebf93c217ad89e39e4fe400aa.jpg" alt="DJS Paris boutique">
		</div>

		<div class="djs-about-hero__overlay"></div>

		<div class="djs-about-hero__content">
			<div class="djs-about-hero__eyebrow">Notre histoire</div>
			<h1 class="djs-about-hero__title">DJS Paris</h1>
			<div class="djs-about-hero__signature">Depuis 1998</div>
		</div>
	</section>

	<section class="djs-about-intro">
		<div class="djs-container">
			<div class="djs-about-intro__inner">
				<div class="djs-about-intro__eyebrow">Notre philosophie</div>
				<h2 class="djs-about-intro__quote">
					Nous créons des vêtements qui transcendent les saisons, des
					pièces conçues pour durer, pour voyager avec vous, et pour
					raconter votre histoire.
				</h2>
			</div>
		</div>
	</section>

	<section class="djs-about-story djs-about-story--first">
		<div class="djs-container">
			<div class="djs-about-story__grid">
				<div class="djs-about-story__content">
					<div class="djs-about-story__eyebrow">1998 — Les origines</div>
					<h2 class="djs-about-story__title">Née d'une passion pour l'excellence</h2>
					<p>
						DJS Paris est née de la volonté d'offrir des pièces pensées pour traverser le temps
						et accompagner une allure sensible et assurée. Dans notre premier atelier de la
						Maison Saint-Honoré, nous avons façonné une vision exigeante, entre tradition et grâce.
					</p>
					<p>
						Chaque collection raconte l'histoire d'un savoir-faire transmis de génération en
						génération, et d'un regard précis pour les matières nobles et les coupes d'une justesse rare.
					</p>
				</div>

				<div class="djs-about-story__media">
					<img src="http://localhost/djs/wp-content/uploads/2026/03/5df03a1e2d35d0ac2e792d3490f0f97f95fa4c38.jpg" alt="DJS Paris interior">
				</div>
			</div>
		</div>
	</section>

	<section class="djs-about-story djs-about-story--reverse">
		<div class="djs-container">
			<div class="djs-about-story__grid">
				<div class="djs-about-story__media">
					<img src="http://localhost/djs/wp-content/uploads/2026/03/4dd2e8afa57068b136e2609a21530fef9b6dcfff.jpg" alt="DJS Paris fashion portrait">
				</div>

				<div class="djs-about-story__content">
					<div class="djs-about-story__eyebrow">Aujourd'hui</div>
					<h2 class="djs-about-story__title">Un vestiaire pour les femmes et hommes modernes</h2>
					<p>
						Aujourd'hui, DJS Paris imagine une maison de mode intemporelle, ouverte sur le monde.
						Des pièces épurées, conçues pour être portées avec aisance, encore et encore.
					</p>
					<p>
						Notre vestiaire s'adresse à un client exigeant qui cherche des pièces durables,
						poétiques et pensées pour accompagner tous les gestes du quotidien.
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="djs-about-values">
		<div class="djs-container">
			<div class="djs-about-values__inner">
				<div class="djs-about-values__eyebrow">Nos valeurs</div>
				<h2 class="djs-about-values__title">Ce qui nous définit</h2>

				<div class="djs-about-values__grid">
					<div class="djs-about-value">
						<div class="djs-about-value__number">01</div>
						<h3 class="djs-about-value__label">Artisanat</h3>
						<p>Chaque pièce est pensée et confectionnée avec soin, sens du détail et maîtrise du geste.</p>
					</div>

					<div class="djs-about-value">
						<div class="djs-about-value__number">02</div>
						<h3 class="djs-about-value__label">Durabilité</h3>
						<p>Nous privilégions les matières d'exception et une production raisonnée pour accompagner le temps.</p>
					</div>

					<div class="djs-about-value">
						<div class="djs-about-value__number">03</div>
						<h3 class="djs-about-value__label">Intemporalité</h3>
						<p>Nos collections refusent les tendances rapides pour révéler une élégance durable et sereine.</p>
					</div>

					<div class="djs-about-value">
						<div class="djs-about-value__number">04</div>
						<h3 class="djs-about-value__label">Transparence</h3>
						<p>Nous racontons l'origine de nos matières et la manière dont chaque vêtement prend vie.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="djs-about-quote">
		<div class="djs-container">
			<div class="djs-about-quote__inner">
				<blockquote class="djs-about-quote__text">
					"La vraie luxe, c'est de pouvoir choisir ce qui est beau,
					juste et durable."
				</blockquote>
				<div class="djs-about-quote__meta">— Fondateur, DJS Paris</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
