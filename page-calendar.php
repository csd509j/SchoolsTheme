<?php 
/**
 * Template Name: Calendar
 *
 * @package WordPress
 * @subpackage CSD
 * @since CSD 1.1
 */
 get_header();
?>
<div id="primary" class="content-area">
	
	<div class="bg-primary py-3">
	
		<div class="container">
	
			<div class="row">
	
				<div class="col-12">
	
					<h1 class="mb-0 text-white"><?php the_field('calendar_title', 'options'); ?></h1>
	
				</div>
	
			</div>
	
		</div>
	
	</div>
	
	<div class="bg-gray py-2">
	
		<div class="container">
	
			<div class="row">
	
				<div class="col-12">
	
					<p class="lead"><?php the_field('calendar_text', 'options'); ?></p>
	
				</div>
	
			</div>
	
		</div>
	
	</div>
	
	<div class="py-3">
	
		<div class="container">
	
			<?php render_calendar(); ?>
	
		</div>
	
	</div>

</div>

<?php get_footer(); ?>