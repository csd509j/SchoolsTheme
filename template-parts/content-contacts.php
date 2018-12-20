<?php
	
if ( get_field('sidebar_contact_block') ): 

	$values = get_field('sidebar_contact_block');	
	
	if ($values): ?>
		
		<div class="sidebar-contact py-2">
			<h4>Contact Information</h4>
		
		<?php
			
		foreach ($values as $value):
	
			if( have_rows('contact_blocks', 'option') ): ?>
			
				<div class="sidebar-contact-wrap">
					
				<?php while( have_rows('contact_blocks', 'option') ): the_row(); ?>
				
					<?php if( get_sub_field('contact_name') == $value ): ?>
					
						<div class="sidebar-contact-department">
							<p class="small subhead"><strong><?php the_sub_field('contact_name'); ?></strong></p>
							<p class="small">
								<?php 
								
								if( get_sub_field('contact_email') ): ?>
								
									<i class="fa fa-envelope"></i> <a href="mailto:<?php the_sub_field('contact_email'); ?>" target="_blank"><?php the_sub_field('contact_email'); ?></a>
									<br>
								
								<?php 
								
								endif; 
								
								if ( get_sub_field('contact_phone') ): ?>
								
									<i class="fa fa-phone"></i> <?php the_sub_field('contact_phone'); ?>
									<br>
								
								<?php 
								
								endif;
								
								if( get_sub_field('contact_fax') ): ?>
								
									<i class="fa fa-fax"></i> <?php the_sub_field('contact_fax'); ?>
									<br>
								
								<?php 
								
								endif; 
								
								if ( get_sub_field('contact_address') ): ?>
								
									<i class="fa fa-map-marker"></i> <?php the_sub_field('contact_address'); ?>
									<br>
								
								<?php 
								
								endif;
								
								if ( get_sub_field('contact_mailing_address') ): ?>
									
									Mailing Address: <?php the_sub_field('contact_address'); ?>
								
								<?php endif; ?>
								
							</p>
						</div> <!-- .sidebar-contact-department end -->
						
						<?php 
						
						// Check to see if staff contact is available
						if( have_rows('contact_staff') ): ?>
						
							<div class="sidebar-contact-staff">
								<p class="small subhead"><strong><?php the_sub_field('contact_name'); ?> Staff</strong></p>
		
								<?php while( have_rows('contact_staff') ): the_row(); ?>
									
									<p class="small">
										<a href="mailto:<?php the_sub_field('contact_staff_email'); ?>" target="_blank"><?php the_sub_field('contact_staff_name'); ?></a>, <?php the_sub_field('contact_staff_title'); ?>
										<br>
								
										<?php
										
										if ( get_sub_field('contact_staff_phone') ): ?>
										
											<?php the_sub_field('contact_staff_phone'); ?>
											<br>
									
										<?php
										
										endif;
										
										?>
										
									</p>
									
								<?php endwhile; ?> 
								
							</div> <!-- .sidebar-contact-staff end -->
							
							<?php endif; ?>	
											
							<?php endif; ?>
					
					<?php endwhile; ?>
			
				</div>	<!-- .sidebar-contact-wrap end -->		
			
				<?php endif; ?>
			
				<?php endforeach; ?>

			</div> <!-- .sidebar-contact end -->
	
	<?php
		
	endif;

endif; ?>
