<?php 
/**
 * The sidebar containing the main widget area
 */
 ?>


<div class="sidebar">
	<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar1' ); ?>

	<?php else : ?>

        <!-- This content shows up if there are no widgets defined in the backend. -->

        <div class="alert help">
            <p><?php esc_html_e( 'Please activate some Widgets.', 'multiuso' );  ?></p>
        </div>
	<?php endif; ?>
</div>
