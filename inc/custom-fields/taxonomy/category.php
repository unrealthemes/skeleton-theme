<?php 

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'term_meta', 'Category setting' )
    ->where( 'term_taxonomy', '=', 'category' )
    ->add_fields( array(
        Field::make( 'text', 'title_plants_category', 'Заглавие описания' )->set_width( 100 ),
        Field::make( 'image', 'bg_plants_category', 'Фоновое изображение' )->set_value_type( 'url' )->set_width( 8 ),
        Field::make( 'image', 'icon_plants_category', 'Иконка (svg)' )->set_width( 8 )
    ) );