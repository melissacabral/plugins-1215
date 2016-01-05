<?php 
/*
Plugin Name: Rad Custom Post Types
Description: Adds the "Product" post type to the admin panel
Author: Melissa Cabral
Version: 0.1
*/

/**
 * Create the post type
 * @since  0.1
 */
add_action( 'init', 'rad_cpt' );
function rad_cpt(){
	register_post_type( 'product', array(
		'public'		=> true,
		'has_archive' 	=> true,		
		'labels'		=> array(
			'name'			=> 'Products',
			'singular_name'	=> 'Product',
			'add_new_item' 	=> 'Add new Product',
			'not_found'		=> 'No Products Found',			
		),
		'menu_icon'		=> 'dashicons-cart',
		'menu_position'	=> 10,
		'supports'		=> array('title', 'editor', 'thumbnail', 
			'custom-fields', 'excerpt'),
		'rewrite'		=> array( 'slug' => 'shop' ),
	) );

	//add a way to sort by brand
	register_taxonomy( 'brand', 'product', array(
		'hierarchical' 		=> true,
		'show_admin_column'	=> true,
		'labels' 			=> array(
			'name' 				=> 'Brands',
			'singular_name'		=> 'Brand',
			'add_new_item' 		=> 'Add new Brand',
			'search_items'		=> 'Search Brands',
			'not_found'			=> 'No Brands to show',
		),
	) );
}


//flush rewrite rules (htaccess) when this plugin is activated
function rad_cpt_flush(){
	rad_cpt();
	//this is a heavy operation. only call on plugin activation or theme activation
	flush_rewrite_rules();
	//do not generate any output with this function! (no echo)
}
register_activation_hook( __FILE__, 'rad_cpt_flush' );