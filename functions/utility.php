<?php

// ------------------- Breadcrumbs
if ( ! function_exists( 'multiuso_breadcrumbs' ) ) {
	function multiuso_breadcrumbs() {

		$showOnHome   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter    = esc_html__( '/', "multiuso" ); // delimiter between crumbs
		$home         = esc_html__( "Home", "multiuso" ); // text for the 'Home' link
		$showCurrent  = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before       = '<span class="current">'; // tag before the current crumb
		$after        = '</span>'; // tag after the current crumb
		$allowed_tags = array(
			'span' => array(
				'id'    => array(),
				'class' => array()
			),
			'a'    => array(
				'id'    => array(),
				'class' => array(),
				'href'  => array()
			),
		);

		global $post;
		$homeLink = esc_url( home_url() );

		if ( is_home() || is_front_page() ) {

			if ( $showOnHome == 1 ) {
				echo '<div id="crumbs" class="site-crumb"><a href="' . esc_url( $homeLink ) . '">' . esc_html( $home )
				     . '</a></div>';
			}

		} else {

			echo '<div id="crumbs" class="site-crumb"><a href="' . esc_url( $homeLink ) . '">' . esc_html( $home )
			     . '</a> '
			     . esc_html( $delimiter ) . ' ';

			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					echo wp_kses( get_category_parents( $thisCat->parent, true, ' ' . $delimiter . ' ' ),
						$allowed_tags );
				}
				echo wp_kses( $before, $allowed_tags ) . the_archive_title( '' ) . wp_kses( $after, $allowed_tags );

			} elseif ( is_search() ) {
				echo wp_kses( $before, $allowed_tags ) . esc_html__( 'Search results for "', 'multiuso' )
				     . get_search_query() . '"' . wp_kses( $after, $allowed_tags );

			} elseif ( is_day() ) {
				echo '<a href="' . esc_url( get_year_link( intval( get_the_time( 'Y' ) ) ) ) . '">'
				     . intval( get_the_time( 'Y' ) ) . '</a> ' . esc_html( $delimiter ) . ' ';
				echo '<a href="' . esc_url( get_month_link( intval( get_the_time( 'Y' ) ),
						intval( get_the_time( 'm' ) ) ),
						$allowed_tags ) . '">' . wp_kses_post( get_the_time( 'F' ) ) . '</a> ' . esc_html( $delimiter )
				     . ' ';
				echo wp_kses( $before, $allowed_tags ) . intval( get_the_time( 'd' ) ) . wp_kses( $after,
						$allowed_tags );

			} elseif ( is_month() ) {
				echo '<a href="' . esc_url( get_year_link( intval( get_the_time( 'Y' ) ) ) ) . '">'
				     . intval( get_the_time( 'Y' ) ) . '</a> ' . esc_html( $delimiter ) . ' ';
				echo wp_kses( $before, $allowed_tags ) . wp_kses_post( get_the_time( 'F' ) ) . wp_kses( $after,
						$allowed_tags );

			} elseif ( is_year() ) {
				echo wp_kses( $before, $allowed_tags ) . intval( get_the_time( 'Y' ) ) . wp_kses( $after,
						$allowed_tags );

			} elseif ( is_single() && ! is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object( get_post_type() );
					$slug      = $post_type->rewrite;
					echo '<a href="' . esc_url( $homeLink ) . '/' . esc_url( $slug['slug'] ) . '/">'
					     . esc_html( $post_type->labels->singular_name ) . '</a>';
					if ( $showCurrent == 1 ) {
						echo ' ' . esc_html( $delimiter ) . ' ' . wp_kses( $before, $allowed_tags ) . get_the_title()
						     . wp_kses( $after, $allowed_tags );
					}
				} else {
					$cat  = get_the_category();
					$cat  = $cat[0];
					$cats = get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
					if ( $showCurrent == 0 ) {
						$cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats );
					}
					echo esc_html( $cats );
					if ( $showCurrent == 1 ) {
						echo wp_kses( $before, $allowed_tags ) . get_the_title() . wp_kses( $after, $allowed_tags );
					}
				}

			} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
				if ( get_post_type() ) {
					$post_type = get_post_type_object( get_post_type() );
					echo wp_kses( $before, $allowed_tags ) . esc_html( $post_type->labels->singular_name )
					     . wp_kses( $after, $allowed_tags );
				}
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat    = get_the_category( $parent->ID );
				$cat    = $cat[0];
				echo esc_html( get_category_parents( $cat, true, ' ' . $delimiter . ' ' ) );
				echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( $parent->post_title )
				     . '</a>';
				if ( $showCurrent == 1 ) {
					echo ' ' . wp_kses_post( $delimiter ) . ' ' . wp_kses( $before, $allowed_tags ) . get_the_title()
					     . wp_kses( $after, $allowed_tags );
				}

			} elseif ( is_page() && ! $post->post_parent ) {
				if ( $showCurrent == 1 ) {
					echo wp_kses( $before, $allowed_tags ) . get_the_title() . wp_kses( $after, $allowed_tags );
				}

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page          = get_page( $parent_id );
					$breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">'
					                 . get_the_title( $page->ID )
					                 . '</a>';
					$parent_id     = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
					echo wp_kses_post( $breadcrumbs[ $i ] );
					if ( $i != count( $breadcrumbs ) - 1 ) {
						echo ' ' . wp_kses_post( $delimiter ) . ' ';
					}
				}
				if ( $showCurrent == 1 ) {
					echo ' ' . wp_kses_post( $delimiter ) . ' ' . wp_kses( $before, $allowed_tags ) . get_the_title()
					     . wp_kses( $after, $allowed_tags );
				}

			} elseif ( is_tag() ) {
				echo wp_kses( $before, $allowed_tags ) . the_archive_title( '' ) . wp_kses( $after, $allowed_tags );

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo wp_kses( $before, $allowed_tags ) . esc_html__( 'Articles written by ', 'multiuso' )
				     . esc_html( $userdata->display_name ) . wp_kses( $after, $allowed_tags );

			} elseif ( is_404() ) {
				echo wp_kses( $before, $allowed_tags ) . esc_html__( 'Error 404', 'multiuso' ) . wp_kses( $after,
						$allowed_tags );
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' (';
				}
				echo esc_html__( ' /', 'multiuso' ) . ' ' . intval( get_query_var( 'paged' ) );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ')';
				}
			}

			echo '</div>';

		}
	} // end sb_custom_breadcrumbs()
}

