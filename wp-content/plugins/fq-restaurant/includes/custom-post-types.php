<?php
/**
 * @file
 * Create custom post types for the site
 * Handle custom functionality related to them as well
 * 
 */
 
 
 /**
 * Create the custom post types we'll need
 */
add_action('init', 'fq_restaurant_create_custom_post_types');
function fq_restaurant_create_custom_post_types()
{
	// Food Menu custom post type
	$labels = array(
		'name'               => _x( 'Food Menu', 'post type general name' ),
		'singular_name'      => _x( 'Food Menu', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Food Menu' ),
		'add_new_item'       => __( 'Add New Food Menu' ),
		'edit_item'          => __( 'Edit Food Menu' ),
		'new_item'           => __( 'New Food Menu' ),
		'all_items'          => __( 'All Food Menus' ),
		'view_item'          => __( 'View Food Menu' ),
		'search_items'       => __( 'Search Food Menus' ),
		'not_found'          => __( 'No Food Menus found' ),
		'not_found_in_trash' => __( 'No Food Menus found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Food Menus'
	);
	
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds Food Menus',
		'public'        => true,
		'publicly_queryable' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-carrot',
		'supports'      => array( 'title', 'editor' ),
		'has_archive'   => true,
	);
	
	register_post_type('food_menu', $args);
	
	
	// Food Item custom post type
	$labels = array(
		'name'               => _x( 'Food Item', 'post type general name' ),
		'singular_name'      => _x( 'Food Item', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Food Item' ),
		'add_new_item'       => __( 'Add New Food Item' ),
		'edit_item'          => __( 'Edit Food Item' ),
		'new_item'           => __( 'New Food Item' ),
		'all_items'          => __( 'All Food Items' ),
		'view_item'          => __( 'View Food Item' ),
		'search_items'       => __( 'Search Food Items' ),
		'not_found'          => __( 'No Food Items found' ),
		'not_found_in_trash' => __( 'No Food Items found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Food Items'
	);
	
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds Food Item',
		'public'        => true,
		'publicly_queryable' => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor' ),
		'has_archive'   => false,
	);
	
	register_post_type('food_item', $args);	
	
	flush_rewrite_rules();
}





// Add our hooks for adding meta boxes
add_action( 'load-post.php', 'fq_restaurant_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'fq_restaurant_post_meta_boxes_setup' );

/**
 * Add action for creating custom post meta boxes
 */
function fq_restaurant_post_meta_boxes_setup() {
	// hook adding the meta boxes 
	add_action( 'add_meta_boxes', 'fq_restaurant_add_post_meta_boxes' );
	
	// Hook saving the meta boxes
	add_action('save_post', 'fq_restaurant_save_post_meta_boxes', 10, 2);
}

/**
 * Create the meta boxes
 */
function fq_restaurant_add_post_meta_boxes() {
	
	// Food Item Fields
	add_meta_box(
		'food-item-fields',
		esc_html__( 'Food', 'food-item-fields' ),
		'fq_restaurant_food_menu_fields_meta_box', 
		'food_menu', 
		'normal',  
		'low' 
	);
	
}

/**
 * Callback for the food menu fields
 */
function fq_restaurant_food_menu_fields_meta_box($object, $box) {
	// Fetch any food items for this menu
	$foodItems = fq_restaurant_get_menu_food_items($object->ID);
	
	// Load our HTML template
	include('metaboxes/food-menu-food-items-metabox-fields.php');
}

/**
 * Get the food items related to a food menu
 */
function fq_restaurant_get_menu_food_items($post_id) {
	return new WP_Query(array(
		'post_type'      => 'food_item',
		'posts_per_page' => -1,
		'meta_key' => '_food_menu_id',
		'meta_value' => $post_id,
		'meta_value_num' => '_weight',
		'orderby'        => 'meta_value_num',
		'order'          => 'asc'
	));
}



/**
 * Saving the meta boxes
 */
function fq_restaurant_save_post_meta_boxes($post_id, $post) {
    
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
	
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) ) {
		return $post->ID;
	}
		
	// Saving the custom song fields
	if ($post_type->name == 'food_menu') {
				
		// Get the existing food items for this menu
		$query = new WP_Query(array(
			'post_type'      => 'food_item',
			'posts_per_page' => -1,
			'meta_key'       => '_food_menu_id',
			'meta_value'     => $post_id,
		));
		$existingIDs = array();
		
		if ($query->have_posts()) {
			foreach ($query->posts as $post) {
				$existingIDs[] = $post->ID;
			}
		}
		
		// Save associated food items
		if (isset($_REQUEST['fooditem'])) {
			$foodItems = $_REQUEST['fooditem'];
						
			foreach ($foodItems as $key => $item) {
				$newPostID = '';
				
				// Do we need to update existing post, or create a new one?
				if (!empty($item['title'])) {
					if (empty($item['id'])) {
						$newPostID = fq_restaurant_create_new_food_item($post_id, $item, $key);
					}
					else {
						$newPostID = fq_restaurant_update_food_item($post_id, $item, $key);
						
						// Remove this from the array of existing posts so we can figure out what's left
						if(($key = array_search($item['id'], $existingIDs)) !== false) {
						    unset($existingIDs[$key]);
						}
					}
					
					// Add the price field
					update_post_meta($newPostID, '_price', $item['price']);
					
					// Attach it to the menu
					update_post_meta($newPostID, '_food_menu_id', $post_id);
					
					// Update the weight / order
					update_post_meta($newPostID, '_weight', $key);
				}
			}
		}
		
		// Handle deleting anything left over
		if (!empty($existingIDs)) {
			foreach ($existingIDs as $deleteID) {
				wp_delete_post($deleteID, true);
			}
		}
		
	}
	
}


/**
 * Create a new food item and associate it with a food menu
 */
function fq_restaurant_create_new_food_item($menu_id, $item) {
	// Format the data for the post
	$postData = array(
		'post_title'   => $item['title'],
		'post_content' => $item['description'],
		'post_status'  => 'publish',
		'post_type'    => 'food_item'
	);
	
	// Insert the new post
	$newPostID = wp_insert_post($postData);
	
	return $newPostID;
}

/**
 * Update an existing food item
 */
function fq_restaurant_update_food_item($menu_id, $item) {
	// Format the data for the post
	$postData = array(
		'ID'           => $item['id'],
		'post_title'   => $item['title'],
		'post_content' => $item['description'],
	);
	
	// Insert the new post
	$newPostID = wp_update_post($postData);
	
	return $newPostID;
}