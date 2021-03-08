<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */



/**
 * Get permalink by template name
 */

function ut_get_permalik_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template
		] );
		$template_id = $pages[0]->ID;
		$page = get_post( $template_id );
		$result = get_permalink( $page );
	}
	
	return $result;
}



/**
 * Get permalink by template name
 */

function ut_get_page_id_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template
		] );
		$result = $pages[0]->ID;
	}
	
	return $result;
}



/**
 * Get name menu by location
 */

function ut_get_title_menu_by_location( $location ) {

    if ( empty( $location ) ) {
    	return false;
	}
    $locations = get_nav_menu_locations();

    if ( ! isset( $locations[ $location ] ) ) {
    	return false;
	}
    $menu_obj = get_term( $locations[ $location ], 'nav_menu' );

    return $menu_obj->name;
}



/** 
 * Admin footer modification
 */   

function ut_remove_footer_admin() {

    echo '<span id="footer-thankyou">Тема разработана <a href="https://unrealthemes.ru/" target="_blank"><img src="' . get_template_directory_uri() . '/img/unreal.png" width="130"/></a></span>';
}
add_filter('admin_footer_text', 'ut_remove_footer_admin');



/**
 * SVG to upload mimes.
 */

function ut_add_svg_to_upload_mimes( $upload_mimes ) {

    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';

    return $upload_mimes;
}
add_filter( 'upload_mimes', 'ut_add_svg_to_upload_mimes', 10, 1 );



/** 
 * Add options page ACF pro
 */ 

// if( function_exists('acf_add_options_page') ) {
// 	acf_add_options_page();
// }



/**
 * Style for repeater carbon fields
 */

function ut_admin_style() {

  	echo '<style>
		    body .cf-complex__group-head {
		        background: #363b3f;
		        color: #f9f9f9; 
		    }
		    body .carbon-groups-holder .carbon-row:last-child {
			    border: 2px solid #363b3f;
			}
		  </style>';
}
add_action( 'admin_head', 'ut_admin_style' ); 



/**
 * Custom excerpt
 */

// add_filter( 'excerpt_length', function() {
// 	return 23;
// } );

// add_filter('excerpt_more', function( $more ) {
// 	return '...';
// });



/**
 *
 */

function ut_format_size_units( $bytes ) {

    if ( $bytes >= 1073741824 ) {
        $bytes = number_format( $bytes / 1073741824, 2 ) . ' GB';
    } elseif ( $bytes >= 1048576 ) {
        $bytes = number_format( $bytes / 1048576, 2 ) . ' MB';
    } elseif ( $bytes >= 1024 ) {
        $bytes = number_format( $bytes / 1024, 2 ) . ' KB';
    } elseif ( $bytes > 1 ) {
        $bytes = $bytes . ' bytes';
    } elseif ( $bytes == 1 ) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}



/**
 *	Remove prefix in default mime type ( application/pdf = pdf )
 */

function ut_mime_type_without_application( $defailt_mime_type ) {

	$mime_type = '';
	$remove_txts = array( 'application/', 'video/', 'image/', 'audio/' );

	foreach( $remove_txts as $remove_txt ) {

		if ( strstr( $defailt_mime_type, $remove_txt ) ) {
			$mime_type = str_replace( $remove_txt, "", $defailt_mime_type );
		}
	}

	return $mime_type;
}



/**
 * Remove feature image and comment for post type "page"
 */

// function ut_cpt_support() {
//     remove_post_type_support( 'page', 'thumbnail' );
//     remove_post_type_support( 'page', 'comments' );
//     remove_post_type_support( 'page', 'comments' );
// }
// add_action( 'admin_init', 'ut_cpt_support' );



/**
 * Cancel the display of the selected term at the top in the checkbox list of terms
 */

function ut_set_checked_ontop_default( $args ) {
	// change the default parameter to false
	if ( ! isset( $args['checked_ontop'] ) ) {
		$args['checked_ontop'] = false;
	}

	return $args;
}
add_filter( 'wp_terms_checklist_args', 'ut_set_checked_ontop_default', 10 );