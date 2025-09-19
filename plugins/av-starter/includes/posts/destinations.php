<?php
if (!defined('ABSPATH')) exit;

function av_register_destinations_cpt() {
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
	    'show_in_menu' => 'ariv-starter',
        'supports' => ['title','thumbnail','excerpt'],
        'rewrite' => ['slug' => 'destinations'],
    ];

    register_post_type('av_destination', $args);
}
add_action('init', 'av_register_destinations_cpt');