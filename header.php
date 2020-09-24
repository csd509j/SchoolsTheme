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
<body <?php body_class(); ?>>
	<?php get_template_part('template-parts/content','alert'); ?>
	
	<div id="header-top-global">
		<div class="container h-100">
			<div class="row justify-content-between h-100">
				<div class="col-auto menu-top-block-container">
					<div class="row no-gutters h-100">
<!--
						<div class="col-auto align-self-center mr-1 d-none d-md-block">		
							
							<?php if (get_field('school_type', 'options') != 'Elementary'): ?>
								
								<?php render_block_calendar(get_field('block_calendar', 'options')); ?>
													
							<?php endif; ?>
						
						</div>
-->
						<div class="col-auto align-self-center">
							<a class="d-block" href="tel:<?php the_field('attendance_phone', 'options'); ?>"><?php _e('Attendance','csdschools'); ?>: <?php the_field('attendance_phone', 'options'); ?></a>
						</div>
					</div>
				</div>
				<div class="col-auto">
					<div class="row no-gutters h-100">
						<div class="col-auto align-self-center d-none d-lg-block">
							<?php wp_nav_menu( array('theme_location' => 'header-toplinks', 'items_wrap' => '<ul class="list list-unstyled" aria-label="Top Links">%3$s</ul>' )); ?>
						</div>
						<div class="col-auto align-self-center d-none d-sm-block mr-1">
							<a href="#" id="search-toggle"><i class="fa fa-search fa-lg"></i></a>
						</div>
						<div class="col-auto h-100" id="menu-top-language">
							<?php languages_toggle(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="search" class="d-sm-none">
		<div id="search-bar">
			<div class="search-bar-inner">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p><?php _e('Enter Search Below','csdschools'); ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<form role="search" id="sites-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
								 <label class="sr-only" for="search-text"><?php _e('Search...','csdschools'); ?></label>
								 <input type="text" class="search-field" id="search-text" placeholder="<?php _e('Search...','csdschools'); ?>" value="<?php echo get_search_query(); ?>" name="s">
								 <button type="submit" id="ss-icon"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapper">
		<div class="wrapper-inner">
			<div id="header-global" class="my-2">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-10 col-lg-4">
							<div id="logo" class="clearfix">
								<a href="<?php echo get_home_url(); ?>"><img class="img-fluid" src="<?php the_field('logo', 'option'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
							</div>
						</div>
						<div class="col-2 col-lg-8 d-flex justify-content-end">
							<div class="d-none d-lg-block">
								<?php wp_nav_menu( array('theme_location' => 'header-menu', 'items_wrap' => '<ul class="nav navbar-nav pull-right" aria-label="primary navigation">%3$s</ul>' )); ?>						
							</div>
							<div class="d-lg-none">
								<?php shiftnav_toggle( 'shiftnav-main' , '' , array( 'icon' => 'bars' , 'class' => 'shiftnav-toggle-button') ); ?>
							</div>
						</div>
						
					</div>
				</div>
			</div>