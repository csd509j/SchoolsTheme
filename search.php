<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

get_header(); 
global $wp_query;
$total_results = $wp_query->found_posts;
?>

<div id="primary" class="content-area padding-vertical-two">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="well">
					<h1 class="entry-title padding-bottom-quarter">Search</h1>
					<div class="padding-bottom-one" id="search-form">
						<form role="search" id="sites-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
							 <label class="sr-only" for="search-text">Search</label>
							 <input type="text" class="search-field input-lg" id="search-text" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s">
							 <button type="submit" class="btn btn-primary btn-lg">Search</button>
						</form>
					</div>	
				</div>
			</div>
		</div>
		<?php if ( have_posts() ) : ?>
	
		<header class="page-header">
			<h2 class="page-title"><?php printf( __( 'Results for %s', 'csd' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?> <small>Total Results: <?php echo $total_results; ?></small></h2>
		</header><!-- .page-header -->
		<div class="row">
			<div class="col-sm-12">
				<?php
				// Start the loop.
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
				the_posts_pagination( array(
					'mid_size'				=> 8,
					'prev_text'          => '<i class="fa fa-caret-left"></i>',
					'next_text'          => '<i class="fa fa-caret-right"></i>',
					'screen_reader_text' => ' ',
				) );
	
			// If no content, include the "No posts found" template.
			else :
				echo "No results returned.";
	
			endif;
			?>
			</div>
		</div>
	</div>
</div><!-- .content-area -->

<?php get_footer(); ?>
