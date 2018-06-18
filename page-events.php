<?php 
/**
 * Template Name: Events
 *
 * @package WordPress
 * @subpackage CSD
 * @since CSD 1.0
 */
 get_header();
?>

<div id="primary" class="content-area padding-bottom-two">
	<div class="container">
		<?php get_template_part('template-parts/content', 'breadcrumbs'); ?>
		<?php 
			// Start the loop.
			while ( have_posts() ) : the_post();
				
				the_content();
			
			// End of the loop.
			endwhile;
		?>	
	</div>		
</div>

<?php get_footer(); ?>