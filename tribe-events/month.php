<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$site_name = get_bloginfo('name');
?>
<div class="row">
	<div class="col-sm-7">
		<h1><?php the_field('calendar_title', 'option'); ?></h1>
		<?php the_field('calendar_text', 'option'); ?>
	</div>
	<div class="col-sm-5">
		<div class="well">
			<h4><i class="fa fa-download"></i> Calendars</h4>
			<ul class="list list-unstyled margin-none">
				<?php
				if( have_rows('calendars', 'option') ):

				 	// loop through the rows of data
				    while ( have_rows('calendars', 'option') ) : the_row(); ?>
					
						<li><a href="<?php the_sub_field('calendar_file'); ?>" target="_blank"><?php the_sub_field('calendar_name'); ?></a></li>
				        
				   <?php endwhile;
				
				else :
				
				    // no rows found
				
				endif;	
				?>
			</ul>
		</div>

	</div>
</div>
<?php
do_action( 'tribe_events_before_template' );

// Main Events Content
tribe_get_template_part( 'month/content' );

do_action( 'tribe_events_after_template' );?>
<div class="row">
	<div class="col-sm-12">
		<div class="well well-sm">
			<ul class="list-inline margin-none">
				<?php if( have_rows('calendars_subscribe', 'option' )): ?>
					
					<li><strong>Subscribe to Calendars:</strong></li>
					
					<?php while ( have_rows('calendars_subscribe', 'option' )) : the_row(); ?>
						
						<li><a href="http://www.google.com/calendar/render?cid=<?php the_sub_field('calendar_url', 'option'); ?>" target="_blank"><?php the_sub_field('calendar_name', 'option'); ?></a></li>
						
					<?php endwhile; ?>
				
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>