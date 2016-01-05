<?php 
/*
Plugin Name: Rad Admin Tweaks
Author: Melissa Cabral
Description: Customize the admin and login screens
Version: 0.1
License: GPLv3
*/

/**
 * Custom CSS for login and register form
 * @since  0.1
 */
function rad_login_css(){
	$url = plugins_url( 'login.css', __FILE__ );
	//put the stylesheet on the page
	wp_enqueue_style( 'login-style', $url );
}
//this is the right hook for putting CSS on the login form
add_action('login_enqueue_scripts', 'rad_login_css');

/**
 * Change the behavior of the login logo link
 * @since  0.1 
 */
function rad_login_href(){
	return home_url();  //you can make this any URL you want
}
add_filter( 'login_headerurl', 'rad_login_href' );

function rad_login_title(){
	return 'Go Home to ' . get_bloginfo('name');
}
add_filter( 'login_headertitle', 'rad_login_title' );

/**
 * Remove the WP logo node from the Toolbar/Admin Bar
 * @since  0.1 
 * @link https://codex.wordpress.org/Toolbar 
 */
function rad_toolbar( $wp_admin_bar ){
	$wp_admin_bar->remove_node( 'wp-logo' );

	//add a custom item to the toolbar
	$wp_admin_bar->add_node( array(
			'id' 	=> 'contact-me',
			'title'	=> 'Contact Melissa',
			'href'	=> 'http://wordpress.melissacabral.com',
			'parent' => 'top-secondary' //right side
		) );
}
add_action( 'admin_bar_menu', 'rad_toolbar', 999 );

/**
 * Customize the dashboard widgets
 * @since  0.1 
 */
function rad_dashboard(){
						//ID 				screen 		context
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

	//add a custom meta box
	//							ID, title, callback for content
	wp_add_dashboard_widget( 'dashboard_rad_help', '<span class="dashicons dashicons-format-video"></span> Helpful Information', 
		'rad_widget_content' );

}
add_action( 'wp_dashboard_setup', 'rad_dashboard' );

// remove welcome panel
remove_action( 'welcome_panel', 'wp_welcome_panel' );

function rad_widget_content(){
	?>
	<h3>  
	Check out this helpful video</h3>

	<iframe width="350" height="197" src="https://www.youtube.com/embed/qO8GZNdQ54I" frameborder="0" allowfullscreen></iframe>
	<?php
}

/**
 * Add an external style to the admin panel
 */
function rad_admin_style(){
	$url = plugins_url( 'admin.css', __FILE__ );
	wp_enqueue_style( 'admin-stylesheet', $url );
}
add_action( 'admin_enqueue_scripts', 'rad_admin_style' );
