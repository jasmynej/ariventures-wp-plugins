<?php
if (!defined('ABSPATH')) exit;

function av_get_template(string $template_name, array $args = []) {
	$file = AV_VISA_CHECKER_PATH . 'templates/' . ltrim($template_name, '/');

	if (!file_exists($file)) {
		wp_die('Template not found: ' . esc_html($template_name));
	}

	if (!empty($args)) {
		extract($args, EXTR_SKIP);
	}

	include $file;
}

function av_get_template_html(string $template_name, array $args = []) : string {
	ob_start();
	av_get_template($template_name, $args);
	return ob_get_clean();
}