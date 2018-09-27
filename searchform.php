<?php
/**
 * The template for displaying search form
 */
 ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'multiuso' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', '', 'multiuso' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', '', 'multiuso' ) ?>" />
	</label>
    <button type="submit" class="search-submit button" value="<?php echo esc_attr_x( 'Search', '', 'multiuso' ) ?>"><svg class="lnr lnr-magnifier"><use xlink:href="#lnr-magnifier"></use></svg></button>
</form>