/* Limiting Excerpt */
if ( ! function_exists( 'multiuso_limit_excerpt' ) ) {
	function multiuso_limit_excerpt( $limit ) {
		$excerpt = explode( ' ', get_the_excerpt(), $limit );

		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( " ", $excerpt ) . '...';
		} else {
			$excerpt = implode( " ", $excerpt );
		}

		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

		return $excerpt;
	}
}


/* Modify archive widget */
if ( ! function_exists( 'multiuso_archive_count_span' ) ) {
	function multiuso_archive_count_span( $links ) {
		$links = str_replace( '</a>&nbsp;(', ' <span class="set-right">(', $links );
		$links = str_replace( ')', ')</span></a>', $links );

		return $links;
	}
}

add_filter( 'get_archives_link', 'multiuso_archive_count_span' );

/* Modify category widget */
if ( ! function_exists( 'multiuso_category_count_span' ) ) {
	function multiuso_category_count_span( $links ) {
		$links = str_replace( '</a> (', ' <span>(', $links );
		$links = str_replace( ')', ')</span></a>', $links );

		return $links;
	}
}

add_filter( 'wp_list_categories', 'multiuso_category_count_span' );

if ( ! function_exists( 'multiuso_get_all_image_sizes' ) ) {
	function multiuso_get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$default_image_sizes = get_intermediate_image_sizes();

		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ]['width']  = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ]['height'] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ]['crop']   = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}

		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return $image_sizes;
	}
}

/*Fix Widget: Tag cloud */
if ( ! function_exists( 'multiuso_custom_tag_cloud_widget' ) ) {
	function multiuso_custom_tag_cloud_widget( $args ) {
		$args['largest']  = '100'; //largest tag
		$args['smallest'] = '100'; //smallest tag
		$args['unit']     = '%'; //tag font unit
		$args['format']   = 'flat';

		return $args;
	}
}

add_filter( 'widget_tag_cloud_args', 'multiuso_custom_tag_cloud_widget' );

/*Fix widget: search*/
// Add to your init function
add_filter( 'get_search_form', 'multiuso_my_search_form' );

if ( ! function_exists( 'multiuso_my_search_form' ) ) {
	function multiuso_my_search_form( $text ) {
		$text = str_replace( 'value="Search"', 'value=""', $text );

		return $text;
	}
}

