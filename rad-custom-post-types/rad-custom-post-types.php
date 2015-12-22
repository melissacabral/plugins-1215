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
	) );
}