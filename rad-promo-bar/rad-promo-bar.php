<?php 
/*
Plugin Name: Rad Promo Bar
Author: Melissa Cabral
Version: 0.3
License: GPLv3
Description: A very simple plugin for learning the basics. Adds an eye-catching bar to the top of the page to promote anything
*/

/**
 * HTML output for the bar
 * @since 0.1
 */
add_action( 'wp_footer', 'rad_bar_html' );
function rad_bar_html(){
	$values = get_option( 'rad_promo_bar' );
	?>
	<!-- Rad Promo Bar Plugin by Melissa Cabral -->
	<div id="rad-promo-bar">
		<span>
			<?php echo $values['bartext']; ?>
			<a href="<?php echo $values['url'] ?>">
				<?php echo $values['buttontext'] ?>
			</a>
		</span>		
	</div>
	<?php 
}


/**
 * Attach the CSS to make the bar look nice
 * @see https://codex.wordpress.org/Function_Reference/wp_enqueue_style 
 * @since 0.1
 */
function rad_bar_css(){
	//get the URL to the stylesheet
	$url = plugins_url( 'css/rad-promo.css', __FILE__ );
	//register the stylesheet
	wp_register_style( 'rad-promo-style', $url );
	//put it on the page
	wp_enqueue_style( 'rad-promo-style' );
}
add_action( 'wp_enqueue_scripts', 'rad_bar_css' );

/**
 * BONUS ROUND!  Add options page to the admin panel
 */
//1. whitelist the options/settings
add_action( 'admin_init', 'rad_bar_settings' );
function rad_bar_settings(){
	//					name of the group     DB row name    sanitizing function
	register_setting( 'rad_promo_bar_group', 'rad_promo_bar', 'rad_bar_sanitize' );
}

//2. sanitize the user input (called by register_setting())
function rad_bar_sanitize($dirty){
	//clean all fields
	$clean['bartext'] = wp_filter_nohtml_kses( $dirty['bartext'] );
	$clean['buttontext'] = wp_filter_nohtml_kses( $dirty['buttontext'] );
	$clean['url'] = wp_filter_nohtml_kses( $dirty['url'] );
	
	//added color picker
	$clean['barcolor'] = wp_filter_nohtml_kses( $dirty['barcolor'] );
	$clean['buttoncolor'] = wp_filter_nohtml_kses( $dirty['buttoncolor'] );
	
	return $clean;
}


//3. add a settings page for the plugin with UI/form
function rad_bar_page(){
	add_options_page('Promo Bar Settings', 'Promo Bar', 'manage_options', 'rad-promo-bar', 
		'rad_bar_form');
}
add_action('admin_menu', 'rad_bar_page');


//the callback function for the HTML form (called by add_options_page())
function rad_bar_form(){
	include( plugin_dir_path( __FILE__ ) . 'rad-promo-options-form.php' );
}

/**
 * BONUS BONUS: Color picker API. Load JS assets for the picker
 * @since  0.3
 * @see http://code.tutsplus.com/articles/how-to-use-wordpress-color-picker-api--wp-33067
 */
add_action( 'admin_enqueue_scripts', 'rad_bar_add_color_picker' );
function rad_bar_add_color_picker() { 
    if( is_admin() ) {      
        // Add the color picker css file (built-in to WP)      
        wp_enqueue_style( 'wp-color-picker' );          
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'rad_bar_colorpicker', plugins_url( 'scripts/custom.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}

//BONUS: custom color embedded css
function rad_bar_embed_css(){
	$values = get_option( 'rad_promo_bar' );
	?>
	<style type="text/css">
	#rad-promo-bar{
		background-color: <?php echo $values['barcolor']; ?> ;
	}
	#rad-promo-bar a{
		background-color:<?php echo $values['buttoncolor']; ?>;
	}
	</style>
	<?php
}
add_action( 'wp_head', 'rad_bar_embed_css' );

//no close php 