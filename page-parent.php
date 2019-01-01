<?php
/**
 * Template Name: Parent
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

get_header();
$image = get_field('banner_image');
$bg_sm_image = wp_get_attachment_image_src($image['id'], 'News Image Large', false);
$bg_lg_image = wp_get_attachment_image_src($image['id'], 'Parent Header', false);

?>
<div class="inner-page-banner mb-2 clearfix">
	<div class="content-top">
		<div class="content d-block d-md-none" style="background-image:url(<?php echo $bg_sm_image[0]; ?>)"></div>
		<div class="content d-none d-md-block" style="background-image:url(<?php echo $bg_lg_image[0]; ?>)"></div>
	</div>
	<div class="inner-page-banner-overlay d-none d-md-none d-lg-block"></div>
</div>
<div id="primary" class="pb-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<?php get_sidebar("parent"); ?>
				<div class="d-none d-lg-block">
					<?php get_template_part( 'template-parts/content', 'callouts' ); ?>
					<?php get_template_part( 'template-parts/content', 'calendar' ); ?>
					<?php get_template_part( 'template-parts/content', 'contacts' ); ?>
				</div>
			</div>
			<div class="col-lg-9 entry-content">
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
			<div class="col-12 d-block d-lg-none">
				<?php get_template_part( 'template-parts/content', 'callouts' ); ?>
				<?php get_template_part( 'template-parts/content', 'calendar' ); ?>
				<?php get_template_part( 'template-parts/content', 'contacts' ); ?>
			</div>		
		</div>
	</div>
</div>
<?php get_footer(); ?>