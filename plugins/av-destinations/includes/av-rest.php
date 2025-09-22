<?php
// Add ACF fields to REST responses for your post types
add_action('rest_api_init', function () {
	$types = ['destination','hotel','attraction','trip-template'];

	foreach ($types as $type) {
		register_rest_field($type, 'acf', [
			'get_callback'    => function ($object) {
				if (function_exists('get_fields')) {
					// returns all ACF fields for this post (respects your field names)
					return get_fields($object['id']) ?: (object)[];
				}
				return (object)[];
			},
			'schema'          => [
				'description' => 'ACF fields for this post',
				'type'        => 'object',
				'context'     => ['view','edit'],
			],
		]);
	}
});