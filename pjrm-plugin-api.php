<?php
/*
 *	Plugin Name: PJRM Plugin
 *	Plugin URI: https://www.pjrmdomain.com
 *	Description: Provides shortcodes to display articles on your website.
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

			$pjrm_results = pjrm_articles_get_results($pjrm_search);

			$options['pjrm_search'] = $pjrm_search;
			$options['pjrm_apikey'] = $pjrm_apikey;
			$options['last_update'] = time();

			$options['pjrm_results'] = $pjrm_results;

			update_option('pjrm_articles', $options);
		}
	}

	$options = get_option('pjrm_articles');

	if ($options != ''){
		$pjrm_search = $options['pjrm_search'];
		$pjrm_apikey = $options['pjrm_apikey'];
		$pjrm_results = $options['pjrm_results'];
	}

	require('inc/options-page-wrapper.php');
}


// Create a WP Widget. Reference: https://developer.wordpress.org/reference/functions/register_widget/
class Pjrm_Articles_Widgets extends WP_Widget {

	/**
	 * Constructs the new widget.
	 *
	 * @see WP_Widget::__construct()
	 */
	function __construct() {
		// Instantiate the parent object.
		parent::__construct( false, __( 'PJRM Articles Widget', 'textdomain' ) );
	}

	/**
	 * The widget's HTML output.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Display arguments including before_title, after_title,
	 *                        before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {

		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$num_articles = $instance['num_articles'];
		$display_image = $instance['display_image'];

		$options = get_option('pjrm_articles');
		$pjrm_results = $options['pjrm_results'];

		require('inc/front-end.php');
	}

	/**
	 * The widget update handler.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance The new instance of the widget.
	 * @param array $old_instance The old instance of the widget.
	 * @return array The updated instance of the widget.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['display_image'] = strip_tags($new_instance['display_image']);
		$instance['num_articles'] = strip_tags($new_instance['num_articles']);

		return $instance;
	}

	/**
	 * Output the admin widget options form HTML.
	 *
	 * @param array $instance The current widget settings.
	 * @return string The HTML markup for the form.
	 */
	function form( $instance ) {

		$title = esc_attr($instance['title']);
		$display_image = esc_attr($instance['display_image']);
		$num_articles = esc_attr($instance['num_articles']);

		$options = get_option('pjrm_articles');
		$pjrm_results = $options['pjrm_results'];

		require ('inc/widget-fields.php');

	}
}

add_action( 'widgets_init', 'pjrm_articles_register_widgets' );

/**
 * Register the new widget.
 *
 * @see 'widgets_init'
 */
function pjrm_articles_register_widgets() {
	register_widget( 'Pjrm_Articles_Widgets' );
}


function pjrm_articles_get_results($pjrm_apikey){

	$json_feed_url = WP_PLUGIN_URL . '/pjrm-plugin-api/data.json';

	$json_feed = wp_remote_get($json_feed_url);

	$pjrm_results = json_decode($json_feed['body']);

	//var_dump($pjrm_results);

	return $pjrm_results;

}


// Refresh data with AJAX
function pjrm_articles_refresh_results(){
	$options = get_option('pjrm_articles');
	$last_updated = $options['last_updated'];

	$current_time = time();
	$update_difference = $current_time - $last_updated;
	// Condition check one day
	if ($update_difference > 86400) {

		$pjrm_search = $options['pjrm_search'];
		$pjrm_apikey = $options['pjrm_apikey'];

		$options['pjrm_results'] = pjrm_articles_get_results($pjrm_search, $pjrm_apikey);
		$options['last_updated'] = time();

		update_option('pjrm_articles', $options );

	}
	// Stop Ajax function
	die();

}

add_action('wp_ajax_pjrm_articles_refresh_results', 'pjrm_articles_refresh_results');

// Ajax in frontend
function pjrm_articles_enable_frontend_ajax(){
?>
	<script>
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>'
	</script>

<?php
}

add_action('wp_head', 'pjrm_articles_enable_frontend_ajax');


// Add shortcode to use on WP pages
function pjrm_articles_shortcode($atts, $content = null){

	global $post;

	extract(shortcode_atts(array(
		'num_articles' => '4',
		'display_image' => 'on'
	), $atts ));

	if ($display_image == 'on') $display_image = 1;
	if ($display_image == 'off') $display_image = 0;

	$options = get_option('pjrm_articles');
	$pjrm_results = $options['pjrm_results'];

	// WP output buffering
	ob_start();

	require ('inc/frontend.php');

	$content = ob_get_clean();

	return $content;

}

add_shortcode('pjrm_articles', 'pjrm_articles_shortcode' );



// Load plug-in for backend styles
function pjrm_articles_backend_styles(){

	wp_enqueue_style('pjrm_articles_backend_css', plugins_url('pjrm-plugin-api/pjrm_articles.css'));

}

add_action('admin_head', 'pjrm_articles_backend_styles');


// Load plug-in for fronten styles
function pjrm_articles_frontend_styles(){

	wp_enqueue_style('pjrm_articles_backend_css', plugins_url('pjrm-plugin-api/pjrm_articles.css'));
	wp_enqueue_script('pjrm_articles_frontend_js', plugins_url('pjrm-plugin-api/pjrm_articles.js'), array('jquery'), '', true);
	//wp_register_script('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
	//wp_enqueue_script('prefix_bootstrap');
	wp_register_style('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
	wp_enqueue_style('prefix_bootstrap');
}

add_action('wp_enqueue_scripts', 'pjrm_articles_frontend_styles');





?>
