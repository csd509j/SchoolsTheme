<?php 
	$id = get_the_ID();
	$args = array( 'post_type' => 'news', 'posts_per_page' => '5', 'post__not_in' => array($id) );
	$loop = new WP_Query( $args );
?>
<div class="row">
	<div class="col-lg-9 pt-1">
		<div class="headline">
			<h3>Featured News</h3>
		</div>
		<div class="news-footer-content">
			<ul class="fa-ul ml-1">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php $image = get_field('featured_image', $post->ID); ?>
					
					<li><span class="fa-li" ><i class="fas fa-chevron-right fa-xs"></i></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>		
			</ul>
		</div>
	</div>
</div>
