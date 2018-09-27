<?php

if ( ! function_exists( 'multiuso_page_navi' ) ) {
	function multiuso_page_navi() {
		global $wp_query;
		$big = 999999999; // This needs to be an unlikely integer
		// For more options and info view the docs for the_posts_pagination()
		// http://codex.wordpress.org/Function_Reference/the_posts_pagination
		$next_icon = ' <svg class="lnr lnr-arrow-right"><use xlink:href="#lnr-arrow-right"></use></svg>';
		$prev_icon = '<svg class="lnr lnr-arrow-left"><use xlink:href="#lnr-arrow-left"></use></svg> ';

		$paginate_links = the_posts_pagination( array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'mid_size'  => 5,
			'prev_next' => true,
			'prev_text' => $prev_icon . esc_html__( 'Prev', 'multiuso' ),
			'next_text' => esc_html__( 'Next', 'multiuso' ) . $next_icon,
			'type'      => 'list',
		) );
		$paginate_links = str_replace( "<ul class='page-numbers'>",
			"<ul class='pagination text-center' role='navigation' aria-label='Pagination'>", $paginate_links );
		$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
		$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'>",
			$paginate_links );
		$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
		$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>",
			"<li><span class='dots'>&hellip;</span></li>", $paginate_links );
		$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
		// Display the pagination if more than one page is found.

		$allowed_tags = array(
			'ul'  => array(
				'id'    => array(),
				'class' => array()
			),
			'li'  => array(
				'id'    => array(),
				'class' => array()
			),
			'a'   => array(
				'class' => array(),
				'href'  => array(),
			),
			'svg' => array(
				'class' => array()
			),
			'use' => array(
				'xlink:href' => array()
			)
		);
		if ( $paginate_links ) {
			echo '<div class="page-navigation">';
			echo wp_kses( $paginate_links, $allowed_tags );
			echo '</div><!--// end .pagination -->';
		}
	}
}






