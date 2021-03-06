<?php
	
if ( get_field('sidebar_callout_blocks') ): 
	
	$value = get_field('sidebar_callout_blocks');
	
	if ( $value ):
		
		// Loop through callout block heading names
			
		if( have_rows('callout_blocks', 'option') ):
						
			// Loop through all available callout_blocks
			while( have_rows('callout_blocks', 'option') ): the_row();	
			
				if( get_sub_field('callout_block_heading') == $value ):
				
					$valid = true;

					if ( get_sub_field('add_date') ):
						
						$date_now = new DateTime();
						$tz = new DateTimeZone('America/Los_Angeles');
						$date_now->setTimeZone($tz);
						
						$start = new DateTime(get_sub_field('start_date'));
						$end = new DateTime(get_sub_field('end_date'));
						
						if ( $date_now->format('mdY') > $end->format('mdY') || $date_now->format('mdY') < $start->format('mdY')):
							$valid = false;								
						endif;

					endif;
					
					if ( $valid == true ):
					
					?>
					<div class="row align-items-center sidebar-callouts">
							
							<?php 
							
							if ( get_sub_field('callout_block_link_type') != 'None' ):
								
								if ( get_sub_field('callout_block_link_type') == 'Internal' ):
								
									$link = get_sub_field('callout_block_link_internal');
							
								else:
									
									$link = get_sub_field('callout_block_link_external');
								
								endif;
							
							endif;
							
							if ( get_sub_field('callout_block_img') ) {
						
								$image = get_sub_field('callout_block_img'); 
								$imageID = $image['id'];
								
							} else {
								
								// For legacy images added by ACF-Crop
								
								if ( is_array(get_sub_field('callout_block_image')) ) {
						
									$image = get_sub_field('callout_block_image');
									$imageID = $image['id'];
								
								} else {
								
									$imageID = get_string_between(get_sub_field('callout_block_image'), '"cropped_image":', '}');
								
								}
										
							}
							
							if ($imageID):
							
							?>
							
								<div class="col-12 col-sm-4 col-md-5 col-lg-12">
									<div class="sidebar-callout-image pb-2 pb-sm-0 pb-md-0 pb-lg-1">
									
										<?php if ($link): ?>
										
											<a <?php if ( get_sub_field('callout_block_link_type') == 'External' ): ?> target="_blank" <?php endif; ?> href="<?php echo $link; ?>"><?php echo wp_get_attachment_image($image['id'], 'Callout Block', 0, array('class' => 'img-fluid')); ?></a>
										
										<?php else: ?>
											
											<?php echo wp_get_attachment_image($imageID, 'Callout Block', 0, array('class' => 'img-fluid')); ?>
										
										<?php endif; ?>
										
									</div>
								</div>
							
							<?php endif; ?>
							
								<div class="col-12 col-sm-8 col-md-7 col-lg-12 align-self-center">
									<div class="sidebar-callout-inner">
										
										<?php if ($link): ?>
										
											<a <?php if ( get_sub_field('callout_block_link_type') == 'External' ): ?> target="_blank" <?php endif; ?> href="<?php echo $link; ?>"><h4><?php the_sub_field('callout_block_heading'); ?></h4></a>
										
										<?php else: ?>
											
											<h4><?php the_sub_field('callout_block_heading'); ?></h4>
											
										<?php endif; ?>
										
										<?php the_sub_field('callout_block_text'); ?>
										
										<?php if (get_sub_field('add_a_button')): ?>
											
											<a class="btn btn-block btn-primary" <?php if ( get_sub_field('callout_block_link_type') == 'External' ): ?> target="_blank" <?php endif; ?> href="<?php echo $link; ?>"><?php the_sub_field('button_label'); ?></a>
											
										<?php endif; ?>
										
									</div>
								</div>
							</div>
						
						<?php
					
					endif;
				
				endif;
			
			endwhile;
			
		endif;
				
	endif;

endif; 

?>