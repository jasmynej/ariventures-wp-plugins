<?php
function av_register_destinations_post_type() {
	$labels = [
		'name' => 'Destinations',
		'singular_name' => 'Destination',
		'add_new_item' => 'Add New Destination',
	];

	$args = [
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-location-alt',
		'show_in_rest' => true, // enables Gutenberg + API,
		'show_in_menu' => 'av-destinations',
		'supports' => ['title','thumbnail','excerpt'],
		'rewrite' => ['slug' => 'destinations'],
	];

	register_post_type('destination', $args);
}

function av_register_hotels_post_type() {
	$labels = [
		'name' => 'Hotels',
		'singular_name' => 'Hotel',
		'add_new_item' => 'Add New Hotel',
	];
	$args = [
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-building',
		'show_in_menu' => 'av-destinations',
		'show_in_rest' => true,
		'supports' => ['title','thumbnail','excerpt'],
		'rewrite' => ['slug' => 'hotels'],
	];
	register_post_type('hotel', $args);
}

function av_register_attractions_post_type() {
	$labels = [
		'name' => 'Attractions',
		'singular_name' => 'Attraction',
		'add_new_item' => 'Add New Attraction',
	];
	$args = [
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-bank',
		'show_in_menu' => 'av-destinations',
		'show_in_rest' => true,
		'supports' => ['title','thumbnail','excerpt'],
		'rewrite' => ['slug' => 'attractions'],
	];
	register_post_type('attraction', $args);
}

function av_register_trip_templates_post_type() {
	$labels = [
		'name' => 'Trip Templates',
		'singular_name' => 'Trip Template',
		'add_new_item' => 'Add New Trip Template',
	];

	$args = [
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-index-card',
		'show_in_menu' => 'av-destinations',
		'show_in_rest' => true,
		'supports' => ['title','thumbnail','excerpt'],
		'rewrite' => ['slug' => 'trip-templates'],
	];
	register_post_type('trip-template', $args);
}
add_action('init', 'av_register_destinations_post_type');
add_action('init', 'av_register_hotels_post_type');
add_action('init', 'av_register_attractions_post_type');
add_action('init', 'av_register_trip_templates_post_type');
