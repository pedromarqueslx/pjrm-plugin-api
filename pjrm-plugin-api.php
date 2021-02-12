<?php
/*
 *	Plugin Name: PJRM Plugin
 *	Plugin URI: https://www.pjrmdomain.com
 *	Description: Provides both widgets and shortcodes to help you display NY Times articles on your website.
 *	Version: 1.0
 *	Author: Peter Markes
 *	Author URI: https://www.pjrmdomain.com
 *	License: GPL2
 *
*/

// Add settings page
function pjrm_articles_menu(){

    add_options_page(
        'PJRM Plugin Api',
        'Articles',
        'manage_options',
        'pjrm-plugin',
        'pjrm_articles_options_page'
    );
}

add_action('admin_menu', 'pjrm_articles_menu');


// Create settings page
function pjrm_articles_options_page(){

	if (!current_user_can('manage_options')){
		wp_die('No permissions to view this page');
	}

	echo '<h1>Articles</h1>';
}



?>
