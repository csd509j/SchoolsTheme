<div class="py-2 directory-wrap">
	<?php
	
	$cats = get_terms('directory-category');
	
	foreach ($cats as $cat):
	
		$cat_query = new WP_Query( array(
			'post_type' => 'directory',
			'post_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'directory-category',
					'field' => 'slug',
					'terms' => array( $cat->slug ),
					'operator' => 'IN',
				)
			),
			'meta_key' => 'last_name',
			'orderby' => 'meta_value',
			'order' => 'ASC',
		));
			
		if ( $cat_query->have_posts() ): 
			
			// Setup bootstrap grid
			$i = 0;
			$departmentID = "";
			
			echo '<h2 class="pt-1">' . $cat->name . '</h2>';
			
			while ( $cat_query->have_posts() ): $cat_query->the_post(); 
				
				if ( $i == 0 ) {
					echo '<div class="row">';
				}
				
				$i++;
				$contact = '';
				$website = '';
				
				if ( get_field('profile_image', get_the_ID()) ) {
					$image = get_field( 'profile_image', get_the_ID() );
				} else {
					$image = '/wp-content/themes/csdschools/assets/images/profile_avatar_placeholder_large.png';
				}
				
				$meta = get_field('title', get_the_ID());
				
				if ( get_field('email', get_the_ID()) ){
					$contact = '<i class="fas fa-envelope"></i> <a href="mailto:' . get_field( 'email', get_the_ID() ) . '">' . get_field( 'email', get_the_ID() ) . '</a><br>';
				}
				if ( get_field( 'phone' , get_the_ID()) ){
					$contact .= '<i class="fas fa-phone"></i> <a href="tel:' . get_field( 'phone', get_the_ID() ) . '">' . get_field( 'phone', get_the_ID() ) . '</a>';
				}
				if ( get_field('class_website', get_the_ID()) ){
					$website = '<i class="fas fa-globe"></i> <a href="' . get_field( 'class_website', get_the_ID() ) . '">View Website</a>';
				}
				if ( get_field('class_website_2', get_the_ID()) ){
					$website .= '<br><i class="fas fa-globe"></i> <a href="' . get_field( 'class_website_2', get_the_ID() ) . '">' . get_field( 'class_website_2_label', get_the_ID() ) . '</a>';
				}
		
				$bio = get_field( 'bio', get_the_ID() );
				
				?>
		
				<div class="col-sm-6 py-1">
					<div class="row">
						<div class="col-md-3 d-none d-md-block profile-image">
							<?php if ( get_field( 'profile_image', get_the_ID() ) ): ?>
								<?php echo wp_get_attachment_image($image['id'], 'Staff Directory', 0, array('class' => 'img-fluid')); ?>
							<?php else: ?>
								<img src="<?php echo $image; ?>" class="img-fluid" />
							<?php endif; ?>
						</div>				
						<div class="col-md-9 profile-content">
							<div class="subhead">
								<h4><?php the_title(); ?></h4>
							</div>
							<div class="subsection small">
								<?php echo $meta; ?>
							</div>
							<div class="submeta">
								<ul class="list-unstyled list-inline mb-0">
									<li class="col-12 list-inline-item small p-0 m-0"><?php echo $contact; ?></li>
									<?php if($website): ?>
										<li class="col-12 list-inline-item small p-0 m-0"><?php echo $website; ?></li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			
				<?php
					
				if ( $i == 2 ) {
					echo '</div>';
					$i = 0;
				}
			
			endwhile; 
			
			if ( $i != 0 ) {
				echo '</div>';
			}
			
		endif;
		
		$cat_query = null;
		wp_reset_postdata();	
	
	endforeach;
	
	?>
</div>