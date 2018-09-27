<?php
/*
Thanks to the awesome work by JointsWP users, there
are many languages you can use to translate your theme.
*/

// Adding Translation Option
if ( ! function_exists( 'multiuso_load_translations' ) ) {
	function multiuso_load_translations() {
		load_theme_textdomain( 'multiuso', get_template_directory() . '/assets/translation' );
	}
}
add_action( 'after_setup_theme', 'multiuso_load_translations' );