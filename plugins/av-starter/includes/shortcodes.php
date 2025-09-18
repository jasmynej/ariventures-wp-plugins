<?php
add_shortcode('ariv_hello', function($atts){
    $atts = shortcode_atts(['name'=>'Traveler'], $atts);
    return ariv_render_template('hello.php', ['atts' => $atts]);
});

add_shortcode('option_test', function(){
    $key = get_option('ariv_api_key', '');
    return $key ? '<div>API key set ✅</div>' : '<div>No API key ❌</div>';
});