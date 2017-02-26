<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://joehana.com
 * @since      1.0.0
 *
 * @package    Better_Wordpress_Admin_Notices
 * @subpackage Better_Wordpress_Admin_Notices/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Better_Wordpress_Admin_Notices
 * @subpackage Better_Wordpress_Admin_Notices/admin
 * @author     Joe Hana <me@joehana.com>
 */
class Better_Wordpress_Admin_Notices_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		add_action( 'wp_before_admin_bar_render', array( $this, 'setup_notifications_toolbar' ), 10 );
		//add_action( 'admin_bar_menu', array( $this, 'setup_admin_menu' ), 100000 );
		
		//add_action( 'init', array( $this, 'setup' ), 1000000 );
	}
	
	public function setup() {
		
		remove_all_actions( 'admin_notices' );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Better_Wordpress_Admin_Notices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Better_Wordpress_Admin_Notices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/better-wordpress-admin-notices-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Better_Wordpress_Admin_Notices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Better_Wordpress_Admin_Notices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/better-wordpress-admin-notices-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function notices() {
				
		/**
		 * text - message of the notification
		 * type - can be update, warning, info, error
		 * icon - any dashicon class
		 */
		return apply_filters( 'better_wordpress_admin_notices', array() );
		
	}
	
	public function render_notices() {
		
		$output = '';
		
		$output .= '<ul class="notification-items">';
		
		foreach( $this->notices() as $notice ) {
			
			if( $notice['type'] == 'update' ) {
				$title = __( 'Update available', '' );
			} elseif( $notice['type'] == 'warning' ) {
				$title = __( 'Warning', '' );
			} elseif( $notice['type'] == 'info' ) {
				$title = __( 'Information', '' );
			} elseif( $notice['type'] == 'error' ) {
				$title = __( 'Error', '' );
			}
			
			$output .= '<li class="notification-item notification-item-' . $notice['type'] . '"><span class="dashicons ' . $notice['icon'] . '"></span><h5>' . $title . '</h5><p>' . $notice['text'] . '</p></li>';
			
		}
		
		$output .= '</ul>';
		$output .= '<a href="#load-more" class="notifications-load-more">Load More</a>';

		return $output;
		
	}
	
	/**
	 * setup_admin_menu()
	 *	
	 * @since 1.0.0
	 * @access public
	 */
	public function setup_notifications_toolbar() {
		
		global $wp_admin_bar;
		
		var_dump( settings_errors() );
	
		$args = array(
			'title'  => '<span class="dashicons dashicons-megaphone"></span>',
			'id'     => 'notifications',
			'parent' => 'top-secondary',
			'href'   => '#notifications',
			'meta'   => array(
				'html'     => '<div class="ab-sub-wrapper notifications-wrapper">' . $this->render_notices() . '</div>',
				'class'    => 'menupop notifications-menu-item',
				'title'    => 'Open Notifications',
				'tabindex' => '10',
			),
		);
		
		$wp_admin_bar->add_menu( $args );
	
	}

}




/**
 * Example Implementation
 */

add_action( 'better_wordpress_admin_notices', 'my_custom_admin_notices' );

function my_custom_admin_notices() {
	
	$notices	= array(
	
		'sample-1'	=> array(
			'text' 	=> __( 'Lorem Ipsum dolor sit amet foo bar', '' ),
			'type'	=> 'update',
			'icon'	=> 'dashicons-yes'
		),
		'sample-2'	=> array(
			'text' 	=> __( 'A member of the Foobar Team is currently reviewing your site. Please do not make any changes. For more infos please read our guide.', '' ),
			'type'	=> 'error',
			'icon'	=> 'dashicons-warning'
		),
		'sample-3'	=> array(
			'text' 	=> __( 'Lorem Ipsum dolor sit amet', '' ),
			'type'	=> 'warning',
			'icon'	=> 'dashicons-yes'
		),
		'sample-4'	=> array(
			'text' 	=> __( 'A member of the Foobar Team is currently reviewing your site. Please do not make any changes. For more infos please read our guide.', '' ),
			'type'	=> 'info',
			'icon'	=> 'dashicons-warning'
		),
		'sample-5'	=> array(
			'text' 	=> __( 'Lorem Ipsum dolor sit amet', '' ),
			'type'	=> 'update',
			'icon'	=> 'dashicons-yes'
		),
		'sample-6'	=> array(
			'text' 	=> __( 'A member of the Foobar Team is currently reviewing your site. Please do not make any changes. For more infos please read our guide.', '' ),
			'type'	=> 'error',
			'icon'	=> 'dashicons-warning'
		),
		'sample-7'	=> array(
			'text' 	=> __( 'Lorem Ipsum dolor sit amet', '' ),
			'type'	=> 'update',
			'icon'	=> 'dashicons-yes'
		),
		'sample-8'	=> array(
			'text' 	=> __( 'A member of the Foobar Team is currently reviewing your site. Please do not make any changes. For more infos please read our guide.', '' ),
			'type'	=> 'error',
			'icon'	=> 'dashicons-warning'
		),
		
	);
	
	return $notices;
	
}