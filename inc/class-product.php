<?php

class UT_Product {

    private static $_instance = null;

    static public function getInstance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        add_action( 'init', function() {
          remove_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'woocommerce_template_loop_product_thumbnail' ], 10 );
          add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'woocommerce_template_loop_product_thumbnail' ], 10 );
        } );
    }

    public  function woocommerce_template_loop_product_thumbnail() {
      echo $this->woo_get_product_thumbnail();
    } 

    public  function woo_get_product_thumbnail( $size = 'shop_catalog' ) {

      global $post, $woocommerce;
      $output  = '<div class="thumbnail-wrap">';
      $output .= do_shortcode( '[yith_wcwl_add_to_wishlist]' ); 

      if ( has_post_thumbnail() ) {               
          $output .= get_the_post_thumbnail( $post->ID, $size );
      } else {
           $output .= wc_placeholder_img( $size );
           // Or alternatively setting yours width and height shop_catalog dimensions.
           // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
      }                       
      $output .= '</div>';
      return $output;
    }

} 