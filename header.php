<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title("",true); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<?php
		if ( has_nav_menu('menu_1') ) {
			wp_nav_menu( [
				'theme_location' => 'menu_1',
				'container'      => false,
				// 'walker'         => new UT_Mega_Menu(),
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			] );
		}
	?>

	<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
		<?php bloginfo( 'name' ); ?>
	</a>