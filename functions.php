<?php
/** 
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */
if(!defined('MULTIUSO_THEME_ASSET_VERSION')) {
	define('MULTIUSO_THEME_ASSET_VERSION', '1.0');
}

// Theme support options
require_once(get_template_directory().'/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/functions/translation/translation.php');

// Adds widget
require_once(get_template_directory().'/inc/widgets/multiuso-recent-post-widget.php');
require_once(get_template_directory().'/inc/widgets/multiuso-social-widget.php');

// Adds Theme Customizer
require_once(get_template_directory().'/functions/customizer.php');
// Adds Theme Utility Function
require_once(get_template_directory().'/functions/utility.php');
// Adds Theme Metaboxes
require_once(get_template_directory().'/functions/metabox.php');


