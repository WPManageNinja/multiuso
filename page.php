<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */

get_header(); ?>
<?php
    //Get custom size feature image
    $page_id = get_queried_object_id();
    if ( has_post_thumbnail( $page_id ) ) :
        $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
        $image = $image_array[0];
    else :
        $image = '';//get_template_directory_uri() . '/assets/images/multiuso_site_header.jpg';
    endif;
?>
<div class="page-content">
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
    <div class="grid-container">
        <div class="inner-content grid-x grid-padding-x">

            <main class="main small-12 large-8 medium-sx-7 medium-6 cell" role="main">
                <div class="site-content-holder">
	                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		                <?php get_template_part( 'parts/loop', 'page' ); ?>
	                <?php endwhile; endif; ?>
                </div>
            </main> <!-- end #main -->
            <div id="sidebar1" class="small-12 medium-sx-5 medium-6 large-4 cell" role="complementary">
		        <?php get_sidebar(); ?>
            </div><!-- end #sidebar1 -->
        </div> <!-- end #inner-content -->
    </div>


</div> <!-- end #content -->

<?php get_footer(); ?>

