<?php if( have_rows('calendar_downloads', 'options') ): ?>
	
	<h3 class="mt-1"><?php _e('Calendar Downloads','csdschools'); ?></h3>
	<div class="table-responsive">
		<table class="table table-white table-bordered">
		
		<?php while( have_rows('calendar_downloads', 'options') ): the_row(); ?>
		
			<tr><td><i class="fa fa-download"></i> <a href="<?php the_sub_field('calendar_file'); ?>" target="_blank"><?php the_sub_field('calendar_name'); ?></a></td></tr>
		
		<?php endwhile; ?>
		
		</table>
	</div>
	
<?php endif; ?>