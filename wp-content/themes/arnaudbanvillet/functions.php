<?php

/*
 * @package WordPress
 * @subpackage ArnaudBanvillet.com
 */

//Add custom post type : Portfolio
require_once 'portfolio_custom_post_type.php';


// Add Scripte and style
function arnaudbanvillet_add_script(){

	wp_enqueue_style('screen', get_stylesheet_directory_uri().'/stylesheets/screen.css', array(), '1.0', 'screen, projection');


}
add_action('wp_enqueue_scripts', 'arnaudbanvillet_add_script');
