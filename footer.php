				<!-- Contact Section Start -->
				<section id="footer-top"  class="py-2">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="headline">
									<h2><?php echo (ICL_LANGUAGE_CODE=='es' ? 'Contáctenos' : 'Contact Us'); ?></h2>
								</div>
								<p class="mb-1"><strong>Phone:</strong> <?php the_field('primary_phone', 'options'); ?><br/>
									<strong>Fax:</strong> <?php the_field('fax_number', 'options'); ?><br/>
									<strong>Attendance:</strong> <?php the_field('attendance_phone', 'options'); ?><br/>
									<?php if(get_field('email', 'options')): ?>
										<strong>Email:</strong> <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a><br/>
									<?php endif; ?>
									<strong>Address:</strong> <?php the_field('street_address', 'options'); ?>
								</p>
								<p><strong>Principal:</strong>
								<br/>
								<?php the_field('principal', 'options'); ?><?php if(get_field('principal_email', 'options')): ?>, <a href="mailto:<?php the_field('principal_email', 'options'); ?>"><?php the_field('principal_email', 'options'); ?></a><?php endif; ?>
								<?php if(get_field('assistant_principal_1', 'options')): ?>
									<br/>
									<strong>Assistant Principal:</strong>
									<br>
									<?php the_field('assistant_principal_1', 'options'); ?><?php if(get_field('assistant_principal_1_email', 'options')): ?>, <a href="mailto:<?php the_field('assistant_principal_1_email', 'options'); ?>"><?php the_field('assistant_principal_1_email', 'options'); ?></a><?php endif; ?>
									<?php if(get_field('assistant_principal_2', 'options')): ?>
										<br>	
										<strong>Assistant Principal:</strong><br><?php the_field('assistant_principal_2', 'option'); ?><?php if(get_field('assistant_principal_2_email', 'options')): ?>, <a href="mailto:<?php the_field('assistant_principal_2_email', 'options'); ?>"><?php the_field('assistant_principal_2_email', 'options'); ?></a><?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
								<?php if(get_field('office_manager', 'options')): ?>
									<br/>
									<strong>Office Manager:</strong>
									<br>
									<?php the_field('office_manager', 'options'); ?><?php if(get_field('office_manager_email', 'options')): ?>, <a href="mailto:<?php the_field('office_manager_email', 'options'); ?>"><?php the_field('office_manager_email', 'options'); ?></a><?php endif; ?>
								<?php endif; ?>
							</div>
							<div class="col-md-6">
								<div class="headline">
									<div class="row">
										<div class="col-lg-8">
											<h2><?php echo (ICL_LANGUAGE_CODE=='es' ? 'Eventos próximos' : 'Upcoming Events'); ?></h2>
										</div>
										<div class="col-lg-4 align-self-center justify-content-lg-end d-block d-md-none d-lg-block text-lg-right">
											<a href="<?php echo home_url('/calendar'); ?>">View Calendar</a>
										</div>
									</div>
								</div>
								<?php render_list_view(); ?>
								<div class="d-none d-md-block d-lg-none mt-1">
									<a href="<?php echo home_url('/calendar'); ?>">View Calendar</a>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section id="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-8 col-sm-2">
								<a href="/"><img class="img-fluid" src="https://www.csd509j.net/wp-content/uploads/csd_logo.png" alt="Corvallis School District" /></a>						
							</div>
							<div class="col-sm-5">
								<ul class="list list-inline">
									<li class="list-inline-item"><a href="mailto:communications@corvallis.k12.or.us">Webmaster</a></li>
									<li class="list-inline-item"><a href="mailto:communications@corvallis.k12.or.us">Report an Accessibility Issue</a></li>
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
									<p>Connect with Us</p>
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
								<a href="http://abidewebdesign.com" target="_blank">Website Design & Maintenance by Abide Web Design</a>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
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