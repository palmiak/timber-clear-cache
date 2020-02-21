<?php
class Options {
	function regiser_dashboard_menu() {
		 add_menu_page( 'Import ofert', 'timber cache options', 'manage_options', 'timber_cache_options', array( 'Options', 'render_timber_cache_options_page' ), null, 99 );
	}

	function render_timber_cache_options_page() {
		echo 'options';
	}

	function add_admin_notice() {
		global $pagenow;
		echo '<div class="notice notice-warning is-dismissible">
        <p>the cache has </p>
        </div>';
	}
}
