<?php
/**
 * The template part for displaying an author byline
 */
?>

<p class="byline">
    <span class="byline-admin byline-item"><span class="fs_italic"><?php esc_html_e('by', 'multiuso'); ?></span> <?php the_author_posts_link(); ?></span>
    <span class="byline-comment byline-item">
        <span class="comment_meta">
            <i class="lnr lnr-bubble" aria-hidden="true"></i>
            <?php
                comments_popup_link(
	                __( 'No Comments','multiuso' ), // No comments exist, you would probably want to display a link here in order for people to add the first comment
	                __( '1 Comment', 'multiuso' ), // 1 comment, usually phrased differently
	                __( '% Comment', 'multiuso' ) // > 1 comment
                );
            ?>
        </span>
    </span>
    <span class="byline-time byline-item"><i class="lnr lnr-calendar-full" aria-hidden="true"></i> <?php the_date(); ?></span>
</p>



