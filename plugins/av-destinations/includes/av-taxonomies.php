<?php


add_action('init', function() {
	// Continent taxonomy (hierarchical)
	register_taxonomy('continent', 'destination', [
		'hierarchical' => true,
		'label' => 'Continents',
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'continent'],
	]);

	// Travel themes taxonomy (non-hierarchical, like tags)
	register_taxonomy('travel_theme', 'destination', [
		'hierarchical' => false,
		'label' => 'Travel Themes',
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'theme'],
	]);
});