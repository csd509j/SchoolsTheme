<?php
/**
 * Template Name: Default Template - Full Width
 *
 * @package WordPress
 * @subpackage CSD
 * @since CSD Schools 3.6.9
 */

get_header(); 
$pages = get_full_width_children_pages($post);
?>

<div id="primary" class="content-area">
	<div id="full-width-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xl-9 py-3 align-self-center">
					<h1 class="mb-0 text-white"><?php the_field('title'); ?></h1>
					
					<?php if ( get_field('sub_title') ): ?>
					
						<p class="lead mt-1 mb-0 text-white"><?php the_field('sub_title'); ?></p>
					
					<?php endif; ?>
				
				</div>
			</div>
		</div>
	</div>
	
	<?php if ( $pages ): ?>
	
		<div id="full-width-nav" class="py-1 d-none d-xl-block">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<ul class="list-inline m-0">
							<li <?php echo ( is_page($pages['parent'] ) ? 'class="current_page_item"' : '' ); ?>><a href="<?php the_permalink($pages['parent']); ?>"><?php echo get_the_title($pages['parent']); ?></a></li>
						
							<?php echo $pages['children']; ?>
						
						</ul>
					</div>
				</div>
			</div>
		</div>
	
	<?php endif; ?>
	
	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the page content template.
		get_template_part( 'template-parts/content', 'page-full' );

		// End of the loop.
	endwhile;
	?>
</div>

<?php get_footer(); ?>