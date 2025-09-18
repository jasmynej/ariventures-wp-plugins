<?php
if (!defined('ABSPATH')) exit;

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('ariv-front', ARIV_STARTER_URL.'assets/css/front.css', [], ARIV_STARTER_VER);
    wp_enqueue_script('ariv-front', ARIV_STARTER_URL.'assets/front.js', ['jquery'], ARIV_STARTER_VER, true);
});