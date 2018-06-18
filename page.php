<?php 
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */
get_header(); ?>

<div id="primary" class="content-area padding-bottom-two">
	<div class="container">
		<?php get_template_part('template-parts/content', 'breadcrumbs'); ?>
		<div class="row">
			<div class="col-sm-3 col-xs-12">
				<?php get_sidebar(); ?>
			</div>
			<div class="col-main col-sm-9 col-xs-12 pull-right">
				<main id="main" class="site-main" role="main">
					<?php
					
					// Start the loop.
					while ( have_posts() ) : the_post();
			
						// Include the page content template.
						get_template_part( 'template-parts/content', 'page' );
			
						// End of the loop.
					endwhile;
					?>
			
				</main><!-- .site-main -->
			</div>
			<div class="col-sm-3 col-xs-12 pull-left">
				<?php get_template_part( 'template-parts/content', 'callouts' ); ?>
				<?php //get_template_part( 'template-parts/content', 'calendar' ); ?>
				<?php get_template_part( 'template-parts/content', 'contacts' ); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>