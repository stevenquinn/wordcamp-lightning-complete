<?php
	
	
function fq_restaurant_get_food_menu_items($post_id) {
	$query = new WP_Query(array(
		'post_type' => 'food_item',
		'posts_per_page' => -1,
		'post__not_in' => array($post_id),
		'meta_key' => 'food_menu',
		'meta_value' => $post_id
	));
	
	return $query;
}


function fq_restaurant_get_related_items($post_id) {
	$foodMenu = get_field('food_menu', $post_id);
	
	$query = new WP_Query(array(
		'post_type' => 'food_item',
		'posts_per_page' => -1,
		'post__not_in' => array($post_id),
		'meta_key' => 'food_menu',
		'meta_value' => $foodMenu->ID
	));
	
	return $query;
}


function fq_restaurant_get_menu_name($post_id) {
	$foodMenu = get_field('food_menu', $post_id);
	return $foodMenu->post_title;
}