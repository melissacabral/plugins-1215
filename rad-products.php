<?php 
/*
Plugin Name: Rad Products
Description: Adds the ability to have products in our catalog
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

//create the post type (unlocks admin panel screens)
add_action( 'init', 'rad_products_cpt' );
function rad_products_cpt(){
	register_post_type( 'product', array(
		'public' 		=> true,  //visible to users
		'has_archive' 	=> true,  //so we can show many products at once
		'labels'		=> array(
			'name'			=> 'Products',
			'singular_name' => 'Product',
			'add_new_item'	=> 'Add New Product',
			'edit_item'		=> 'Edit Product',
			'search_items'	=> 'Search Product',
		),
		'menu_icon' 	=> 'dashicons-cart', //dashicons
		'menu_position' => 5, //below posts
		'supports'		=> array( 'title', 'editor', 'thumbnail', 
									'excerpt', 'custom-fields', 'revisions' ),
	) );

	//add the ability to sort products by "brand"
	register_taxonomy( 'brand', 'product', array(
		'hierarchical' 		=> true, //parent/child checkboxes like categories
		'show_admin_column' => true,
		'labels' 			=> array(
			'name' 				=> 'Brands', //human friendly, plural
			'singular_name'		=> 'Brand', //human friendly, singular
			'add_new_item'		=> 'Add New Brand',
		),
	) );

	//add the ability to sort products by "feature"
	register_taxonomy( 'feature', 'product', array(
		'hierarchical' 		=> false, //flat, like tags
		'show_admin_column' => true,  //display on the "products" admin page
		'labels' 			=> array(
			'name' 				=> 'Features', //human friendly, plural
			'singular_name'		=> 'Feature', //human friendly, singular
			'add_new_item'		=> 'Add New Feature',
		),
	) );

} //end of rad_products_cpt function


// Flush permalinks when this plugin activates
// so we don't see 404 pages when viewing our products

function rad_cpt_flush(){
	//create the products before flushing
	rad_products_cpt();
	//re-create the permalink rules
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'rad_cpt_flush' );
