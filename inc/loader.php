<?php

/**
 * Get instance of helper
 */
function ut_help() {
  	return UT_Theme_Helper::get_instance();
}

/**
 * Main class of all theme settings
 */
class UT_Theme_Helper {

	const THEME_VERSION = '1.0';

  	private static $_instance = null;

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
		$this->classes();
		$this->register_hooks();

		return $this;
	}

	function classes() {

		new App\Classes\Example();
		new App\Classes\Guneberg_Blocks();
	}

	/**
	 * Register all needed hooks
	 */
	public function register_hooks() {

		add_action( 'wp_enqueue_scripts', [ $this, 'load_scripts_n_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'load_admin_scripts_n_styles' ] );
		add_action( 'after_setup_theme',  [ $this, 'register_menus' ] );
		add_action( 'after_setup_theme',  [ $this, 'add_theme_support' ] );
		// add_action( 'widgets_init', [ $this, 'widgets_init' ] );
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

	// public function widgets_init() {
	
		// 	register_sidebar( array(
		// 		'name'          => 'UT Widget Area',
		// 		'id'            => 'ut-widget',
		// 		'before_widget' => '<div class="chw-widget">',
		// 		'after_widget'  => '</div>',
		// 		'before_title'  => '<h2 class="chw-title">',
		// 		'after_title'   => '</h2>',
		// 	) );
		
		// }

	function load_scripts_n_styles() {
		// ========================================= CSS ========================================= //
		wp_enqueue_style( 'ut-style', get_stylesheet_uri(), [], self::THEME_VERSION );
		// wp_enqueue_style( 'ut-example', THEME_URI . '/styles/example.css', [], self::THEME_VERSION );
		// wp_enqueue_style( 'ut-font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css', [], self::THEME_VERSION );
		// ========================================= JS ========================================= //
		//////////////////////////////////////
		wp_deregister_script('jquery-core');
		wp_register_script('jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js', false, self::THEME_VERSION, true);
		wp_deregister_script('jquery');
		wp_register_script('jquery', false, ['jquery-core'], self::THEME_VERSION, true);
		//////////////////////////////////////
		wp_enqueue_script( 'ut-scripts', THEME_URI . '/js/scripts.js', ['jquery'], self::THEME_VERSION, true );
		wp_localize_script( 
			'ut-scripts', 
			'ut_params', [
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'ut_check' ),
			] 
		);

		// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		// 	wp_enqueue_script( 'comment-reply' );
		// }
		// add_filter( 'script_loader_tag', [ $this, 'add_async_defer_attr' ], 10, 3 );
	}

	function load_admin_scripts_n_styles() {
		// ========================================= CSS ========================================= //
		// wp_enqueue_style( 'ut-admin', THEME_URI . '/admin.css', [], self::THEME_VERSION );
		// ========================================= JS ========================================= //
	}

	// public function add_async_defer_attr( $tag, $handle, $src ) {

	// 	if ( 'ut-googleapis' === $handle ) {
	// 		return str_replace( ' src', ' async defer src', $tag );
	// 	}

	//   return $tag;
	// }

	public function import() {

		include_once 'helpers.php';
		// include_once 'theme-functions.php';
		// include_once 'woo-functions.php';
		// include_once 'disable-editor.php';
	}

}
