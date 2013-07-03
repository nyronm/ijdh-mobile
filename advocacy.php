<?php
	/// this add a category like to post menu named advocacy
function add_custom_taxonomies() {
	// Add new "Advocacy" taxonomy to Posts
	register_taxonomy('advocacy', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Advocacy', 'taxonomy general name' ),
			'singular_name' => _x( 'Advocacy', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Advocacy' ),
			'all_items' => __( 'All Advocacies' ),
			'parent_item' => __( 'Parent Advocacy' ),
			'parent_item_colon' => __( 'Parent Advocacy:' ),
			'edit_item' => __( 'Edit Advocacy' ),
			'update_item' => __( 'Update Advocacy' ),
			'add_new_item' => __( 'Add New Advocacy' ),
			'new_item_name' => __( 'New Advocacy Name' ),
			'menu_name' => __( 'Advocacies' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'advocacies', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_custom_taxonomies', 0 );
?>
