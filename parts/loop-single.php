<?php
/**
 * Template part for displaying a single post
 */
?>

<article id="post-<?php the_ID(); ?>"  role="article" itemscope itemtype="http://schema.org/BlogPosting">
    <div <?php post_class(''); ?>>
        <header class="article-header">
	        <?php the_post_thumbnail('full'); ?>
            <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
		    <?php get_template_part( 'parts/content', 'byline' ); ?>
        </header> <!-- end article header -->

        <section class="entry-content" itemprop="articleBody">

		    <?php the_content(); ?>
		    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'multiuso' ), 'after'  => '</div>' ) ); ?>
        </section> <!-- end article section -->

        <footer class="article-footer">

            <div class="taxonomy-links">
	            <?php if (has_category()): ?>
                    <svg class="lnr lnr-layers icon"><use xlink:href="#lnr-layers"></use></svg> <?php the_category( ', '); ?>
	            <?php endif; ?>
                <span class="tags"><?php the_tags('<span class="tags-title">' . '<svg class="lnr lnr-tag icon"><use xlink:href="#lnr-tag"></use></svg> '. '</span> ', ', ', ''); ?></span>
            </div>
        </footer> <!-- end article footer -->
    </div>


	<?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    ?>
													
</article> <!-- end article -->
