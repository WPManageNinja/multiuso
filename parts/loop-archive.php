<?php
/**
 * Template part for displaying posts
 *
 * Used for single, index, archive, search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">					

    <?php
        if (has_post_thumbnail()) {
            $thumbnail_status = 'thumb_exist';
        }else {
	        $thumbnail_status = 'thumb_notexist';
        }
    ?>
	<header class="article-header <?php echo sanitize_html_class($thumbnail_status); ?>">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a>
	</header> <!-- end article header -->
					
	<section class="entry-content <?php echo sanitize_html_class($thumbnail_status); ?>" itemprop="articleBody">
        <h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'parts/content', 'byline' ); ?>
        <div class="post-excerpt">
	        <?php echo multiuso_limit_excerpt('39');  ?>
	        <?php wp_link_pages(); ?>
        </div>

		<div class="post-btn-wrap">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="more-link"><span class="more-button"><?php esc_html_e( 'READ MORE', 'multiuso' ); ?> <span class="more-line"><svg class="lnr lnr-arrow-right"><use xlink:href="#lnr-arrow-right"></use></svg></span></span> </a>
			<?php
                global $post;
                $category_detail = get_the_category( $post->ID );
                //Returns All Term Items for "my_term"
                $term_list = wp_get_post_terms($post->ID, 'post_tag', array("fields" => "all"));
			?>
            <div class="taxonomy-links">
                <?php if (has_category()): ?>
                    <svg class="lnr lnr-layers icon"><use xlink:href="#lnr-layers"></use></svg> <?php the_category( ', '); ?>
                <?php endif; ?>
            </div>
        </div>
	</section> <!-- end article section -->
			
</article> <!-- end article --> 