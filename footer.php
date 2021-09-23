				<!-- Contact Section Start -->
				<section id="footer-top"  class="py-2">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="headline">
									<h2><?php _e('Contact Us','csdschools'); ?></h2>
								</div>
								<p class="mb-1">
									
									<?php if ( get_field('office_hours', 'options') ): ?>
									
										<strong><?php _e('Office Hours','csdschools'); ?>:</strong> <?php the_field('office_hours', 'options'); ?><br/>
									
									<?php endif; ?>
									
									<strong><?php _e('Phone','csdschools'); ?>:</strong> <?php the_field('primary_phone', 'options'); ?><br/>
									<strong><?php _e('Fax','csdschools'); ?>:</strong> <?php the_field('fax_number', 'options'); ?><br/>
									
									<?php if ( get_field('attendance_phone', 'options') ): ?>
									
										<strong><?php _e('Attendance','csdschools'); ?>:</strong> <?php the_field('attendance_phone', 'options'); ?><br/>
									
									<?php endif; ?>
									
									<?php if ( get_field('attendance_email', 'options') ): ?>
									
										<strong><?php _e('Attendance Email','csdschools'); ?>:</strong> <a href="mailto:<?php the_field('attendance_email', 'options'); ?>"><?php the_field('attendance_email', 'options'); ?></a><br/>
									
									<?php endif; ?>
									
									<?php if ( get_field('athletics_hotline', 'options') ): ?>
										
										<strong><?php _e('Athletics Hotline','csdschools'); ?>:</strong> <?php the_field('athletics_hotline', 'options'); ?><br/>
									
									<?php endif; ?>
									
									<?php if ( get_field('email', 'options') ): ?>
									
										<strong><?php _e('Email','csdschools'); ?>:</strong> <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a><br/>
									
									<?php endif; ?>
									
									<strong><?php _e('Address','csdschools'); ?>:</strong> <?php the_field('street_address', 'options'); ?>
								</p>
								<p><strong><?php _e('Principal','csdschools'); ?>:</strong>
								<br/>
								
								<?php the_field('principal', 'options'); ?><?php if ( get_field('principal_email', 'options') ): ?>, <a href="mailto:<?php the_field('principal_email', 'options'); ?>"><?php the_field('principal_email', 'options'); ?></a><?php endif; ?>
								
								<?php if ( get_field('assistant_principal_1', 'options') ): ?>
								
									<br/>
									<strong><?php _e('Assistant Principal','csdschools'); ?>:</strong>
									<br>
									
									<?php the_field('assistant_principal_1', 'options'); ?><?php if ( get_field('assistant_principal_1_email', 'options') ): ?>, <a href="mailto:<?php the_field('assistant_principal_1_email', 'options'); ?>"><?php the_field('assistant_principal_1_email', 'options'); ?></a><?php endif; ?>
								
								<?php endif; ?>
									
								<?php if ( get_field('assistant_principal_2', 'options') ): ?>
								
										<br>	
										<strong><?php _e('Assistant Principal','csdschools'); ?>:</strong>
										<br>
										
										<?php the_field('assistant_principal_2', 'options'); ?><?php if ( get_field('assistant_principal_2_email', 'options') ): ?>, <a href="mailto:<?php the_field('assistant_principal_2_email', 'options'); ?>"><?php the_field('assistant_principal_2_email', 'options'); ?></a><?php endif; ?>
								
								<?php endif; ?>
									
								<?php if ( get_field('athletic_director', 'options') ): ?>
									
											<br>	
											<strong><?php _e('Assistant Principal/Athletic Director','csdschools'); ?>:</strong>
											<br>
											
											<?php the_field('athletic_director', 'options'); ?><?php if ( get_field('athletic_director_email', 'options') ): ?>, <a href="mailto:<?php the_field('athletic_director_email', 'options'); ?>"><?php the_field('athletic_director_email', 'options'); ?></a><?php endif; ?>
									
								<?php endif; ?>
								
								<?php if ( get_field('office_manager', 'options') ): ?>
									
									<br/>
									<strong><?php _e('Office Manager','csdschools'); ?>:</strong>
									<br>
									
									<?php the_field('office_manager', 'options'); ?><?php if ( get_field('office_manager_email', 'options') ): ?>, <a href="mailto:<?php the_field('office_manager_email', 'options'); ?>"><?php the_field('office_manager_email', 'options'); ?></a><?php endif; ?>
								
								<?php endif; ?>
							</div>
							<div class="col-md-6">
								<div class="headline">
									<div class="row">
										<div class="col-lg-8">
											<h2><?php _e('Upcoming Events','csdschools'); ?></h2>
										</div>
										<div class="col-lg-4 align-self-center justify-content-lg-end d-block d-md-none d-lg-block text-lg-right">
											<a href="<?php echo home_url('/calendar'); ?>"><?php _e('View Calendar','csdschools'); ?></a>
										</div>
									</div>
								</div>
								
								<?php render_list_view(); ?>
								
								<div class="d-none d-md-block d-lg-none mt-1">
									<a href="<?php echo home_url('/calendar'); ?>"><?php _e('View Calendar','csdschools'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section id="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-8 col-sm-2">
								<a href="https://www.csd509j.net"><img class="img-fluid" src="https://www.csd509j.net/wp-content/uploads/csd_logo.png" alt="Corvallis School District" /></a>						
							</div>
							<div class="col-sm-5">
								<ul class="list list-inline">
									<li class="list-inline-item"><a href="mailto:communications@corvallis.k12.or.us"><?php _e('Webmaster','csdschools'); ?></a></li>
									<li class="list-inline-item"><a href="mailto:communications@corvallis.k12.or.us"><?php _e('Report an Accessibility Issue','csdschools'); ?></a></li>
								</ul>
								<div class="footer-text pt-1"><?php the_field('harassment_statement', 'options'); ?></div>
								<p class="footer-text pt-2">
									&#169; Corvallis School District. Corvallis, Oregon 97333
								</p>
							</div>
							<div class="col-sm-5">
								<p class="footer-text"><?php the_field('statement', 'options'); ?> <?php the_field('statement_contact_name', 'options'); ?> <?php the_field('statement_contact_title', 'options'); ?>, <a href="mailto:<?php the_field('statement_contact_email', 'options'); ?>"><?php the_field('statement_contact_email', 'options'); ?></a> <?php the_field('statement_contact_phone', 'options'); ?></p>
							</div>
						</div>
					</div>
				</section>
				<section id="footer-social" class="py-2">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 mb-1 mb-lg-0">
								<ul class="social-media-links">
									<p><?php _e('Connect with Us','csdschools'); ?></p>
									<li>
										<a href="https://www.twitter.com/SuptNoss" target="_blank" class="social">
											<i class="fab fa-twitter-square fa-2x"></i>
										</a>	
									</li>
									<li>
										<a href="https://www.facebook.com/csd509j" target="_blank" class="social">
											<i class="fab fa-facebook-square fa-2x"></i>
										</a>
									</li>
									<li>
										<a href="https://www.instagram.com/corvallis.schools/" target="_blank" class="social">
											<i class="fab fa-instagram fa-2x"></i>
										</a>
									</li>
									<li>
										<a href="https://www.linkedin.com/company/corvallis-school-district-509j" target="_blank" class="social">
											<i class="fab fa-linkedin-square fa-2x"></i>
										</a>
									</li>
								</ul>
							</div>
							<div id="credits" class="col-lg-6 text-center text-lg-right">
								<a href="https://abidewebdesign.com" target="_blank"><?php _e('Website Design & Maintenance by Abide Web Design','csdschools'); ?></a>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" aria-labelledby="modalNotification" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header py-3">
						<div class="d-flex w-100 h-100 justify-content-center">
							<i class="fa fa-external-link fa-3x text-white"></i>
						</div>
					</div>
					<div class="modal-body p-2 text-center"><h3 class="mb-0"><?php the_field('external_notification', 'options'); ?></h3></div>
					<div class="modal-footer">
						<a id="externalLink" href="#" class="btn btn-lg btn-block"><?php _e('Proceed','csdschools'); ?></a>
					</div>
				</div>
			</div>
		</div>
		
		<?php get_template_part('template-parts/content', 'pop-up'); ?>
		<?php wp_footer(); ?>
		
		<div id="google_translate_element" class="d-none"></div>
		<script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
			}
			
			$(function() {
				$('#menu-top-language a').click(function() {
					if ($(this).data('lang')) {
						Cookies.set('csd_translation_preference', $(this).data('lang'), { expires: 365 });
					}
				});
			});
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	</body>
</html>