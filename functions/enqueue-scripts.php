<?php
if ( ! function_exists( 'multiuso_site_scripts' ) ) {
	function multiuso_site_scripts() {
		if ( multiuso_need_owl() ) {
			wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/assets/styles/owl.carousel.min.css',
				array(), MULTIUSO_THEME_ASSET_VERSION, 'all' );
			wp_register_script( 'owlcarousel', get_template_directory_uri() . '/assets/scripts/owl.carousel.min.js',
				array( 'jquery' ), MULTIUSO_THEME_ASSET_VERSION, true );
		}

		wp_enqueue_style( 'multiuso-main-style', get_template_directory_uri() . '/assets/styles/style.css', array(),
			MULTIUSO_THEME_ASSET_VERSION, 'all' );
		wp_enqueue_style(
			'multiuso-customizer-style',
			get_template_directory_uri() . '/assets/styles/multiuso-customizer-style.css',
			array(),
			MULTIUSO_THEME_ASSET_VERSION
		);

		wp_enqueue_style( 'linearicons-free', get_template_directory_uri() . '/assets/styles/icon-font.min.css',
			array(), MULTIUSO_THEME_ASSET_VERSION, 'all' );


		//Site  site-scripts
//	wp_enqueue_script( 'multiuso-site-scripts', get_template_directory_uri() . '/assets/scripts/site-scripts.js', array( 'jquery' ), MULTIUSO_THEME_ASSET_VERSION, true );

		// Adding scripts file in the footer
		wp_enqueue_script( 'multiuso-main-js', get_template_directory_uri() . '/assets/scripts/scripts.js',
			array( 'jquery' ), MULTIUSO_THEME_ASSET_VERSION, true );

		// Comment reply script for threaded comments
		if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'multiuso_site_scripts', 999 );

if ( ! function_exists( 'multiuso_need_owl' ) ) {
	function multiuso_need_owl() {
		$isHome = ! is_paged() && is_home();
		$isCarasol = ( get_theme_mod( 'multiuso_taxonomy_dropdown_setting' )
		               && get_theme_mod( 'multiuso_taxonomy_dropdown_setting' ) != '-1' )
		             || get_theme_mod( 'multiuso_taxanomy_carousel_checkbox' );

		$result = false;

		if ( $isHome && $isCarasol ) {
			$result = true;
		}

		return apply_filters( 'multiuso_is_enqueue_owl', $result );
	}
}
