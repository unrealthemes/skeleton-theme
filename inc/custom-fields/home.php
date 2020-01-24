<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Custom Data')
	->show_on_template('template-home.php')
	->show_on_post_type('page') 
    ->add_tab( 'Слайдер', array(
        Field::make( "textarea", "title_slider_home", "Заглавие")->set_width( 20 ),
        Field::make( "text", "text_popup_btn_slider_home", "Текст кнопки всплывающего окна")->set_width( 20 ),
        Field::make( "text", "text_link_slider_home", "Текст ссылки")->set_width( 20 ),
        Field::make( "text", "link_slider_home", "Ссылка")->set_width( 20 ),
        Field::make( "media_gallery", "slider_home", "Слайдер")->set_width( 100 ),        
        // Field::make( 'complex', 'rep_slider_home', 'Слайды' )->set_collapsed( true )
        //     ->add_fields( array(
        //         Field::make( "image", "img_rep_slider_home", "Изображение")->set_value_type( 'url' )->set_width( 8 ),
        //         Field::make( "textarea", "title_rep_slider_home", "Заглавие")->set_width( 88 ),
        //         Field::make( "text", "text_popup_btn_rep_slider_home", "Текст кнопки всплывающего окна")->set_width( 33.3 ),
        //         Field::make( "text", "text_link_rep_slider_home", "Текст ссылки")->set_width( 33.3 ),
        //         Field::make( "text", "link_rep_slider_home", "Ссылка")->set_width( 33.3 )
        //     ))
    ))
    ->add_tab( 'Категории', array(
        Field::make( 'association', 'rep_category_home' )
            ->set_max( 3 )
            ->set_types( array(
                array(
                    'type' => 'term',
                    'taxonomy' => 'plants_category',
                )
            ) )
    ))
    ->add_tab( 'Рекомендуем', array(
        Field::make( "text", "title_recomended_home", "Заглавие"),
        /*Field::make( 'association', 'action_recomended_home', 'Акции' )
            ->set_types( array(
                array(
                    'type' => 'post',
                    'post_type' => 'plants',
                )
            ) ),
        Field::make( 'association', 'new_recomended_home', 'Новинки' )
            ->set_types( array(
                array(
                    'type' => 'post',
                    'post_type' => 'plants',
                )
            ) ),
        Field::make( 'association', 'new_exclusive_home', 'Эксклюзивные растения' )
            ->set_types( array(
                array(
                    'type' => 'post',
                    'post_type' => 'plants',
                )
            ) )*/
    ))
	->add_tab( 'Преимущества', array(
        Field::make( "image", "bg_advantages_home", "Фоновое изображение")->set_value_type( 'url' )->set_width( 8 ),
        Field::make( "text", "title_advantages_home", "Заглавие секции")->set_width( 88 ),
		Field::make( 'complex', 'rep_advantages_home', 'Преимущество' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "image", "img_rep_advantages_home", "Иконка (svg)")->set_width( 8 ),
                Field::make( "text", "text_rep_advantages_home", "Текст")->set_width( 88 )
            ))
	))
    ->add_tab( 'Информация', array(
        Field::make( "text", "title_info_home", "Заглавие секции")->set_width( 100 ),
        Field::make( "rich_text", "l_block_info_home", "Левый блок")->set_width( 50 ),
        Field::make( "rich_text", "r_block_info_home", "Правый блок")->set_width( 50 )
    ))
    ->add_tab( 'Видео', array(
        Field::make( 'image', 'bg_video_home', 'Фоновое изображение' )->set_value_type( 'url' )->set_width( 8 ),
        Field::make( 'text', 'text_btn_video_home', 'Текст кнопки' )->set_width( 88 ),
        Field::make( 'oembed', 'video_home', 'Ссылка на видео YouTube' )
    ));