<?php 
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */
get_header(); ?>
<div id="primary" class="content-area py-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<?php get_sidebar(); ?>
				<div class="d-none d-lg-block">
					<?php get_template_part( 'template-parts/content', 'callouts' ); ?>
					<?php get_template_part( 'template-parts/content', 'contacts' ); ?>
				</div>
			</div>
			<div class="col-lg-9">
				<?php get_template_part('template-parts/content', 'breadcrumbs'); ?>
				<?php
				
				// Start the loop.
				while ( have_posts() ) : the_post();
		
					// Include the page content template.
					get_template_part( 'template-parts/content', 'page' );
		
					// End of the loop.
				endwhile;
				?>
			</div>
			<div class="d-block d-lg-none">
				<?php get_template_part( 'template-parts/content', 'callouts' ); ?>
				<?php get_template_part( 'template-parts/content', 'contacts' ); ?>
			</div>		
		</div>
	</div>
</div>
<?php get_footer(); ?>