<?php
if (!defined('ABSPATH')) exit;

function av_render_template($file, $vars = []) {
	$path = AV_DESTINATIONS_PATH . 'templates/' . $file;
	if (!file_exists($path)) return '';
	extract($vars); // turns array keys into variables
	ob_start();
	include $path;
	return ob_get_clean();
}

function avd_format_hotel(WP_Post $p): array {
	$id   = $p->ID;
	$acf  = function_exists('get_fields') ? (get_fields($id) ?: []) : [];

	return [
		'id'        => $id,
		'title'     => get_the_title($id),
		'excerpt'   => wp_strip_all_tags(get_the_excerpt($id)),
		'permalink' => get_permalink($id),
		'image_url'     => get_post_thumbnail_id($id)
			? wp_get_attachment_image_url(get_post_thumbnail_id($id), 'large')
			: null,

		// ACF fields you care about
		'hotel_brand'        => $acf['hotel_brand'] ?? '',
		'class'              => $acf['class'] ?? '',
		'amenities'          => $acf['amenities'] ?? [],
		'ariventures_rating' => $acf['ariventures_rating'] ?? null,
		'destination'        => $acf['destination'] ?? null, // keep as ID or Object depending on your return_format
	];
}
function av_get_hotels_for_destination(int $destination_id): array {
	$q = new WP_Query([
		'post_type'      => 'hotel',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_query'     => [
			[
				'key'   => 'destination',
				'value' => $destination_id,
			]
		],
		'no_found_rows'  => true,
	]);

	$hotels = [];
	foreach ($q->posts as $p) {
		$hotels[] = avd_format_hotel($p);
	}
	wp_reset_postdata();

	return $hotels;
}