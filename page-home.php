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

			if( $images ): ?>
			
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php for($i = 0; $i < count($images); ++$i){ ?>
							<li data-target="#carousel" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0): ?>class="active"<?php endif; ?>></li>
					<?php } ?>
				</ol>
				
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php 
					
					$x = 0;	
					
					foreach( $images as $image ): ?>
						
						<div class="carousel-item <?php if ($x == 0): ?>active<?php endif; ?>">
							<?php if (get_field('link', $image['id'])): ?>
								<a href="<?php the_field('link', $image['id']); ?>" class="headline-link">
							<?php endif; ?>
					  		<?php echo wp_get_attachment_image($image['id'], 'Home Slider', false, array('class'=>'d-block w-100 img-fluid')); ?>
					  		<div class="carousel-caption">
						  		<div class="carousel-title">
						  			<h3><?php echo $image['title']; ?></h3>
						  		</div>
						  		<?php if ($image['caption']): ?>
						  		<div class="carousel-caption-bg">
					  				<p><?php echo $image['caption']; ?></p>
					  			</div>
					  			<?php endif; ?>
					  		</div>
					  		<?php if (get_field('link', $image['id'])): ?>
								</a>
							<?php endif; ?>
						</div>
					<?php 
					
					$x ++;
					
					endforeach; ?>
					
				</div>
								
			<?php endif; ?>
		</div>
	</section>
	<!-- Carousel Section End -->	
	<!-- News Section Start -->
	<section class="container py-3">
		<div class="row">
			<div id="news" class="col-lg-9">
				<div class="headline">
					<h2>Latest News</h2>
				</div>
				<div class="row">
				
				<?php 
				
				$args = array( 
					'post_type' => 'news', 
					'posts_per_page' => '2', 
					'meta_query' => array(
						array(
							'key'    => 'news_post_type',
							'value'    => 'featured',
						),
					), 
				);

				$loop = new WP_Query( $args );
				
				$featured_ids = array();

 				while ( $loop->have_posts() ) : $loop->the_post();
					
					$featured_ids[] = $post->ID;
					$image = get_field('featured_image', $post->ID);
					
				?>
				
					<div class="col-md-6 col-xl-4 news-item">
						<div class="row">
							<div class="col-3 col-md-12 pb-1 news-img">
								<a href="<?php the_permalink(); ?>">
									<?php echo wp_get_attachment_image($image['id'], 'News Image Small', 0, array('class' => 'img-fluid')); ?>
								</a>
							</div>
							<div class="col-9 col-md-12 news-content">
								<h4>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h4>
								<?php the_field('featured_text', $post->ID); ?>
							</div>
						</div>
					</div> 
					
		 			<?php 
		 			
		 			endwhile; 
		 			
		 			wp_reset_query(); 
		 			
		 			?>
	 				
	 				<div id="news-more" class="col-xl-4 mt-2 mt-xl-0">
	 					<div class="subhead">
	 						<h5>School Updates</h5>
	 					</div>
	 					<ul class="fa-ul">
	 					
	 					<?php 

						$args = array(
							'post_type' => 'news', 
							'posts_per_page' => 5,  
							'post__not_in' => $featured_ids
						);
						
						$loop = new WP_Query( $args );

						while ( $loop->have_posts() ) : $loop->the_post();
							if ( get_field('news_post_source', $post->ID ) == 'External' ):
								$link = get_field('external_news_link', $post->ID );
							else: 
								$link = get_permalink();
							endif;
						?>
							<li><span class="fa-li" ><i class="fas fa-chevron-right fa-xs"></i></span>
								<a href="<?php echo $link; ?>" <?php if ( get_field('news_post_source', $post->ID) == 'External' ): ?> target="_blank" <?php endif; ?>><?php the_title(); ?></a>
							</li>
						
						<?php endwhile; wp_reset_query();?>
						
						</ul>
						<small><a href="<?php home_url(); ?>/news">More Updates</a></small>	
	 				</div>
	 			</div>
 			</div>
 			<div class="col-lg-3">
 				<div id="secondary-search">
	 				<form role="search" id="sites-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		 				<label class="sr-only" for="search-text">Search...</label>
		 				<div class="form-group">
		 					<input type="text" class="form-control" placeholder="Search Site..." value="<?php echo get_search_query(); ?>" name="s">
	        			</div>
	 				</form>
				</div>
				<div id="quick-links">
					<div class="row">
					<?php for( $x = 1; $x < 5; $x++ ): ?>
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
	<?php if(get_field('include_video_section')): ?>
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
								<?php $v = substr($video_url, strpos($video_url, "v=") + 2); ?>
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