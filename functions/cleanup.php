<?php

// Fire all our initial functions at the start
if ( ! function_exists( 'multiuso_start' ) ) {
	function multiuso_start() {

		// remove pesky injected css for recent comments widget
		add_filter( 'wp_head', 'multiuso_remove_wp_widget_recent_comments_style', 1 );

		// clean up comment styles in the head
		add_action( 'wp_head', 'multiuso_remove_recent_comments_style', 1 );

		// clean up gallery output in wp
		add_filter( 'gallery_style', 'multiuso_gallery_style' );

		// adding sidebars to Wordpress
		add_action( 'widgets_init', 'multiuso_register_sidebars' );

		// cleaning up excerpt
		add_filter( 'excerpt_more', 'multiuso_excerpt_more' );

	} /* end start */
}
add_action( 'after_setup_theme', 'multiuso_start', 16 );

// Remove injected CSS for recent comments widget
if ( ! function_exists( 'multiuso_remove_wp_widget_recent_comments_style' ) ) {
	function multiuso_remove_wp_widget_recent_comments_style() {
		if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
			remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
		}
	}
}


// Remove injected CSS from recent comments widget
if ( ! function_exists( 'multiuso_remove_recent_comments_style' ) ) {
	function multiuso_remove_recent_comments_style() {
		global $wp_widget_factory;
		if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
			remove_action( 'wp_head',
				array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
	}
}


// Remove injected CSS from gallery
if ( ! function_exists( 'multiuso_gallery_style' ) ) {
	function multiuso_gallery_style( $css ) {
		return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
	}
}


// This removes the annoying […] to a Read More link
if ( ! function_exists( 'multiuso_excerpt_more' ) ) {
	function multiuso_excerpt_more( $more ) {
		global $post;

		// edit here if you like
		return '<a class="excerpt-read-more" href="' . esc_url( get_permalink( $post->ID ) ) . '" title="' . __( 'Read',
				'multiuso' ) . get_the_title( $post->ID ) . '">' . __( '... Read more &raquo;', 'multiuso' ) . '</a>';
	}
}


//  Stop WordPress from using the sticky class (which conflicts with Foundation), and style WordPress sticky posts using the .wp-sticky class instead
if ( ! function_exists( 'multiuso_remove_sticky_class' ) ) {
	function multiuso_remove_sticky_class( $classes ) {
		if ( in_array( 'sticky', $classes ) ) {
			$classes   = array_diff( $classes, array( "sticky" ) );
			$classes[] = 'wp-sticky';
		}

		return $classes;
	}
}

add_filter( 'post_class', 'multiuso_remove_sticky_class' );

//This is a modified the_author_posts_link() which just returns the link. This is necessary to allow usage of the usual l10n process with printf()
if ( ! function_exists( 'multiuso_get_the_author_posts_link' ) ) {
	function multiuso_get_the_author_posts_link() {
		global $authordata;
		if ( ! is_object( $authordata ) ) {
			return false;
		}
		$link = sprintf(
			'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
			get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
			/* translators: %s Post author name */
			esc_attr( sprintf( __( 'Posts by %s', 'multiuso' ), get_the_author() ) ),
			// No further l10n needed, core will take care of this one
			get_the_author()
		);

		return $link;
	}
}
