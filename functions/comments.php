<?php
// Comment Layout
if ( ! function_exists( 'multiuso_comments' ) ) {
	function multiuso_comments( $comment, $args, $depth ) {
		?>
    <li <?php comment_class( 'panel' ); ?>>
        <div class="media-object">
            <div class="media-object-section media-object-section-author">
				<?php echo get_avatar( $comment, 75 ); ?>
            </div>
            <div class="media-object-section media-object-section-content">
                <article id="comment-<?php comment_ID(); ?>">
                    <header class="comment-author">
						<?php
						// create variable
						$bgauthemail = get_comment_author_email();
						$comment     = get_comment( $comment->comment_ID );

						$post_args = array(
							'author' => $comment->user_id,
						);

						$wp_posts = get_posts( $post_args );

						if ( count( $wp_posts ) ) {
							$author_url = get_author_posts_url( $comment->user_id );
						} else {
							$author_url = '#0';
						}
						?>
                        <a href="<?php echo esc_url( $author_url ); ?>"><strong><?php echo get_comment_author_link( $comment->comment_ID ); ?></strong></a> <?php esc_html_e( "on",
							"multiuso" ); ?>
                        <time datetime="<?php echo comment_time( 'Y-m-j' ); ?>"><a
                                    href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php comment_time( __( 'j-m-Y',
									'multiuso' ) ); ?> </a></time>
						<?php edit_comment_link( __( '(Edit)', 'multiuso' ), '  ', '' ) ?>
						<?php comment_reply_link( array_merge( $args,
							array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
                    </header>
					<?php if ( $comment->comment_approved == '0' ) : ?>
                        <div class="alert alert-info">
                            <p><?php esc_html_e( 'Your comment is awaiting moderation.', 'multiuso' ) ?></p>
                        </div>
					<?php endif; ?>
                    <section class="comment_content clearfix">
						<?php comment_text() ?>
                    </section>

                </article>
            </div>
        </div>
        <!-- </li> is added by WordPress automatically -->
		<?php
	}
}

