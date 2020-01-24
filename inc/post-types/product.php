<?php 

function ut_product_post_type() {
	
	$labels = array(
		'name'               => __( 'Products', 'unreal-themes' ),
	    'singular_name'      => __( 'Product', 'unreal-themes' ),
	    'add_new'            => _x( 'Add new Product', 'unreal-themes', 'unreal-themes' ),
	    'add_new_item'       => __( 'Add new Product', 'unreal-themes' ),
	    'all_items'          => __( 'All Product', 'unreal-themes' ),
	    'edit_item'          => __( 'Edit Product', 'unreal-themes' ),
	    'name_admin_bar'     => __( 'Product', 'unreal-themes' ),
	    'menu_name'          => __( 'Product', 'unreal-themes' ),
	    'new_item'           => __( 'New Product', 'unreal-themes' ),
	    'not_found'          => __( 'No Product found', 'unreal-themes' ),
	    'not_found_in_trash' => __( 'No Product found in Trash', 'unreal-themes' ),
	    'search_items'       => __( 'Search Product', 'unreal-themes' ),
	    'view_item'          => __( 'View Product', 'unreal-themes' )
	  );
		
	$args = array(
		'labels' 				=> $labels,
		'menu_icon'				=> 'dashicons-carrot',
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'query_var' 			=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'supports' 				=> array( 'title', 'thumbnail', 'editor' ),
		// 'show_in_rest' => true,
	); 
	  
	register_post_type( 'product', $args );

}

add_action( 'init', 'ut_product_post_type' );