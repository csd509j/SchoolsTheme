<?php $calendars = get_calendars(); ?>

<h3 class="mt-1"><?php _e('Calendar Downloads','csdschools'); ?></h3>

<div class="table-responsive">
	
	<table class="table table-white table-bordered">
	
		<?php foreach ( $calendars as $calendar ): ?>
			
			<tr>
				
				<td>
					
					<i class="fa fa-download"></i> <a href="<?php echo $calendar['url'] ?>" target="_blank"><?php echo $calendar['name']; ?></a>
					
				</td>
				
			</tr>
			
		<?php endforeach; ?>
		
		<?php if ( have_rows('calendar_downloads', 'options') ): ?>
			
			<?php while ( have_rows('calendar_downloads', 'options') ): the_row(); ?>
	
				<tr>
					
					<td>
						
						<i class="fa fa-download"></i> <a href="<?php the_sub_field('calendar_file'); ?>" target="_blank"><?php the_sub_field('calendar_name'); ?></a>
						
					</td>
					
				</tr>
	
			<?php endwhile; ?>
			
		<?php endif; ?>
	
	</table>
	
</div>