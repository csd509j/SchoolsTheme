<div class="row padding-top-two">
	<div class="col-sm-12">
		<div class="headline">
			<h3>Featured News</h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<ul>
	<?php 
	$id = get_the_ID();
	$args = array( 'post_type' => 'news', 'posts_per_page' => '5', 'post__not_in' => array($id)  );
	$loop = new WP_Query( $args );
	
	while ( $loop->have_posts() ) : $loop->the_post();
		
		$image = get_field('featured_image', $post->ID); ?>
			
			<li>
				<div class="news-content">
					<h4>
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h4>
				</div> 
			</li>
			
	<?php endwhile; wp_reset_query(); ?>		
		</ul>
	</div>
</div>
