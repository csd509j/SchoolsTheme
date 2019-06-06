<div class="row justify-content-center pb-1">
	
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
				
			elseif ( get_sub_field('card_vertical_link_type') == 'External' ):
			
				$link = get_sub_field('external_link');
								
			endif;
			?>
			<div class="col-6 col-sm-4 d-flex align-items-stretch card-vertical-block-wrap">
				<div class="card card-vertical-block">
						
				<?php 
					
					if ( get_sub_field('card_vertical_img') ) {
						
						$image = get_sub_field('card_vertical_img'); 
						
					} else {
						
						// For legacy images added by ACF-Crop
					
						$crop = get_sub_field('card_vertical_image');
						$image = $crop['original_image'];
								
					}
					
				?>
				
					<div class="card-vertical-img">
						<a href="<?php echo $link; ?>" <?php if ( get_sub_field('card_vertical_link_type') == 'Media File' || get_sub_field('card_vertical_link_type') == 'External' ): ?>target="_blank"<?php endif; ?>><?php echo wp_get_attachment_image($image['id'], 'Square Column 4', 0, array('class' => 'img-fluid')); ?></a>
					</div>
						
					<div class="card-body card-vertical-content">
						<a href="<?php echo $link; ?>" <?php if ( get_sub_field('card_vertical_link_type') == 'Media File'  || get_sub_field('card_vertical_link_type') == 'External' ): ?>target="_blank"<?php endif; ?>><h4><?php the_sub_field('card_vertical_title'); ?></h4></a>
					</div>
											
				</div>
			</div>
				
		<?php endwhile; ?>
		
	<?php endif; ?>
		
</div>