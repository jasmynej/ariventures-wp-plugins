<?php
if (!defined('ABSPATH')) exit;

/**
 * Frontend assets (if you later need them)
 */
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'av-global-frontend',
		AV_VISA_CHECKER_URL . 'assets/css/global.css', // URL, not PATH
		[],
		AV_VISA_CHECKER_VERSION
	);
});

/**
 * Admin assets — load only on this plugin's pages
 */
add_action('admin_enqueue_scripts', function ($hook) {
	$allowed = [
		'toplevel_page_arivvisa',
		'visa-checker_page_arivvisa-tools',
	];
	error_log('[AV DEBUG] hook: ' . $hook);
	if (in_array($hook, $allowed, true)) {
		wp_enqueue_style(
			'av-admin',
			AV_VISA_CHECKER_URL . 'assets/css/global.css', // must be URL not PATH
			[],
			AV_VISA_CHECKER_VERSION
		);
	}
}, 100);