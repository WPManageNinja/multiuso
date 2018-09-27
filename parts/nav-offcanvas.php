<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */
?>

<div class="top-bar" id="top-bar-menu">
	<div class="top-bar-left">
		<ul class="menu">
            <li class="site-logo-wrap">
                <a href="<?php echo esc_url(home_url()); ?>">
					<?php
                        $site_custom_logo = wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false );
                        if(!empty($site_custom_logo)) {
                            echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false,array( "class" => "site-logo" ) );
                        }else {
                            echo '<h1>';
                                bloginfo('name');
                            echo '</h1>';
                        }
					?>
                </a>
            </li>
		</ul>
	</div>
	<div class="top-bar-right">
		<ul class="menu">
			<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
			<li>
                <a herf="0#" data-toggle="off-canvas" class="off-canvas-burger">
                    <div class="burger-check">
                        <div class="hamburger hamburger--spin js-hamburger">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
		</ul>
	</div>
</div>