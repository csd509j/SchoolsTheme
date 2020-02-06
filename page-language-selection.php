<?php 
/**
 * Template Name: Select Language
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.7.5
 * @updated CSD Schools 3.6.4
 */
 
if (isset($_GET['redirect'])) {
	$referrer = $_GET['redirect'];
} else {
	$referrer = home_url();
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=medium-dpi" />
		<meta name="google-site-verification" content="" />
		<?php
		
		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
		
			echo('<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">');
			
		} 
		
		?>
	
		<title><?php wp_title(''); ?></title>
	
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php the_field('favicon', 'options'); ?>">
		<?php get_template_part('template-parts/google', 'analytics'); ?>
		<?php wp_head(); ?>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body id="page-language" <?php body_class(); ?>>
		<div class="container">
			<div class="modal" id="lang-splash" tabindex="-1" role="dialog" aria-labelledby="lang-splash" aria-hidden="false">
				<div class="modal-dialog">
			    	<div class="modal-content">
				    	<div class="modal-header d-flex">
					    	<div class="d-flex justify-content-start">
								<h3 class="modal-title">Preferred Language</h3>
					    	</div>
						</div>
						<div class="modal-body">
							<div class="d-flex border-bottom">
								<div class="flex-fill border-right">
									<a href="#" class="lang-link" data-id="en" data-referrer="<?php echo $referrer; ?>"><img src="<?php echo home_url('wp-content/themes/csdschools/assets/images/american-flag.jpg'); ?>" width="45px" /> English</a>
								</div>
								<div class="flex-fill">
									<a href="#" class="lang-link" data-id="es" data-referrer="<?php echo $referrer; ?>"><img src="<?php echo home_url('wp-content/themes/csdschools/assets/images/mexico-flag.jpg'); ?>" width="45px" /> Spanish</a>
								</div>
							</div>
					   		<div class="my-1 text-center">
						    	<img src="<?php the_field('logo', 'option'); ?>" class="img-fluid" width="250px" />	
					        </div>
			      		</div>
			    	</div>
			  	</div>
			</div>
		</div>
	</body>
</html>
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