<?php
/**
 * Plugin Name: Ariventures Visa Checker & Travel Advisory
 * Description: Plugin for Visa rules and travel advisory
 * Version: 0.1.0
 * Author: Ariventures
 * Text Domain: av-visas
 */
if (!defined('ABSPATH')) exit;

define('AV_VISA_CHECKER_URL', plugin_dir_url(__FILE__));
define('AV_VISA_CHECKER_PATH', plugin_dir_path(__FILE__));
define('AV_VISA_CHECKER_VERSION', '0.1');

require_once AV_VISA_CHECKER_PATH . 'includes/activator.php';
require_once AV_VISA_CHECKER_PATH . 'includes/helpers.php';
require_once AV_VISA_CHECKER_PATH . 'includes/assets.php';
require_once AV_VISA_CHECKER_PATH . 'includes/admin.php';


register_activation_hook(__FILE__, ['ArivVisa_Activator', 'activate']);

add_action('plugins_loaded', function () {
	$installed = get_option('arivvisa_db_version');
	if ($installed !== ArivVisa_Activator::DB_VERSION) {
		ArivVisa_Activator::activate(); // rerun dbDelta
	}
});