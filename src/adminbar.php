<?php
class Adminbar {
	public static function add_toolbar_item( $admin_bar ) {
		$admin_bar->add_menu(
			array(
				'id'    => 'clear-cache',
				'title' => 'Wyczyść cache',
				'href'  => '/maintenance/clear-twig-cache',
				'meta'  => array(
					'title' => __( 'Wyczyść cache', 'sasquatch' ),
				),
			)
		);
	}
}
