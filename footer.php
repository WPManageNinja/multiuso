<?php
/**
 * The template for displaying the footer.
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>

<footer class="footer" role="contentinfo">
    <div class="inner-content grid-x  grid-container grid-padding-x">
        <div class="large-8 medium-sx-8 cell">
            <div class="inner-content grid-x grid-padding-x">
				<?php if ( is_active_sidebar( 'footerlink' ) ) : ?>
                    <div class="medium-3 cell">
						<?php dynamic_sidebar( 'footerlink' ); ?>
                    </div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footerlink_two' ) ) : ?>
                    <div class="medium-3 cell">
						<?php dynamic_sidebar( 'footerlink_two' ); ?>
                    </div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footerlink_three' ) ) : ?>
                    <div class="medium-6 cell">
						<?php dynamic_sidebar( 'footerlink_three' ); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
        <div class="large-4 medium-sx-4 cell">
            <div class="footer-info-meta-wrap">
				<?php if ( is_active_sidebar( 'footermeta' ) ) : ?>
                    <div class="medium-3 cell">
						<?php dynamic_sidebar( 'footermeta' ); ?>
                    </div>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'your_theme_logo' ) ) : ?>
                    <div class="footer-logo-wrap">
                        <a href="<?php echo esc_url( home_url() ); ?>"><img
                                    src="<?php echo esc_url( get_theme_mod( 'your_theme_logo' ) ); ?>"
                                    alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
    <div class="inner-footer grid-x grid-padding-x grid-container">
        <div class="footer-bottom-bar">
            <div class="small-12 medium-12 large-12 cell">
                <nav role="navigation">
					<?php multiuso_footer_links(); ?>
                </nav>
            </div>

            <div class="small-12 medium-12 large-12 cell">
                <p class="source-org copyright">
					<?php
					if ( get_theme_mod( 'front_footer_meta' ) ) {
						echo wp_kses_post( get_theme_mod( 'front_footer_meta' ) );
					} else {
						_e( "&copy; ", 'multiuso' );
						echo bloginfo( 'site_name' );
					}
					?>
                    <span> | Theme By <a target="_blank" href="https://wpmanageninja.com">WPManageNinja.com</a></span>
                </p>
            </div>
        </div>
    </div> <!-- end #inner-footer -->
</footer> <!-- end .footer -->
</div>  <!-- end .off-canvas-content -->

</div> <!-- end .off-canvas-wrapper -->

<?php wp_footer(); ?>

</body>

</html> <!-- end page -->