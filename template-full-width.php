<?php
/*
Template Name: Full Width (No Sidebar)
*/

get_header();
    //Get custom size feature image
    $page_id = get_queried_object_id();
    if ( has_post_thumbnail( $page_id ) ) :
	    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
	    $image = $image_array[0];
    else :
	    $image = '';
    endif;
?>
    <header class="header-archive-wrap bg-overlay"
        <?php if (!empty($image)): ?>
            style="background-image: url(<?php echo  esc_url($image); ?>);"
        <?php endif; ?>
    >
        <div class="header-archive">
            <h1 class="page-title"><?php the_title();?></h1>
        </div>
        <?php multiuso_breadcrumbs(); ?>
    </header>
	<div class="page-content">
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
