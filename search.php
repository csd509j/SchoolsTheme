<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

get_header(); 

?>

<div id="primary" class="content-area py-2">
	<div class="container">
		<div class="row justify-content-center mb-2">
			<div class="col-12">
				<h2 class="mb-1">Search</h2>
				<div class="bg-gray p-1">
					<div id="search-form">
						<form role="search" id="sites-search" class="row no-gutters" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
							<div class="form-group col-md-9 col-lg-10 mb-1 mb-md-0">
								<label class="sr-only" for="search-text">Search</label>
								<input type="text" class="form-control-lg w-100" id="search-text" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s">
							</div>
							<div class="col-md-3 col-lg-2 d-flex align-items-stretch">
								<button type="submit" class="btn btn-primary btn-block">Search</button>
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-9">
				<?php 

				if ( have_posts() ) :
			
					while ( have_posts() ) : the_post();
		
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );
		
					// End the loop.
					endwhile;
		
					// Previous/next page navigation.
					show_pagination_links( );
	
		
				// If no content, include the "No posts found" template.
				else :
					echo "No results returned.";
		
				endif;
			?>
			</div>
			<div class="col-md-3">
				<div class="bg-gray p-1 mt-2 mt-md-0 text-center">
					<h3><?php the_field('search_sidebar_title', 'options'); ?></h3>
					<p class="small mb-1"><?php the_field('search_sidebar_text', 'options'); ?></p>
					<a class="btn btn-primary btn-sm btn-block" href="<?php echo home_url(); ?>/contact">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</div><!-- .content-area -->

<?php get_footer(); ?>
