<?php
/**
 * Displays archive pages if a speicifc template is not set.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header(); ?>

	<div class="archive-content">
		<?php
		    $header_bg = '';
            $tax = $wp_query->get_queried_object();
            if (!empty($tax)) {
	            $meta_id = get_term_meta( $tax->term_id, 'category-image-id', true );
	            $imageArr = wp_get_attachment_image_src( $meta_id , 'full' );
	            if (!empty($imageArr['0'])) {
		            $header_bg = $imageArr[0];
	            } else {
		            $header_bg = get_template_directory_uri().'/assets/images/multiuso_site_header.jpg';
	            }
            }
            //var_dump($imageArr);
		?>
        <header class="header-archive-wrap bg-overlay"
                <?php if (!empty($header_bg)): ?>
                style="background-image: url(<?php echo  esc_url($header_bg); ?>);"
                <?php endif; ?>
        >
            <div class="header-archive">
                <h1 class="page-title"><?php the_archive_title();?></h1>
				<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
            </div>
			<?php multiuso_breadcrumbs(); ?>
        </header>
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="cell">

                </div>
            </div>
        </div>


		<div class="inner-content grid-container ">
            <div class="grid-x grid-padding-x">
                <main class="main small-12 medium-sx-7 medium-12 large-8 cell" role="main">



		            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
	    </div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>