<div class="pb-1">
	<ul class="list-inline">
		<?php 		
		if( have_rows('card_vertical_blocks') ): 
			
			while ( have_rows('card_vertical_blocks') ) : the_row(); 
			
				if ( get_sub_field('card_vertical_link_type') == 'Page' ):
					
					$link = get_sub_field('page_link');
				
				elseif ( get_sub_field('card_vertical_link_type') == 'News Post' ):
					
					$post_object = get_sub_field('news_post_link');
					
					if( $post_object ): 
	
						$post = $post_object;
						setup_postdata( $post ); 
						$link = get_the_permalink();
						wp_reset_postdata();
					
					endif;
								
				elseif ( get_sub_field('card_vertical_link_type') == 'Media File' ):
					
					$link = get_sub_field('media_link');
									
				endif;
				?>
				<li class="list-inline-item col-6 col-sm-4 card-vertical-block-wrap">
					<div class="card-vertical-block">
							
					<?php 
						
						if ( get_sub_field('card_vertical_img') ) {
							
							$image = get_sub_field('card_vertical_img'); 
							$imageID = $image['id'];
							
						} else {
							
							// For legacy images added by ACF-Crop
							
							if ( is_array(get_sub_field('card_vertical_image')) ) {
					
								$image = get_sub_field('card_vertical_image');
								$imageID = $image['id'];
							
							} else {
							
								$imageID = get_string_between(get_sub_field('card_vertical_image'), '"cropped_image":', '}');
							
							}
									
						}
						
					?>
					
						<div class="card-vertical-img">
							<a href="<?php echo $link; ?>" <?php if ( get_sub_field('card_vertical_link_type') == 'Media File' ): ?>target="_blank"<?php endif; ?>><?php echo wp_get_attachment_image($imageID, 'Square Column 4', 0, array('class' => 'img-fluid')); ?></a>
						</div>
							
						<div class="card-vertical-content">
							<a href="<?php echo $link; ?>" <?php if ( get_sub_field('card_vertical_link_type') == 'Media File' ): ?>target="_blank"<?php endif; ?>><h4><?php the_sub_field('card_vertical_title'); ?></h4></a>
						</div>
												
					</div>
				</li>	
			<?php endwhile; ?>
		<?php endif; ?>
	</ul>
</div>