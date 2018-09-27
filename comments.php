<?php
/**
 * Displays current comments and comment form. Works with includes/comments.php.
 *
 * For more info: https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/comments/
 */

if ( post_password_required() ) {
	return; 
}
?>

<div id="comments" class="<?php if ( have_comments() || is_singular()){ echo 'comments-area';} ?>">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php esc_html_e("-COMMENTS-","multiuso"); ?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'multiuso' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'multiuso' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'multiuso' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=multiuso_comments'); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'multiuso' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'multiuso' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'multiuso' ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'multiuso' ); ?></p>
	<?php endif; ?>
    <?php
	    $comments_args = array(
		    // change the title of send button
		    'label_submit'=>__('Submit','multiuso'),
		    // change the title of the reply section
		    'title_reply'=>__('-LEAVE A REPLY-','multiuso'),
		    // remove "Text or HTML to be displayed after the set of comment fields"
		    'comment_form_top' => 'ds',
		    'comment_notes_before' => '',
		    'comment_notes_after' => '',
		    // redefine your own textarea (the comment body) <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>
		    'comment_field' => '<p class="comment-form-comment"><label for="comment">'.__( 'Comment <span>*</span>', 'multiuso' ).'<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="' . __( 'Your Comment* ', 'multiuso'  ) . '  " aria-required="true"></textarea></p>',
		    'fields' => apply_filters( 'comment_form_default_fields', array(

				    'author' =>
					    '<div class="grid-x grid-margin-x"><p class="comment-form-author medium-6 cell">'  .'<label for="author">' . __( 'Name <span>*</span>', 'multiuso'  ) . '</label> ' .
					    '<input id="author" class="blog-form-input" placeholder="' . __( 'Your Name*', 'multiuso'  ) . ' " name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					    '" size="30" /></p>',

				    'email' =>
					    '<p class="comment-form-email medium-6 cell">'.'<label for="email">' . __( 'Email <span>*</span>', 'multiuso'   ) . '</label> ' .
					    '<input id="email" class="blog-form-input" placeholder="' . __( 'Your Email Address* ', 'multiuso'  ) . ' " name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					    '" size="30" /></p></div>',

			    )
		    ),
	    );

	    comment_form($comments_args);
    ?>
</div><!-- #comments -->