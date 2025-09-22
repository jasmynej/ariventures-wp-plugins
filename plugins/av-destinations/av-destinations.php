<?php
/**
 * Plugin Name: Ariventures Destinations
 * Description: Plugin for Destinations pages
 * Version: 0.1.0
 * Author: Ariventures
 * Text Domain: av-destinations
 */
if (!defined('ABSPATH')) exit;

define('AV_DESTINATIONS_PATH', plugin_dir_path(__FILE__));
define('AV_DESTINATIONS_URL', plugin_dir_url(__FILE__));
define('AV_DESTINATIONS_VERSION', '1.0.0');

require_once AV_DESTINATIONS_PATH . 'includes/av-admin.php';
require_once AV_DESTINATIONS_PATH . 'includes/av-assets.php';
require_once AV_DESTINATIONS_PATH . 'includes/av-helpers.php';
require_once AV_DESTINATIONS_PATH . 'includes/av-shortcodes.php';
require_once AV_DESTINATIONS_PATH . 'includes/av-post-types.php';
require_once AV_DESTINATIONS_PATH . 'includes/av-taxonomies.php';
require_once AV_DESTINATIONS_PATH . 'includes/av-rest.php';

// Lifecycle
register_activation_hook(__FILE__, function () { flush_rewrite_rules(); });
register_deactivation_hook(__FILE__, function () { flush_rewrite_rules(); });