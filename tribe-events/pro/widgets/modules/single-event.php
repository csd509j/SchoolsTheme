<?php
/**
 * Single Event Template for Widgets
 *
 * This template is used to render single events for both the calendar and advanced
 * list widgets, facilitating a common appearance for each as standard.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/pro/widgets/modules/single-event.php
 *
 * @version 4.4.3
 *
 * @package TribeEventsCalendarPro
 */

$mini_cal_event_atts = tribe_events_get_widget_event_atts();

$post_date = tribe_events_get_widget_event_post_date();
$post_id   = get_the_ID();

?>
	<td>
		<?php
		echo apply_filters(
			'tribe-mini_helper_tribe_events_ajax_list_dayname',
			date_i18n( 'M', $post_date ),
			$post_date,
			$mini_cal_event_atts['class']
		);
		?>

		<?php echo apply_filters( 'tribe-mini_helper_tribe_events_ajax_list_daynumber', date_i18n( 'd', $post_date ), $post_date, $mini_cal_event_atts['class'] ); ?>
	</td>
	<td>
		<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>
		
		<div class="tribe-events-duration">
			<?php echo tribe_get_start_time(); ?> - <?php echo tribe_get_end_time(); ?>
		</div>
		
		<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
	</td>
	<td>
		<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
		
		<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
			
		<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
	</td>
	
