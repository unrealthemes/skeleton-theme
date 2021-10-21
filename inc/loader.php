<?php

/**
 * Get instance of helper
 */
function ut_help() {
  return UT_Theme_Helper::get_instance();
}

/**
 * Main class of all tehe,e settings
 */
class UT_Theme_Helper {

  private static $_instance = null;

  // public $product;

  private function __construct() {

  }

  protected function __clone() {

  }

  static public function get_instance() {

  	if ( is_null( self::$_instance ) ) {
  	  self::$_instance = new self();
  	}
  	return self::$_instance;
  }

  /**
   * Load files, plugins, add hooks and filters and do all magic
   */
  function init() {

  	// load needed files
  	$this->import();
  	$this->load_classes();
  	$this->register_hooks();

  	return $this;
  }

  function load_classes() {

  	// $this->product = UT_Product::get_instance();
  }

  /**
   * Register all needed hooks
   */
  public function register_hooks() {

    // Carbon fields lib
    add_action( 'after_setup_theme', [ $this, 'carbon_fields_load' ] );
    add_action( 'carbon_fields_register_fields', [ $this, 'include_register_fields' ] );
    add_filter( 'carbon_fields_map_field_api_key', [ $this, 'get_gmaps_api_key' ] );

  	add_action( 'wp_enqueue_scripts', [ $this, 'load_scripts_n_styles' ] );
  	add_action( 'after_setup_theme',  [ $this, 'register_menus' ] );
  	add_action( 'after_setup_theme',  [ $this, 'add_theme_support' ] );
  }

  function register_menus() {

  	register_nav_menus( [
  	  'menu_1' => esc_html__( 'Header', 'unreal-theme' ),
  	  'menu_2' => esc_html__( 'Footer', 'unreal-theme' ),
  	] );
  }

  public function add_theme_support() {

  	add_theme_support( 'title-tag' );
  	add_theme_support( 'post-thumbnails' );
  	add_theme_support( 'html5', [
  	  'search-form',
  	  'comment-form',
  	  'comment-list',
  	  'gallery',
  	  'caption',
  	] );
  	add_theme_support( 'woocommerce' );
  }

  function load_scripts_n_styles() {
  	// ========================================= CSS ========================================= //
  	wp_enqueue_style( 'ut-style', get_stylesheet_uri() );
  	// wp_enqueue_style( 'ut-main', get_template_directory_uri() . '/styles/main.css' );
  	wp_enqueue_style( 'ut-woo', get_template_directory_uri() . '/styles/woocommerce.css' );
  	// ========================================= JS ========================================= //
  	//////////////////////////////////////
  	wp_deregister_script('jquery-core');
  	wp_register_script('jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', false, null, true);
  	wp_deregister_script('jquery');
  	wp_register_script('jquery', false, array('jquery-core'), null, true);
  	//////////////////////////////////////
  	wp_enqueue_script( 'ut-scripts', get_template_directory_uri() . '/scripts/scripts.js', array('jquery'), date("Ymd"), true );
  	wp_localize_script( 'ut-scripts', 'ut_params', [
  	  'ajaxurl'    => admin_url( 'admin-ajax.php' ),
  	  'ajax_nonce' => wp_create_nonce('ut_check'),
  	] );

  	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  	  wp_enqueue_script( 'comment-reply' );
  	}
    // add_filter( 'script_loader_tag', [ $this, 'add_async_defer_attr' ], 10, 3 );
  }

  public function add_async_defer_attr( $tag, $handle, $src ) {

    if ( 'ut-googleapis' === $handle ) {
      return str_replace( ' src', ' async defer src', $tag );
    }

    return $tag;
  }

  public function import() {

  	include_once 'disable-editor.php';
  	include_once 'pagination.php';
  	// include_once 'walker-nav-menu.php';
  	include_once 'template-functions.php';
  	// include_once 'woo-functions.php';
  	// include_once 'class-product.php';
  }

  public function carbon_fields_load() {

    require get_template_directory() . '/lib/carbon-fields/vendor/autoload.php';
    // require_once( '../lib/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
  }
  
  public function include_register_fields() {

    require get_template_directory() . '/inc/custom-fields/options.php';
    // require get_template_directory() . '/inc/custom-fields/home.php';
    // require get_template_directory() . '/inc/custom-fields/taxonomy/category.php';
  }

  public function get_gmaps_api_key( $current_key ) {

    $key = carbon_get_theme_option('gmap_api_key');

    return $key;
  }
  
  public function get_i18n_suffix() {

    $suffix = '';

    if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
      return $suffix;
    }
    $suffix = '_' . ICL_LANGUAGE_CODE;

    return $suffix;
  }

  public function get_i18n_theme_option( $option_name ) {

    $suffix = $this->get_i18n_suffix();

    return carbon_get_theme_option( $option_name . $suffix );
  }

}
