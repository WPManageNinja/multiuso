<?php

// Adding WP Functions & Theme Support
if ( ! function_exists( 'multiuso_theme_support' ) ) {
	function multiuso_theme_support() {

		// Add WP Thumbnail Support
		add_theme_support( 'post-thumbnails' );

		// Default thumbnail size
		set_post_thumbnail_size( 125, 125, true );

		// Add RSS Support
		add_theme_support( 'automatic-feed-links' );

		// Add Support for WP Controlled Title Tag
		add_theme_support( 'title-tag' );

		// Add HTML5 Support
		add_theme_support( 'html5',
			array(
				'comment-list',
				'comment-form',
				'search-form',
			)
		);

		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		/*// Adding post format support
		 add_theme_support( 'post-formats',
			array(
				'aside',             // title less blurb
				'gallery',           // gallery of images
				'link',              // quick link to other site
				'image',             // an image
				'quote',             // a quick quote
				'status',            // a Facebook like status update
				'video',             // video
				'audio',             // audio
				'chat'               // chat transcript
			)
		);*/
		$defaults = array(
			'default-color'          => '',
			'default-image'          => '',
			'default-repeat'         => '',
			'default-position-x'     => '',
			'default-attachment'     => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);
		add_theme_support( 'custom-background', $defaults );

		$defaults = array(
			'default-image'          => '',
			'width'                  => 0,
			'height'                 => 0,
			'flex-height'            => false,
			'flex-width'             => false,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-header', $defaults );
		// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
		$GLOBALS['content_width'] = apply_filters( 'multiuso_theme_support', 1200 );

		// Add New Image size
		add_image_size( 'multiuso-sidebar-recent-post', 200, 184, true );
		//editor style
		add_editor_style();

	} /* end theme support */
}


add_action( 'after_setup_theme', 'multiuso_theme_support' );