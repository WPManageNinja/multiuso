<?php
/*
Template Name: Full Width (No Banner)
*/

get_header();
?>
	<div class="page-content space-top-50">
	    <div class="grid-container">
            <div class="inner-content grid-x grid-margin-x grid-padding-x">

                <main class="main small-12 cell" role="main">

				    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <?php get_template_part( 'parts/loop', 'page-fullwidth' ); ?>

				    <?php endwhile; endif; ?>

                </main> <!-- end #main -->

            </div> <!-- end #inner-content -->
        </div>
	</div> <!-- end #content -->

<?php get_footer(); ?>
