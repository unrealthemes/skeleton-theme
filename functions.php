<?php
/**
 * unreal-themes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package unreal-themes 
 */


include_once 'inc/loader.php'; // main helper for theme
ut_help()->init();


/**
 * Carbon Fields lib
 */

function crb_load() {
    require_once( 'lib/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'after_setup_theme', 'crb_load' );


function ut_attach_theme_options() {
    // require get_template_directory() . '/inc/custom-fields/options.php';
    // require get_template_directory() . '/inc/custom-fields/home.php';
	// require get_template_directory() . '/inc/custom-fields/taxonomy/category.php';
}
add_action( 'carbon_fields_register_fields', 'ut_attach_theme_options' );



/**
 * Carbon Google Maps Api Key
 */

function ut_get_gmaps_api_key( $current_key ) {
    return 'AIzaSyDcFp4c3Myxm4bQkci-dmUQW3AzJPYIg20';
}
add_filter('carbon_fields_map_field_api_key', 'ut_get_gmaps_api_key');



/**
 * Carbon Options WPML Support
 */

function ut_get_i18n_suffix() {
    $suffix = '';
    if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
        return $suffix;
    }
    $suffix = '_' . ICL_LANGUAGE_CODE;
    return $suffix;
}

function ut_get_i18n_theme_option( $option_name ) {
    $suffix = ut_get_i18n_suffix();
    return carbon_get_theme_option( $option_name . $suffix );
}