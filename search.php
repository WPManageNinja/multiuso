<?php 
/**
 * The template for displaying search results pages
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */
 	
get_header(); ?>
			
	<div class="content">

		<div class="inner-content grid-x grid-container grid-padding-x">
	
			<main class="main small-12 medium-sx-7 medium-12 large-8 cell" role="main">
                <div class="site-content-holder">
                    <header>
                        <h1 class="archive-title"><?php esc_html_e( 'Search Results for:', 'multiuso' ); ?> <?php echo esc_attr(get_search_query()); ?></h1>
                    </header>

	                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <!-- To see additional archive styles, visit the /parts directory -->
		                <?php get_template_part( 'parts/loop', 'archive' ); ?>

	                <?php endwhile; ?>

		                <?php multiuso_page_navi(); ?>

	                <?php else : ?>

		                <?php get_template_part( 'parts/content', 'missing' ); ?>

	                <?php endif; ?>
                </div>
		    </main> <!-- end #main -->
            <div id="sidebar1" class="small-12 medium-sx-5 medium-12 large-4 cell" role="complementary">
				<?php get_sidebar(); ?>
            </div><!-- end #sidebar1 -->
		
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
