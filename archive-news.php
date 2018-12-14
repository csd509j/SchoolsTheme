<?php
/**
 * The template for displaying news archive page
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

get_header(); ?>

<div id="primary" class="content-area py-2">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<div class="row">
				<div class="col-main col-sm-12">
						
						<?php
						if(!is_paged()):			
							get_template_part( 'template-parts/content', 'news-archive-header' ); 
						else:
							echo "<h2 class='padding-bottom-one'>School News</h2>";
						endif;
						
						if ( have_posts() ) : 
							// Start the Loop.
							while ( have_posts() ) : the_post(); 
				
								get_template_part( 'template-parts/content', 'news-archive' ); 			
				
							// End the loop.
							endwhile;
						?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
						<?php // Previous/next page navigation.
						// next_posts_link() usage with max_num_pages
						next_posts_link( '<span class="btn btn-primary">More News</span>', $the_query->max_num_pages );
					
						?>
				</div>
			</div>
							
			<?php endif; ?>

		</div>
	</main>
</div>
<?php get_footer(); ?>
