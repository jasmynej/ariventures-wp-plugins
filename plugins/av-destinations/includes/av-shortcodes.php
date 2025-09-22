<?php
// [avd_destinations]
add_shortcode('avd_destinations', function($atts){
	// Query ALL destinations (change posts_per_page later if needed)
	$q = new WP_Query([
		'post_type'      => 'destination',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	]);

	ob_start();
	echo '<div class="avd-grid">';

	foreach ($q->posts as $p) {
		$id   = $p->ID;
		$acf  = function_exists('get_fields') ? (get_fields($id) ?: []) : [];
		$data = [
			'id'          => $id,
			'title'       => get_the_title($id),
			'excerpt'     => wp_strip_all_tags(get_the_excerpt($id)),
			'permalink'   => get_permalink($id),
			'image_id'    => get_post_thumbnail_id($id),
			'image_url'   => get_the_post_thumbnail_url($id, 'large'),
			'best_months' => $acf['best_months'] ?? [],
			'continent'   => wp_get_post_terms($id, 'continent', ['fields' => 'names']),
			'themes'      => wp_get_post_terms($id, 'travel_theme', ['fields' => 'names']),
			'tagline' => $acf['tagline'] ?? '',
		];

		// 🔑 Use your helper to render the card template
		echo av_render_template('card-destination.php', ['d' => $data]);
	}

	echo '</div>';
	wp_reset_postdata();
	return ob_get_clean();
});

add_shortcode('avd_destination', function($atts){
	$a = shortcode_atts(['id' => 0], $atts);
	$id = intval($a['id'] ?: get_the_ID()); // ← grabs current post ID in singles
	if (!$id) return '';
	$p = get_post($id);
	$acf = get_fields($id);

	$data = [
		'id'          => $p->ID,
		'title'       => get_the_title($p),
		'excerpt'     => get_the_excerpt($p),
		'image_url'   => get_the_post_thumbnail_url($id, 'large'),
		'permalink'   => get_permalink($p),
		'best_months' => $acf['best_months'] ?? [],
		'continent'   => wp_get_post_terms($id, 'continent', ['fields' => 'names']),
		'themes'      => wp_get_post_terms($id, 'travel_theme', ['fields' => 'names']),
		'hotels'      => av_get_hotels_for_destination($id)
	];
	return av_render_template('page-destination.php', ['d' => $data]);

});