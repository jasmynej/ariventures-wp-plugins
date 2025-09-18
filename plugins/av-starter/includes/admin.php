<?php
if (!defined('ABSPATH')) exit;

add_action('admin_init', function(){
    register_setting('ariv_group', 'ariv_api_key', ['sanitize_callback'=>'sanitize_text_field']);

    add_settings_section('ariv_main', 'General', '__return_false', 'ariv-starter');
    add_settings_field('ariv_api_key', 'API Key', function(){
        $v = esc_attr(get_option('ariv_api_key',''));
        echo "<input type='text' name='ariv_api_key' class='regular-text' value='$v'/>";
    }, 'ariv-starter', 'ariv_main');
});

add_action('admin_menu', function(){
    add_menu_page('Ariv Starter', 'Ariv Starter', 'manage_options', 'ariv-starter', function(){
        echo '<div class="wrap"><h1>Ariv Starter</h1><form method="post" action="options.php">';
        settings_fields('ariv_group'); do_settings_sections('ariv-starter'); submit_button();
        echo '</form></div>';
    }, 'dashicons-airplane', 56);
});