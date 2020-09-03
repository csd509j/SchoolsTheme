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
	
		<div id="full-width-nav" class="py-lg-1">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav class="navbar navbar-expand-lg navbar-light justify-content-center">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#subpage-nav-mobile" aria-controls="subpage-nav-mobile" aria-expanded="false" aria-label="Toggle navigation">
								<i class="fas fa-chevron-down"></i> Menu
							</button>
							<div class="collapse navbar-collapse d-none d-lg-block" id="subpage-nav">
								<ul class="navbar-nav m-0">
									<li <?php echo ( is_page($pages['parent'] ) ? 'class="nav-item active current_page_item"' : 'nav-item'); ?>><a href="<?php the_permalink($pages['parent']); ?>"><?php echo get_the_title($pages['parent']); ?></a></li>
									<?php echo $pages['children']; ?>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div class="collapse navbar-collapse bg-white py-1 d-lg-none" id="subpage-nav-mobile">
				<ul class="navbar-nav m-0">
					<li <?php echo ( is_page($pages['parent'] ) ? 'class="nav-item active current_page_item"' : 'class="nav-item"'); ?>><a href="<?php the_permalink($pages['parent']); ?>"><?php echo get_the_title($pages['parent']); ?></a></li>
					<?php echo $pages['children']; ?>
				</ul>
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