<?php 
/**
 * Template Name: Select Language
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.7.5
 */
wp_head(); 

if (isset($_GET['referrer'])) {
	$referrer = $_GET['referrer'];
} else {
	$referrer = home_url();
}

?>
<div id="page-language">
	<div class="container">
		<div class="modal" id="lang-splash" tabindex="-1" role="dialog" aria-labelledby="lang-splash" aria-hidden="false">
			<div class="modal-dialog">
		    	<div class="modal-content">
			    	<div class="modal-header d-flex">
				    	<div class="d-flex justify-content-start">
							<h3 class="modal-title">Preferred Language</h3>
				    	</div>
						<div class="d-flex justify-content-end">
							<ul class="list-inline mb-0">
								<li class="list-inline-item"><img src="<?php echo home_url('wp-content/themes/csdschools/assets/images/american-flag.jpg'); ?>" width="45px" /></li>
								<li class="list-inline-item"><img src="<?php echo home_url('wp-content/themes/csdschools/assets/images/mexico-flag.jpg'); ?>" width="45px" /></li>
							</ul>
						</div>
					</div>
					<div class="modal-body">
				        <div class="list-group">
					        <a href="#" class="lang-link" data-id="en" data-referrer="<?php echo $referrer; ?>">
						        <div class="list-group-item">
							        <div class="row">
								        <div class="col-8">English</div>
								        <div class="col-4 text-right">
									        <label for="en">
												<input id="en" type="radio" class="d-none" name="language" value="0"/>
												<i class="far fa-dot-circle"></i>
											</label>
								        </div>
							        </div> 
						        </div>
						    </a>
						    <a href="#" class="lang-link" data-id="es" data-referrer="<?php echo $referrer; ?>">
						        <div class="list-group-item">
							        <div class="row">
								        <div class="col-8">Spanish</div>
								        <div class="col-4 text-right">
									        <label for="es">
												<input id="es" type="radio" class="d-none" name="language" value="0"/>
												<i class="far fa-dot-circle"></i>
											</label>
								        </div>
							        </div> 
						        </div>
						    </a>
				        </div>
				        <div class="my-1 text-center">
					    	<img src="<?php the_field('logo', 'option'); ?>" class="img-fluid" width="200px" />	
				        </div>
		      		</div>
		    	</div>
		  	</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('.lang-link').click(function() {
		var lang = $(this).data('id');
		var referrer = $(this).data('referrer');

		if(lang == 'en') {
			$("#en").prop("checked", true);
			Cookies.set('csd_translation_preference', 'en', { expires: 365 });
		} else if (lang == 'es') {
			$("#es").prop("checked", true);
			Cookies.set('csd_translation_preference', 'es', { expires: 365 });
		}
		
		window.location.href = referrer;
	});
});
</script>
<?php wp_footer(); ?>