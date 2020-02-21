<?php

class Helpers {
	public static function is_timber_loaded() {
		if ( class_exists( 'Timber' ) ) {
			return true;
		}

		return false;
	}

	public static function is_timber_cache_set() {
		if ( self::is_timber_loaded() && Timber::$cache === true ) {
			return true;
		}

		return false;
	}

	public static function can_user_clear_cache() {
		if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
			return true;
		}

		return false;
	}
}
