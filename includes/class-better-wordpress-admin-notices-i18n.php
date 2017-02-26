<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://joehana.com
 * @since      1.0.0
 *
 * @package    Better_Wordpress_Admin_Notices
 * @subpackage Better_Wordpress_Admin_Notices/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Better_Wordpress_Admin_Notices
 * @subpackage Better_Wordpress_Admin_Notices/includes
 * @author     Joe Hana <me@joehana.com>
 */
class Better_Wordpress_Admin_Notices_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'better-wordpress-admin-notices',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
