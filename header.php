<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php bloginfo('name'); ?> <?php wp_title("",true); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php echo carbon_get_theme_option('aga_script'); ?>

	<?php
		if ( has_nav_menu('menu_1') ) {
			wp_nav_menu( [
				'theme_location' => 'menu_1',
				'container'      => false,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			] );
		}
	?>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php bloginfo( 'name' ); ?>
	</a>