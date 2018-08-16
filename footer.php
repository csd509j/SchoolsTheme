				<!-- Contact Section Start -->
				<section id="footer-top"  class="padding-vertical-two">
					<div class="container">
						<div class="row">
							<div class="col-sm-6">
								<div class="headline">
									<h2>Contact Us</h2>
								</div>
								<p class="margin-bottom-three"><strong>Phone:</strong> <?php the_field('primary_phone', 'options'); ?><br/>
								<strong>Fax:</strong> <?php the_field('fax_number', 'options'); ?><br/>
								<strong>Attendance:</strong> <?php the_field('attendance_phone', 'options'); ?><br/>
								<?php if(get_field('email', 'options')): ?>
									<strong>Email:</strong> <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a><br/>
								<?php endif; ?>
								<strong>Address:</strong> <?php the_field('street_address', 'options'); ?></p>
								<p><strong>Principal:</strong>
								<br/>
								<?php the_field('principal', 'options'); ?><?php if(get_field('principal_email', 'options')): ?>, <a href="mailto:<?php the_field('principal_email', 'options'); ?>"><?php the_field('principal_email', 'options'); ?></a><?php endif; ?>
								<br/>
								<strong>Assistant Principal:</strong>
								<br>
								<?php the_field('assistant_principal_1', 'options'); ?><?php if(get_field('assistant_principal_1_email', 'options')): ?>, <a href="mailto:<?php the_field('assistant_principal_1_email', 'options'); ?>"><?php the_field('assistant_principal_1_email', 'options'); ?></a><?php endif; ?>
								<?php if(get_field('assistant_principal_2', 'options')): ?>
									<br>	
									<strong>Assistant Principal:</strong><br><?php the_field('assistant_principal_2', 'option'); ?><?php if(get_field('assistant_principal_2_email', 'options')): ?>, <a href="mailto:<?php the_field('assistant_principal_2_email', 'options'); ?>"><?php the_field('assistant_principal_2_email', 'options'); ?></a><?php endif; ?>
								<?php endif; ?>
							</div>
							<div class="col-sm-6">
								<div class="headline">
									<div class="row">
										<div class="col-sm-8">
											<h2>Events Today</h2>
										</div>
										<div class="col-sm-4 text-right padding-top-quarter">
											<a href="<?php echo home_url('/calendar'); ?>">View Full Calendar</a>
										</div>
									</div>
								</div>
								<?php render_list_view(); ?>
							</div>
						</div>
					</div>
				</section>
				<section id="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-sm-2 col-xs-8">
								<a href="/"><img class="img-responsive" src="https://www.csd509j.net/wp-content/uploads/csd_logo.png" alt="Corvallis School District" /></a>						
							</div>
							<div class="col-sm-5 col-xs-12">
								
								<ul class="list list-inline">
									<li><a href="mailto:communications@corvallis.k12.or.us">Webmaster</a></li>
									<li><a href="mailto:communications@corvallis.k12.or.us">Report an Accessibility Issue</a></li>
								</ul>
								
								<p class="footer-text padding-top-one">
									Report bullying, harassment or intimidation at your school. The Harassment, Intimidation and Bullying Compliance Officer is <a href="mailto:kevin.bogatin@corvallis.k12.or.us" target="_blank">Kevin Bogatin</a>. The Title IX Compliance Officer is <a href="mailto:jennifer.duval@corvallis.k12.or.us" target="_blank">Jennifer Duvall</a>. The Section 504 & ADA Compliance Officer is <a href="mailto:rynda.gregory@corvallis.k12.or.us" target="blank">Rynda Gregory</a>.  
								</p>
								<p class="footer-text padding-top-two">
									&#169; Corvallis School District. Corvallis, Oregon 97333
								</p>
							</div>
							<div class="col-sm-5 col-xs-12">
								<p class="footer-text">The Corvallis School District does not discriminate on the basis of age, citizenship, color, disability, gender expression, gender identity, national origin, parental or marital status, race, religion, sex, or sexual orientation in its programs and activities, and provides equal access to designated youth groups. The following person has been designated to handle inquiries regarding discrimination: Jennifer Duvall Human Resources Director, <a href="mailto:jennifer.duvall@corvallis.k12.or.us">jennifer.duvall@corvallis.k12.or.us</a> 541-757-5840</p>
							</div>
						</div>
					</div>
				</section>
				<section id="footer-social" class="padding-vertical-two">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<ul class="social-media-links">
									<p>Connect with Us</p>
									<li>
										<a href="https://www.twitter.com/SuptNoss" target="_blank" class="social">
											<i class="fa fa-twitter-square fa-2x"></i>
										</a>	
									</li>
									<li>
										<a href="https://www.facebook.com/csd509j" target="_blank" class="social">
											<i class="fa fa-facebook-square fa-2x"></i>
										</a>
									</li>
									<li>
										<a href="https://www.linkedin.com/company/corvallis-school-district-509j" target="_blank" class="social">
											<i class="fa fa-linkedin-square fa-2x"></i>
										</a>
									</li>
								</ul>
							</div>
							<div id="credits" class="col-sm-6 col-xs-12 text-right">
								<a href="http://abidewebdesign.com" target="_blank">Website Design & Maintenance by Abide Web Design</a>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	
		<?php wp_footer(); ?>
		<div id="google_translate_element" class="hidden"></div>
		<script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
			}
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	</body>
</html>