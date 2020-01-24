<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Описание')
	->show_on_post_type('product') 
    ->add_fields( array( 
        Field::make( 'complex', 'rep_product', 'Блоки' )->set_collapsed( true )  
            ->set_collapsed( true )
            ->add_fields( array( 
                Field::make( "text", "title_rep_product", "Заглавие")->set_width( 50 ),    
                Field::make( "textarea", "txt_rep_product", "Описание")->set_width( 50 ),    
            ))
    ));

