<?php
/**
 * unreal-themes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package unreal-themes 
 */

define('THEME_URI', get_template_directory_uri());

// require_once('vendor/autoload.php'); // after composer update
include_once 'inc/loader.php'; // main helper for theme

ut_help()->init();