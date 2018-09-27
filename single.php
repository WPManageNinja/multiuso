<?php
/**
 * The template for displaying all single posts and attachments
 */

get_header(); ?>

<div class="single-content blog_single_content">
    <div class="grid-container">
        <div class="inner-content grid-x grid-padding-x">

            <main class="main small-12 medium-sx-7 medium-12 large-8 cell" role="main">

			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				    <?php get_template_part( 'parts/loop', 'single' ); ?>
			    <?php endwhile; else : ?>

				    <?php get_template_part( 'parts/content', 'missing' ); ?>
			    <?php endif; ?>

            </main> <!-- end #main -->

            <div id="sidebar1" class="small-12 medium-sx-5 medium-12 large-4 cell" role="complementary">
		        <?php get_sidebar(); ?>
            </div><!-- end #sidebar1 -->
        </div> <!-- end .inner-content -->
    </div>
</div> <!-- end #content -->

<?php get_footer(); ?>