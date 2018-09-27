<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: http://jointswp.com/docs/responsive-navigation/
 */
?>

<div class="top-bar" id="main-menu">
	<div class="top-bar-left">
		<ul class="menu">
			<li class="site-logo-wrap">
                <a href="<?php echo esc_url(home_url()); ?>">
	                <?php
                        $site_custom_logo = wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false );
                        if(!empty($site_custom_logo)) {
	                        echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false,array( "class" => "site-logo" ) );
                        } else {
	                        echo '<h1>';
	                            bloginfo('name');
	                        echo '</h1>';
                        }
                    ?>
                </a>
            </li>
		</ul>
	</div>
	<div class="top-bar-right  main-nav-wrap">
		<?php multiuso_top_nav(); ?>
	</div>
</div>