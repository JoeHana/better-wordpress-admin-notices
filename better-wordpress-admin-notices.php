<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://joehana.com
 * @since             1.0.0
 * @package           Better_Wordpress_Admin_Notices
 *
 * @wordpress-plugin
 * Plugin Name:       Better WordPress Admin Notices
 * Plugin URI:        http://github.com/JoeHana/better-wordpress-admin-notices
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Joe Hana
 * Author URI:        http://joehana.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       better-wordpress-admin-notices
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-better-wordpress-admin-notices-activator.php
 */
function activate_better_wordpress_admin_notices() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-better-wordpress-admin-notices-activator.php';
	Better_Wordpress_Admin_Notices_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-better-wordpress-admin-notices-deactivator.php
 */
function deactivate_better_wordpress_admin_notices() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-better-wordpress-admin-notices-deactivator.php';
	Better_Wordpress_Admin_Notices_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_better_wordpress_admin_notices' );
register_deactivation_hook( __FILE__, 'deactivate_better_wordpress_admin_notices' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-better-wordpress-admin-notices.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_better_wordpress_admin_notices() {

	$plugin = new Better_Wordpress_Admin_Notices();
	$plugin->run();

}
run_better_wordpress_admin_notices();
