<?php
if (!defined('ABSPATH')) exit;

function av_register_hotels_cpt(){
	$labels = [
		'name' => 'Hotels',
		'singular_name' => 'Hotel',
		'menu_name' => 'Hotels',
		'add_new_item' => 'Add New Hotel',
	];
	$args = [
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-bank',
		'show_in_menu' => 'ariv-starter',
		'supports' => ['title','thumbnail','excerpt'],
		'rewrite' => ['slug' => 'hotels'],
	];

	register_post_type('av_hotel', $args);
}

add_action('init', 'av_register_hotels_cpt');