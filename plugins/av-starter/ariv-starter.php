<?php
/**
 * Plugin Name: Ariv Starter
 * Description: Minimal starter for learning WP plugin dev.
 * Version: 0.1.0
 * Author: Ariventures
 * Text Domain: ariv-starter
 */
if (!defined('ABSPATH')) exit;

define('ARIV_STARTER_PATH', plugin_dir_path(__FILE__));
define('ARIV_STARTER_URL', plugin_dir_url(__FILE__));
define('ARIV_STARTER_VER', '0.1.0');

// Includes
require_once ARIV_STARTER_PATH . 'includes/assets.php';
require_once ARIV_STARTER_PATH . 'includes/admin.php';
require_once ARIV_STARTER_PATH . 'includes/shortcodes.php';
require_once ARIV_STARTER_PATH . 'includes/helpers.php';
require_once ARIV_STARTER_PATH . 'includes/posts/destinations.php';

// Lifecycle
register_activation_hook(__FILE__, function () { flush_rewrite_rules(); });
register_deactivation_hook(__FILE__, function () { flush_rewrite_rules(); });