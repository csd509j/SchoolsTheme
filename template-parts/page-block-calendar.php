<?php $calendar_address = get_sub_field('calendar_address'); ?>
<div class="padding-bottom-one">
	<?php if(get_sub_field('calendar_title')): ?>
		<h2><?php the_sub_field('calendar_title'); ?></h2>
	<?php endif; ?>
	<?php render_page_builder_calendar($calendar_address); ?>
</div>