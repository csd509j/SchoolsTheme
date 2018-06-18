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
	<section class="carousel-wrap">
		<div class="row">
			<div class="col-md-12 padding-none">
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
								
								<div class="item <?php if ($x == 0): ?>active<?php endif; ?>">
									<?php if (get_field('link', $image['id'])): ?>
										<a href="<?php the_field('link', $image['id']); ?>" class="headline-link">
									<?php endif; ?>
							  		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
							  		<div class="container">
								  		<div class="row">
									  		<div class="col-sm-12">
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
									  		</div>
								  		</div>
							  		</div>
							  		<?php if (get_field('link', $image['id'])): ?>
										</a>
									<?php endif; ?>
								</div>
							<?php 
							
							$x ++;
							
							endforeach; ?>
							
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						
					<?php endif; ?>
				
				</div>
			</div>
		</div>
	</section>
	<!-- Carousel Section End -->
	<!-- News Section Start -->
	<section class="container padding-vertical-two">
		<div class="row">
			<div id="news" class="col-sm-9 col-xs-12">
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
				
					<div class="col-sm-4 col-xs-12 news-item">
						<div class="row">
							<div class="col-sm-12 col-xs-3 padding-bottom-one news-img">
								<a href="<?php the_permalink(); ?>">
									<?php echo wp_get_attachment_image($image['id'], 'News Image Small', 0, array('class' => 'img img-responsive')); ?>
								</a>
							</div>
							<div class="col-sm-12 col-xs-9 news-content">
								<h4>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h4>
								<p><?php the_field('featured_text', $post->ID); ?></p>
							</div>
						</div>
					</div> 
					
		 			<?php 
		 			
		 			endwhile; 
		 			
		 			wp_reset_query(); 
		 			
		 			?>
	 				
	 				<div id="news-more" class="col-sm-4 col-xs-12">
	 					<div class="subhead">
	 						<h5>School Updates</h5>
	 					</div>
	 					<ul>
	 					
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
							<li>
								<a href="<?php echo $link; ?>" <?php if ( get_field('news_post_source', $post->ID) == 'External' ): ?> target="_blank" <?php endif; ?>><?php the_title(); ?></a>
							</li>
						
						<?php endwhile; wp_reset_query();?>
						
						</ul>
						<small><a href="<?php home_url(); ?>/news">More Updates</a></small>	
	 				</div>
	 			</div>
 			</div>
 			<div class="col-sm-3 col-xs-12">
 				<div id="secondary-search">
	 				<form role="search" id="sites-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		 				<label class="sr-only" for="search-text">Search...</label>
		 				<div class="form-group">
		 					<input type="text" class="form-control" placeholder="Search Site..." value="<?php echo get_search_query(); ?>" name="s">
	        			</div>
	 				</form>
				</div>
				<div id="quick-links">
					<ul class="list list-unstyled">
				<?php for( $x = 1; $x < 5; $x++ ): ?>
					<li>
						<?php if ( get_field('home_quick_link_' . $x . '_type') == "External Link" ): ?>
							<a href="<?php the_field('home_quick_link_' . $x . '_link'); ?>" target="_blank" class="btn btn-secondary btn-block btn-lg">
						<?php elseif ( get_field('home_quick_link_' . $x . '_type') == "Media File" ): ?>
							<a href="<?php the_field('home_quick_link_' . $x . '_media'); ?>" target="_blank" class="btn btn-secondary btn-block btn-lg">
						<?php elseif ( get_field('home_quick_link_' . $x . '_type') == "Page" ): ?>
							<a href="<?php the_field('home_quick_link_' . $x . '_page'); ?>" class="btn btn-secondary btn-block btn-lg">
						<?php endif; ?>
						<?php the_field('home_quick_link_' . $x . '_text'); ?>
						</a>
					</li>
				<?php endfor; ?>
					</ul>
				</div>			
 			</div>			
		</div>
	</section>
	<!-- News Section End -->
</div>
<?php get_footer(); ?>