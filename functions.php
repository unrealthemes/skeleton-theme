<?php
/**
 * unreal-themes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package unreal-themes
 */



/**
 * Carbon Fields lib
 */
add_action( 'after_setup_theme', 'crb_load' );

function crb_load() {
    require_once( 'lib/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'carbon_fields_register_fields', 'ut_attach_theme_options' );

function ut_attach_theme_options() {

    require get_template_directory() . '/inc/custom-fields/options.php';
    require get_template_directory() . '/inc/custom-fields/home.php';
	// require get_template_directory() . '/inc/custom-fields/taxonomy/category.php';
}

function ut_get_gmaps_api_key($current_key){
    return 'AIzaSyDcFp4c3Myxm4bQkci-dmUQW3AzJPYIg20';
}
add_filter('carbon_fields_map_field_api_key', 'ut_get_gmaps_api_key');


if ( ! function_exists( 'ut_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ut_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on unreal-themes, use a find and replace
		 * to change 'unreal-themes' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'unreal-themes', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'unreal-themes' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'ut_setup' );



/**
 * Enqueue scripts and styles.
 */
function ut_scripts() {
	// ========================================= CSS ========================================= //
	wp_enqueue_style( 'unreal-themes-style', get_stylesheet_uri() );
	// ========================================= JS ========================================= //
	// wp_deregister_script( 'jquery' );
	// wp_register_script( 'jquery', get_template_directory_uri() . '/scripts/jquery.js');
	// wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'ut-scripts-js', get_template_directory_uri() . '/js/scripts.js', array(), date("Ymd"), true );

	wp_localize_script( 'ut-scripts-js', 'main_params', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ), 
		'ajax_nonce' => wp_create_nonce('ut_check'),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ut_scripts' );



/**
 *
 */
/*function ut_add_async_attribute( $tag, $handle ) {

    if ( 'ut-maps-js' !== $handle ) {
        return $tag;
    }
 
    return str_replace( ' src', ' async="async" src', $tag );
}
add_filter( 'script_loader_tag', 'ut_add_async_attribute', 10, 2 );*/



/**
 * Disabling Gutenberg on certain templates.
 */
require get_template_directory() . '/inc/disable-editor.php';



/**
 * Post type 'Product'.
 */
require get_template_directory() . '/inc/post-types/product.php';



/**
 * Breadcrumbs.
 */
require get_template_directory() . '/inc/breadcrumbs.php';



/**
 * Pagination.
 */
require get_template_directory() . '/inc/pagination.php';



/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';



/**
 * Functions which enhance the theme by hooking into Woocommerce.
 */
require get_template_directory() . '/inc/woo-functions.php';



/**
 * Custom menu.
 */
require get_template_directory() . '/inc/walker-nav-menu.php';