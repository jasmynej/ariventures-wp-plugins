<?php
if (!defined('ABSPATH')) exit;



add_action('admin_menu', function(){
	add_menu_page('AV Destinations Curator', 'AV Destinations', 'manage_options', 'av-destinations', function(){
		echo 'AV destinations';
	}, 'dashicons-airplane');
});