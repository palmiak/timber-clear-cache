<?php

/**
 * Plugin Name: Timber clear cache
 * Description: 
 * Author:      palmiak
 * Version:     0.0.1
 * Author URI:  
 * Plugin URI:  
 * Text Domain: tcc
 */

// caching
if (class_exists('Timber')) {
	Timber::$cache = true;
}

// register clear url
Routes::map('maintenance/clear-twig-cache', function () {
	if (is_user_logged_in() && current_user_can('manage_options')) {
		$loader = new Timber\Loader();
		$loader->clear_cache_twig();

		// na szybko
		$url = admin_url('admin.php?page=timber_cahce_options') . '&timber_cache_cleared=true';
		wp_redirect($url);
		exit();
	}
});

function add_admin_notice()
{
	global $pagenow;
	echo '<div class="notice notice-warning is-dismissible">
	<p>the cache has </p>
	</div>';
}
// na szybko
if ($_GET['timber_cache_cleared'] !== null) {
	add_action('admin_notices', 'add_admin_notice');
}

// add wpadminbar menu
add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar)
{
	$admin_bar->add_menu(array(
		'id'    => 'clear-cache',
		'title' => 'Wyczyść cache',
		'href'  => '/maintenance/clear-twig-cache',
		'meta'  => array(
			'title' => __('Wyczyść cache', 'sasquatch'),
		),
	));
}

// register options page
function regiser_dashboard_menu()
{
	add_menu_page('Import ofert', 'timber cache options', 'manage_options', 'timber_cahce_options', 'render_timber_cahce_options_page', null, 99);
}
add_action('admin_menu', 'regiser_dashboard_menu');

function render_timber_cahce_options_page()
{
	echo 'options';
}
