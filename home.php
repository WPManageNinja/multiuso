<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header();
?>
    <div class="content">
		<?php if ( is_home() && ! is_paged() ) {
			do_action( 'multiuso_before_home_content' );
		} ?>
        <div class="inner-content grid-x grid-padding-x grid-container grid-x blog-page-wrap">
            <main class="main small-12 medium-sx-7 medium-12 large-8 cell" role="main">


				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <!-- To see additional archive styles, visit the /parts directory -->
                    <div class="grid-post-parallel">

						<?php get_template_part( 'parts/loop', 'archive' ); ?>
                    </div>

				<?php endwhile; ?>

					<?php multiuso_page_navi(); ?>
				<?php else : ?>

					<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>

            </main> <!-- end #main -->

            <div id="sidebar1" class="small-12 medium-sx-5 medium-12 large-4 cell" role="complementary">
				<?php get_sidebar(); ?>
            </div><!-- end #sidebar1 -->
        </div>
    </div> <!-- end #content -->

<?php get_footer(); ?>