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

class TimberClearCache {
	function __construct() {
		require_once 'src/helpers.php';

		if ( Helpers::is_timber_cache_set() && Helpers::can_user_clear_cache() ) {
			$this->init();
		}

	}

	public function init() {
		require_once 'src/adminbar.php';
		require_once 'src/options.php';

		// do uporządkowania
		Routes::map(
			'maintenance/clear-twig-cache',
			function () {
				if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
					$loader = new Timber\Loader();
					$loader->clear_cache_twig();

					// na szybko
					$url = admin_url( 'admin.php?page=timber_cache_options' ) . '&timber_cache_cleared=true';
					wp_redirect( $url );
					exit();
				}
			}
		);

		add_action( 'admin_bar_menu', array( 'Adminbar', 'add_toolbar_item' ), 100 );
		add_action( 'admin_menu', array( 'Options', 'regiser_dashboard_menu' ) );

		if ( $_GET['timber_cache_cleared'] !== null ) {
			add_action( 'admin_notices', array( 'Options', 'add_admin_notice' ) );
		}
	}
}

add_action(
	'init',
	function() {
		new TimberClearCache();
	}
);
