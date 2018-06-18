<div class="padding-vertical-two directory-wrap">
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
			
			echo '<h2 class="padding-top-one">' . $cat->name . '</h2>';
			
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
					$image = home_url('/wp-content/uploads/2017/08/Profile_avatar_placeholder_large.png');
				}
				
				$meta = get_field('title', get_the_ID());
				
				if ( get_field('email', get_the_ID()) ){
					$contact = '<i class="fa fa-envelope"></i> <a href="mailto:' . get_field( 'email', get_the_ID() ) . '">' . get_field( 'email', get_the_ID() ) . '</a><br>';
				}
				if ( get_field( 'phone' , get_the_ID()) ){
					$contact .= '<i class="fa fa-phone"></i> <a href="tel:' . get_field( 'phone', get_the_ID() ) . '">' . get_field( 'phone', get_the_ID() ) . '</a>';
				}
				if ( get_field('class_website', get_the_ID()) ){
					$website = '<i class="fa fa-globe"></i> <a href="' . get_field( 'class_website', get_the_ID() ) . '">View Website</a>';
				}
				if ( get_field('class_website_2', get_the_ID()) ){
					$website .= '<br><i class="fa fa-globe"></i> <a href="' . get_field( 'class_website_2', get_the_ID() ) . '">' . get_field( 'class_website_2_label', get_the_ID() ) . '</a>';
				}
		
				$bio = get_field( 'bio', get_the_ID() );
				
				?>
		
				<div class="col-sm-6 col-xs-12 padding-vertical-one">
					<div class="row">
						<div class="col-sm-3 hidden-xs profile-image">
							<?php if ( get_field( 'profile_image', get_the_ID() ) ): ?>
								<?php echo wp_get_attachment_image($image['id'], 'Staff Directory', 0, array('class' => 'img img-responsive')); ?>
							<?php else: ?>
								<img src="<?php echo $image; ?>" class="img img-responsive" />
							<?php endif; ?>
						</div>				
						<div class="col-sm-9 col-xs-12 profile-content">
							<div class="subhead">
								<h4><?php the_title(); ?></h4>
							</div>
							<div class="subsection small">
								<?php echo $meta; ?>
							</div>
							<div class="submeta">
								<ul class="list-unstyled list-inline margin-none">
									<li class="col-xs-12 small"><?php echo $contact; ?></li>
									<li class="col-xs-12 small"><?php echo $website; ?></li>
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