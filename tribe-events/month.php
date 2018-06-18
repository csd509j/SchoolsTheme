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
?>
<div class="row">
	<div class="col-sm-8">
		<h1><?php the_field('calendar_title', 'options'); ?></h1>
		<?php the_field('calendar_text', 'options'); ?>
	</div>
	<div class="col-sm-4">
		<div class="well">
			<h4><i class="fa fa-download"></i> Calendars</h4>
			<ul class="list list-unstyled margin-none">
				<?php
				if( have_rows('calendars', 'options') ):

				 	// loop through the rows of data
				    while ( have_rows('calendars', 'options') ) : the_row(); ?>
					
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
				<li><strong>Subscribe to Calendars:</strong></li>
				
				<li><a target="_blank" href="http://www.google.com/calendar/render?cid=https://calendar.google.com/calendar/ical/corvallis.k12.or.us_225fi880u67dljur5cp3iutr70%40group.calendar.google.com/public/basic.ics">District Calendar</a></li>
				<li><a target="_blank" href="http://www.google.com/calendar/render?cid=https://calendar.google.com/calendar/ical/corvallis.k12.or.us_2d38393638363535343938%40resource.calendar.google.com/public/basic.ics">School Year Calendar</a></li>
				<li><a target="_blank" href="http://www.google.com/calendar/render?cid=https://calendar.google.com/calendar/ical/corvallis.k12.or.us_2d3733313630363234383133%40resource.calendar.google.com/public/basic.ics">Odd/Even Calendar</a></li>			
			</ul>
		</div>
	</div>
</div>