<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Theme Options', 'unreal-themes' ) )
    ->set_icon( 'dashicons-hammer' )
    ->set_page_menu_title( 'Settings template' )
	->add_tab( __('Header'), array(
        Field::make( 'image', 'logo_header', 'Logo' )->set_width( 100 ),
    ))
    ->add_tab( __('Footer'), array(
        Field::make( 'image', 'logo_footer', 'Logo' )->set_width( 8 ),
        Field::make( "text", "text_dev_footer", "Text developmer")->set_width( 20 ),
        Field::make( "text", "link_dev_footer", "Link developer")->set_width( 20 ),
        Field::make( "image", "img_dev_footer", "Image")->set_width( 8 ),
        Field::make( 'complex', 'rep_social_footer', 'Social network' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "image", "icon_rep_social_footer", "Image")->set_width( 50 ),
                Field::make( "text", "link_rep_social_footer", "Link")->set_width( 50 ),
            ))
    ))
    ->add_tab( __('Google'), array(
        Field::make( "text", "gmap_api_key", "Google Map API KEY")->set_width( 100 ),
        Field::make( 'header_scripts', 'ga_script', 'Script' )->set_width( 50 ),
        Field::make( 'textarea', 'aga_script', 'Additionaly script' )
            ->help_text('If you need to add scripts to after open tag BODY, you should enter them here.')
            ->set_width( 50 ),
    ));