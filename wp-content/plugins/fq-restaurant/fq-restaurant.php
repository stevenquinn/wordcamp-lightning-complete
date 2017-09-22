<?php
	
/*
  Plugin Name: FQ Restaurant
  Author: Figoli Quinn & Associates
  Description: 
  Version: 1.0
*/



/**
 * Load admin scripts and stylesheet
 */
add_action('admin_enqueue_scripts', 'fq_restaurant_enqueue_admin');
function fq_restaurant_enqueue_admin(){
	wp_enqueue_script( 'jquery-ui-droppable' );
	wp_enqueue_style( 'fq-restaurant-admin-style', plugin_dir_url(__FILE__ ) . '/assets/css/fq-restaurant-admin.css', false, '1.0.0' );
	wp_enqueue_script( 'fq-restaurant-plugin-admin', plugins_url( '/assets/js/fq-restaurant-admin.js', __FILE__ ), array('jquery') );
}


// Include the different parts we'll need
include('includes/custom-post-types.php');