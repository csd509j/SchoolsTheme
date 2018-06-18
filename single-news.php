<?php 
/**
 * The template for displaying news posts
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
			<div class="col-sm-12">
				<main id="main" class="site-main" role="main">
					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
			
						// Include the page content template.
						get_template_part( 'template-parts/content', 'news' );
						// End of the loop.
					endwhile;
					?>
			
				</main><!-- .site-main -->
				<?php get_template_part( 'template-parts/content', 'news-footer' ); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>