<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Theme Options', 'green_paradise' ) )
    ->set_icon( 'dashicons-hammer' )
    ->set_page_menu_title( 'Настройки шаблона' )
	->add_tab( __('Header'), array(
        Field::make( 'image', 'logo_header', 'Логотип' )->set_value_type( 'url' )->set_width( 100 ),
        Field::make( "text", "mode_header", "Режим работы (время)")->set_width( 50 ),
        Field::make( "text", "text_mode_header", "Режим работы (дни)")->set_width( 50 ),
        Field::make( "text", "phone_header", "Телефон")->set_width( 50 ),
        Field::make( "text", "text_phone_header", "Текст")->set_width( 50 ),
        Field::make( "text", "contact_phone_header", "Контактный телефон")->set_width( 20 ),
        Field::make( "text", "contact_viber_header", "Viber")->set_width( 20 ),
        Field::make( "text", "contact_whatsapp_header", "WhatsApp")->set_width( 20 ),
        Field::make( "text", "contact_telegram_header", "Telegram")->set_width( 20 ),
    ))
    ->add_tab( __('Footer'), array(
        Field::make( 'image', 'logo_footer', 'Логотип' )->set_value_type( 'url' )->set_width( 8 ),

        Field::make( "text", "text_dev_footer", "Текст разработчика")->set_width( 20 ),
        Field::make( "text", "link_dev_footer", "Ссылка разработчика")->set_width( 20 ),
        Field::make( "image", "img_dev_footer", "Изображение")->set_width( 8 ),

        Field::make( 'complex', 'rep_phone_footer', 'Телефоны' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "text", "number_rep_phone_footer", "Номер телефона")
            )),
        Field::make( 'complex', 'rep_social_footer', 'Социальные сети' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "image", "icon_rep_social_footer", "Иконка (svg)")->set_width( 50 ),
                Field::make( "text", "link_rep_social_footer", "Ссылка")->set_width( 50 ),
            ))
    ))
    ->add_tab( __('Растения'), array(
        Field::make( 'complex', 'rep_advantages_plants', 'Преимущества' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "image", "icon_rep_advantages_plants", "Иконка (svg)")->set_width( 8 ),
                Field::make( "text", "text_rep_advantages_plants", "Текст")->set_width( 88 ),
            )),
        Field::make( 'text', 'title_recent_plants', 'Заглавие секции "Recent posts"' )
    ));