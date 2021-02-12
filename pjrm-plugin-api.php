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

// Create a global vars
$plugin_url = WP_PLUGIN_URL . '/pjrm-plugin-api';
$options = array();

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


// Create settings page and ...
function pjrm_articles_options_page(){

	if (!current_user_can('manage_options')){
		wp_die('No permissions to view this page');
	}

	global $plugin_url;
	global $options;

	if(isset($_POST['pjrm_form_submitted'])){
		$hidden_field = esc_html($_POST['pjrm_form_submitted']);

		if($hidden_field == 'Y'){
			$pjrm_search = esc_html($_POST['pjrm_search']);
			$pjrm_apikey = esc_html($_POST['pjrm_apikey']);

			pjrm_articles_get_results($pjrm_search);

			$options['pjrm_search'] = $pjrm_search;
			$options['pjrm_apikey'] = $pjrm_apikey;
			$options['last_update'] = time();

			update_option('pjrm_articles', $options);
		}
	}

	$options = get_option('pjrm_articles');

	if ($options != ''){
		$pjrm_search = $options['pjrm_search'];
		$pjrm_apikey = $options['pjrm_apikey'];
	}

	require('inc/options-page-wrapper.php');
}

function pjrm_articles_get_results($pjrm_apikey){

	$plugin_url = WP_PLUGIN_URL . '/pjrm-plugin-api';

	$json_feed_url = $plugin_url . '/data.json';

	$json_feed = wp_remote_get($json_feed_url);

	//echo $json_feed;
	var_dump($json_feed['body']);


}


// Load plug-in styles
function pjrm_articles_backend_styles(){

	wp_enqueue_style('pjrm_articles_backend_css', plugins_url('pjrm-plugin-api/pjrm_articles.css'));
}

add_action('admin_head', 'pjrm_articles_backend_styles');



?>
