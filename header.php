<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section
 *
 */
?>

<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">
		
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">
		

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

	</head>
			
	<body <?php body_class(); ?>>

		<div class="off-canvas-wrapper">
			
			<!-- Load off-canvas container. Feel free to remove if not using. -->			
			<?php get_template_part( 'parts/content', 'offcanvas' ); ?>
			
			<div class="off-canvas-content" data-off-canvas-content>
                <header class="header" role="banner" style="background-image: url(<?php echo esc_url(header_image()); ?>)">

                    <div class="grid-container grid-padding-x">
                        <div class="cell">
	                        <?php if (get_theme_mod('multuiso_offcanvas')): ?>
		                        <?php get_template_part( 'parts/nav', 'offcanvas' ); ?>
	                        <?php else: ?>
		                        <?php get_template_part( 'parts/nav', 'offcanvas-only_mobile' ); ?>
	                        <?php endif; ?>
                            <!-- This navs will be applied to the topbar, above all content  To see additional nav styles, visit the /parts directory -->
                        </div>
                    </div>
                </header> <!-- end .header -->