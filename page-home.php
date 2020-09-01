<?php
/**
 * Template Name: Home
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

get_header(); ?>
<div id="content" role="main" tabindex="0">
	<!-- Carousel Section Start -->
	<section class="carousel-wrap mb-0">
		<div id="carousel" class="carousel slide" data-ride="carousel">
		
		<?php 

			$images = get_field('carousel_images');

			if ( $images ): ?>
			
				<!-- Indicators -->
				<ol class="carousel-indicators">
					
					<?php for ( $i = 0; $i < count($images); ++$i ): ?>
					
							<li data-target="#carousel" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0): ?>class="active"<?php endif; ?>></li>
					
					<?php endfor; ?>
				
				</ol>
				
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					
					<?php 
					
					$x = 0;	
					
					foreach ( $images as $image ): ?>
						
						<?php $image_src = wp_get_attachment_image_src($image['id'], 'Home Slider', false); ?>
						
						<div class="carousel-item <?php if ( $x == 0 ): ?>active<?php endif; ?>">
							
							<?php if ( get_field('link', $image['id']) ): ?>
							
								<?php $link = get_field('link', $image['id']); ?>
							
								<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="headline-link">
							
							<?php endif; ?>
					  		
					  		<img src="<?php echo $image_src[0]; ?>" class="d-block w-100" />
					  		
					  		<?php if ( $image['title'] || $image['caption'] ): ?>
						  	
						  		<div class="carousel-caption">
							  		<div class="carousel-title">
							  			<h3><?php echo $image['title']; ?></h3>
							  		</div>
							
							  		<?php if ( $image['caption'] ): ?>
							
							  		<div class="carousel-caption-bg">
						  				<p><?php echo $image['caption']; ?></p>
						  			</div>
						  	
						  			<?php endif; ?>
						  	
						  		</div>
						  	
						  	<?php endif; ?>

					  		<?php if ( get_field('link', $image['id']) ): ?>
							
								</a>
							
							<?php endif; ?>
							
						</div>
					<?php 
					
					$x ++;
					
					endforeach; ?>
					
				</div>
				<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>	
															
			<?php endif; ?>
			
		</div>
	</section>
	<!-- Carousel Section End -->	
	<!-- News Section Start -->
	<section class="container py-2 py-xl-3">
		<div class="row">
			<div id="news" class="col-md-9">

				<div class="headline">
					<div class="d-flex justify-content-between">
						<div class="align-self-center">
							<h2><?php _e('Latest News','csdschools'); ?></h2>
							
						</div>
						<div class="mb-1">
							<small><a class="btn btn-primary" href="https://www.parentsquare.com/schools/<?php the_field('parentsquare_id', 'options'); ?>/feeds"><?php _e('More Updates','csdschools'); ?></a></small>	
						</div>
					</div>
				</div>

				<iframe src="https://www.parentsquare.com/schools/<?php the_field('parentsquare_id', 'options'); ?>/rss_widget" title="New School Posts From ParentSquare" height="441px" scrolling="no" frameborder="0" width="100%" style="border:none;overflow:hidden;"></iframe>
			
 			</div>
 			<div class="col-md-3">
 				<div id="secondary-search">
	 				<form role="search" id="sites-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		 				<label class="sr-only" for="search-text"><?php _e('Search...','csdschools'); ?></label>
		 				<div class="form-group">
		 					<input type="text" class="form-control" placeholder="<?php _e('Search Site...','csdschools'); ?>" value="<?php echo get_search_query(); ?>" name="s">
	        			</div>
	 				</form>
				</div>
				<div id="quick-links">
					<div class="row">
					
					<?php for ( $x = 1; $x < 5; $x++ ): ?>
					
						<div class="quick-link col-sm-6 col-md-12"> 
					
								<?php if ( get_field('home_quick_link_' . $x . '_type') == "External Link" ): ?>
					
									<a href="<?php the_field('home_quick_link_' . $x . '_link'); ?>" target="_blank" class="btn btn-secondary btn-block btn-lg">
					
								<?php elseif ( get_field('home_quick_link_' . $x . '_type') == "Media File" ): ?>
					
									<a href="<?php the_field('home_quick_link_' . $x . '_media'); ?>" target="_blank" class="btn btn-secondary btn-block btn-lg">
					
								<?php elseif ( get_field('home_quick_link_' . $x . '_type') == "Page" ): ?>
					
									<a href="<?php the_field('home_quick_link_' . $x . '_page'); ?>" class="btn btn-secondary btn-block btn-lg">
					
								<?php endif; ?>
					
								<h4><?php the_field('home_quick_link_' . $x . '_text'); ?></h4>
							</a>
						</div>
						
					<?php endfor; ?>
					
					</div>
				</div>			
 			</div>			
		</div>
	</section>
	
	<!-- News Section End -->
	
	<?php if ( get_field('include_video_section') ): ?>
	
		<!-- Video Section Start -->
		<section id="cta" class="bg-primary text-white">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm-8 text-center">
						<div id="cta-text" class="py-3">
							<h2 class="text-white mb-1"><?php the_field('video_section_heading'); ?></h2>
							<p class="lead"><?php the_field('video_section_text'); ?></p>
							<div class="embed-responsive embed-responsive-16by9">
							
								<?php $video_url = get_field('video_url'); ?>
							
								<?php $v = substr( $video_url, strpos($video_url, "v=") + 2 ); ?>
							
								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $v; ?>?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Video Section End -->
	
	<?php endif; ?>

</div>

<?php get_footer(); ?>