if ( ! function_exists( 'multiuso_customizer_style' ) ) {
	function multiuso_customizer_style() {

		$parimary_color   = get_theme_mod( 'parimary_color' );
		$header_textcolor = esc_attr( get_theme_mod( 'header_textcolor' ) );
		$header_color     = esc_attr( get_theme_mod( 'header_color' ) );
		$secondary_color  = esc_attr( get_theme_mod( 'secondary_color' ) );
		$link_color       = esc_attr( get_theme_mod( 'link_color' ) );
		$link_hover_color = esc_attr( get_theme_mod( 'link_hover_color' ) );
		$custom_css
		                  = "
        .dropdown.menu a,
        .menu .button, .menu a {
            color: " . esc_attr( $header_textcolor ) . ";
        }
        .header {
            background-color: " . esc_attr( $header_color ) . ";
        }

		#today a, tr #prev a,
		.hamburger-inner, .hamburger-inner:after, .hamburger-inner:before,
		.hamburger,
		.toppage-carousel .owl-nav .owl-next, 
		.toppage-carousel .owl-nav .owl-prev {
			color: " . esc_attr( $parimary_color ) . ";
		}
		.form-submit .submit,
		.more-link,
		.pagination .current,
		.hamburger-inner,
		.hamburger-inner:after,
		.hamburger-inner:before,
		.header-archive-wrap,
		.cat-carousel .item-content-holder,
		.toppage-carousel-wrap,
        .menu .active>a, .menu .is-active>a,
		.sidebar .widget_search .search-submit {
			background-color: " . esc_attr( $parimary_color ) . " ;
		}

		.hamburger,
		.sidebar .widget_search .search-submit,
		.sidebar .widget_tag_cloud .tag-cloud-link {
			border-color: " . esc_attr( $parimary_color ) . ";
		}
        .cat-carousel .item,
        .post,
        .sidebar .widget {
            background-color: " . esc_attr( $secondary_color ) . " ;
        }
        .toppage-carousel-wrap {
            border-color: " . esc_attr( $secondary_color ) . " ;
        }
		a,
	    body .menu .active>a,
		body .menu .is-active>a,
		.top-bar-right .menu .active>a,
		.top-bar-right  .menu .is-active>a,
		.lnr-layers,
		#next a, #today a, tr #prev a,
		.pagination .next, 
		.pagination .prev, 
		.pagination>li {
			color: " . esc_attr( $link_color ) . " ;
		}
		a:hover,
		.menu .active>a:hover,
		.menu .is-active>a:hover,.lnr-layers a:hover,td#next a:hover, td#today a:hover, tr td#prev a:hover {
			color: " . esc_attr( $link_hover_color ) . " ;
		}";
		$custom_css       = esc_attr( $custom_css );
		wp_add_inline_style( 'multiuso-main-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'multiuso_customizer_style', 99999 );

if ( ! function_exists( 'multiuso_post_carousel' ) ) {
	function multiuso_post_carousel() {
		if ( get_theme_mod( 'multiuso_taxonomy_dropdown_setting' )
		     && get_theme_mod( 'multiuso_taxonomy_dropdown_setting' ) != '-1'
		) : ?>


			<?php
			$rd_args  = array(
				'cat'                 => get_theme_mod( 'multiuso_taxonomy_dropdown_setting' ),
				'posts_per_page'      => get_theme_mod( 'multiuso_header_carousel_number_of_post' ),
				'ignore_sticky_posts' => true
			);
			$rd_query = new WP_Query( $rd_args );
			?>

			<?php wp_enqueue_script( 'owlcarousel' ); ?>
            <div class="top-page-holder">
                <div class="inner-content">
                    <div class="cell">
                        <div class="toppage-carousel-wrap">
                            <div class="owl-carousel owl-theme toppage-carousel ">
								<?php while ( $rd_query->have_posts() ) : $rd_query->the_post(); ?>
                                    <div class="item"
                                         data-image="<?php echo esc_attr( get_the_post_thumbnail_url( get_the_ID(),
										     'full' ) ); ?>">
                                        <div class="slider-post" id="post-<?php the_ID(); ?>">
											<?php the_date(); ?>
                                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                            <div class="num"></div>
                                        </div>
                                    </div>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); // reset the query ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif;
	}
}

if ( ! function_exists( 'multiouso_category_carousel' ) ) {
	function multiouso_category_carousel() {
		if ( get_theme_mod( 'multiuso_taxanomy_carousel_checkbox' ) ) : ?>
			<?php wp_enqueue_script( 'owlcarousel' ); ?>
            <div class="inner-content grid-x category_carousel_wrap grid-padding-x grid-container grid-x blog-page-wrap">
                <div class="owl-carousel owl-theme cat-carousel cell ">
					<?php
					$taxonomy = 'category';

					$terms = $terms = get_terms( array(
						'taxonomy'   => $taxonomy,
						'hide_empty' => true,
					) );
					if ( ! empty( $terms ) ) {
						//print_r($terms);
						foreach ( $terms as $term ) {
							echo '<div class="item">';
							get_term_meta( $term->term_id, '_term_image', true );
							//var_dump(get_term_meta( $term->term_id, 'category-image-id', true ));
							$imageArr = wp_get_attachment_image_src( get_term_meta( $term->term_id, 'category-image-id',
								true ), 'medium' );
							$imageURL = $imageArr[0];
							echo '<div class="item-content-holder bg-overlay" style="background-image: url('
							     . esc_url( $imageURL ) . ');">';
							$url = esc_url( get_term_link( $term->slug, 'category' ) );

							echo '<a href="' . esc_url( $url ) . '">' . esc_html( $term->name ) . '</a>';
							echo '</div></div>';
						}
					}
					?>
                </div>
            </div>
		<?php endif;
	}
}

add_action( 'multiuso_before_home_content', 'multiuso_post_carousel' );
add_action( 'multiuso_before_home_content', 'multiouso_category_carousel' );