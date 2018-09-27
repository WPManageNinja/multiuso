<?php
// SIDEBARS AND WIDGETIZED AREAS
if ( ! function_exists( 'multiuso_register_sidebars' ) ) {
	function multiuso_register_sidebars() {
		register_sidebar( array(
			'id'            => 'sidebar1',
			'name'          => __( 'Sidebar 1', 'multiuso' ),
			'description'   => __( 'The first (primary) sidebar.', 'multiuso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
			'class'         => 'ul-class-name',
		) );

		register_sidebar( array(
			'id'            => 'offcanvas',
			'name'          => __( 'Offcanvas', 'multiuso' ),
			'description'   => __( 'The offcanvas sidebar.', 'multiuso' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'id'            => 'footerlink',
			'name'          => __( 'Footer Link One', 'multiuso' ),
			'description'   => __( 'Add custom menu for footer.', 'multiuso' ),
			'before_widget' => '<div id="%1$s" class="widget footer_link_nav foot_space">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'id'            => 'footerlink_two',
			'name'          => __( 'Footer Link Two', 'multiuso' ),
			'description'   => __( 'Add custom menu for footer.', 'multiuso' ),
			'before_widget' => '<div id="%1$s" class="widget footer_link_nav foot_space">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'id'            => 'footerlink_three',
			'name'          => __( 'Footer Link Three', 'multiuso' ),
			'description'   => __( 'Add custom menu for footer.', 'multiuso' ),
			'before_widget' => '<div id="%1$s" class="widget footer_link_nav foot_space">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'id'            => 'footermeta',
			'name'          => __( 'Footer Meta Area', 'multiuso' ),
			'description'   => __( 'Add your footer meta information', 'multiuso' ),
			'before_widget' => '<div id="%1$s" class="widget footer_link_nav foot_space %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );

		/*
		to add more sidebars or widgetized areas, just copy
		and edit the above sidebar code. In order to call
		your new sidebar just use the following code:
	
		Just change the name to whatever your new
		sidebar's id is, for example:
	
		register_sidebar(array(
			'id' => 'sidebar2',
			'name' => __('Sidebar 2', 'multiuso'),
			'description' => __('The second (secondary) sidebar.', 'multiuso'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
	
		To call the sidebar in your template, you can just copy
		the sidebar.php file and rename it to your sidebar's name.
		So using the above example, it would be:
		sidebar-sidebar2.php
	
		*/
	} // don't remove this bracket!
}
