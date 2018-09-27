<?php
// Register menus
register_nav_menus(
	array(
		'main-nav'     => __( 'The Main Menu', 'multiuso' ),   // Main nav in header
		'footer-links' => __( 'Footer Links', 'multiuso' ) // Secondary nav in footer
	)
);

// The Top Menu
if ( ! function_exists( 'multiuso_top_nav' ) ) {
	function multiuso_top_nav() {
		wp_nav_menu( array(
			'container'      => false,                           // Remove nav container
			'menu_class'     => 'medium-horizontal menu',       // Adding custom nav class
			'items_wrap'     => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
			'theme_location' => 'main-nav',                    // Where it's located in the theme
			'depth'          => 5,                                   // Limit the depth of the nav
			'fallback_cb'    => 'multiuso_link_to_menu_editor',                         // Fallback function (see below)
			'walker'         => new MULTIUSO_Topbar_Menu_Walker()
		) );
	}
}

if ( ! function_exists( 'multiuso_link_to_menu_editor' ) ) {
	function multiuso_link_to_menu_editor( $args ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// see wp-includes/nav-menu-template.php for available arguments
		extract( $args );

		$link = $link_before
		        . '<a href="' . admin_url( 'nav-menus.php' ) . '">' . $before . __( 'Add a menu', 'multiuso' ) . $after
		        . '</a>'
		        . $link_after;

		// We have a list
		if ( false !== stripos( $items_wrap, '<ul' ) or false !== stripos( $items_wrap, '<ol' ) ) {
			$link = "<li>$link</li>";
		}

		$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );

		if ( ! empty ( $container ) ) {
			$output = "<$container class='$container_class' id='$container_id'>$output</$container>";
		}

		if ( $echo ) {
			echo $output;
		}

		return $output;
	}
}

if ( ! class_exists( 'MULTIUSO_Topbar_Menu_Walker' ) ) {
	class MULTIUSO_Topbar_Menu_Walker extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth = 0, $args = Array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul class=\"menu\">\n";
		}
	}
}


// The Off Canvas Menu
if ( ! function_exists( 'multiuso_off_canvas_nav' ) ) {
	function multiuso_off_canvas_nav() {
		wp_nav_menu( array(
			'container'      => false,                           // Remove nav container
			'menu_class'     => 'vertical menu accordion-menu',                // Adding custom nav class
			'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
			'theme_location' => 'main-nav',                    // Where it's located in the theme
			'depth'          => 5,                                   // Limit the depth of the nav
			'fallback_cb'    => false,                         // Fallback function (see below)
			'walker'         => new MULTIUSO_Off_Canvas_Menu_Walker()
		) );
	}
}

if ( ! class_exists( 'MULTIUSO_Off_Canvas_Menu_Walker' ) ) {
	class MULTIUSO_Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth = 0, $args = Array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul class=\"vertical menu\">\n";
		}
	}
}


// The Footer Menu
if ( ! function_exists( 'multiuso_footer_links' ) ) {
	function multiuso_footer_links() {
		wp_nav_menu( array(
			'container'      => 'false',                         // Remove nav container
			'menu'           => __( 'Footer Links', 'multiuso' ),    // Nav name
			'menu_class'     => 'footer_menu',                        // Adding custom nav class
			'theme_location' => 'footer-links',             // Where it's located in the theme
			'depth'          => 0,                                   // Limit the depth of the nav
			'fallback_cb'    => ''                            // Fallback function
		) );
	} /* End Footer Menu */
}


// Header Fallback Menu
if ( ! function_exists( 'multiuso_main_nav_fallback' ) ) {
	function multiuso_main_nav_fallback() {
		wp_page_menu( array(
			'show_home'   => true,
			'menu_class'  => '',                            // Adding custom nav class
			'echo'        => true,
			'link_before' => '',                           // Before each link
			'link_after'  => ''                             // After each link
		) );
	}
}


// Footer Fallback Menu
if ( ! function_exists( 'multiuso_footer_links_fallback' ) ) {
	function multiuso_footer_links_fallback() {
		/* You can put a default here if you like */
	}
}


// Add Foundation active class to menu
if ( ! function_exists( 'multiuso_required_active_nav_class' ) ) {
	function multiuso_required_active_nav_class( $classes, $item ) {
		if ( $item->current == 1 || $item->current_item_ancestor == true ) {
			$classes[] = 'active';
		}

		return $classes;
	}
}

add_filter( 'nav_menu_css_class', 'multiuso_required_active_nav_class', 10, 2 );