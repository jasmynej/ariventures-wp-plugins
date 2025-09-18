<?php
if (!defined('ABSPATH')) exit;

function ariv_render_template($file, $vars = []) {
    $path = ARIV_STARTER_PATH . 'templates/' . $file;
    if (!file_exists($path)) return '';
    extract($vars); // turns array keys into variables
    ob_start();
    include $path;
    return ob_get_clean();
}