<?php
/**
 * The template part for displaying a message that posts cannot be found
 */
?>

<div class="post-not-found">
	
	<?php if ( is_search() ) : ?>
		
		<header class="article-header">
			<h1><?php esc_html_e( 'Sorry, No Results.', 'multiuso' );?></h1>
		</header>
		
		<section class="entry-content">
			<p><?php esc_html_e( 'Try your search again.', 'multiuso' );?></p>
		</section>
		
		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->
		
		<footer class="article-footer">
			<p><?php esc_html_e( 'This is the error message in the parts/content-missing.php template.', 'multiuso' ); ?></p>
		</footer>
		
	<?php else: ?>
	
		<header class="article-header">
			<h1><?php esc_html_e( 'Oops, Post Not Found!', 'multiuso' ); ?></h1>
		</header>
		
		<section class="entry-content">
			<p><?php esc_html_e( 'Uh Oh. Something is missing. Try double checking things.', 'multiuso' ); ?></p>
		</section>
		
		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->
		
		<footer class="article-footer">
		  <p><?php esc_html_e( 'This is the error message in the parts/content-missing.php template.', 'multiuso' ); ?></p>
		</footer>
			
	<?php endif; ?>
	
</div>
