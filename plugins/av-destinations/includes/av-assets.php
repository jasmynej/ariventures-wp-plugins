<?php
add_action('wp_enqueue_scripts', function () {
	// global design tokens
	wp_enqueue_style('avd-global', AV_DESTINATIONS_URL.'assets/css/global.css', [], AV_DESTINATIONS_VERSION);

	// component styles
	wp_enqueue_style('avd-cards',  AV_DESTINATIONS_URL.'assets/css/cards.css',  ['avd-global'], AV_DESTINATIONS_VERSION);
	wp_enqueue_style('avd-pages', AV_DESTINATIONS_URL.'assets/css/page.css',  ['avd-global'], AV_DESTINATIONS_VERSION);
	// wp_enqueue_style('avd-buttons', AV_DESTINATIONS_URL.'assets/css/buttons.css', ['avd-global'], AV_DESTINATIONS_VERSION);
	// wp_enqueue_style('avd-grids',   AV_DESTINATIONS_URL.'assets/css/grids.css',   ['avd-global'], AV_DESTINATIONS_VERSION);
});