<?php $cat = get_sub_field('calendar_category'); ?>
<div class="padding-bottom-two">
	<?php echo do_shortcode('[tribe_events_list limit="1000" category="#' . $cat . '"]'); ?>
</div>