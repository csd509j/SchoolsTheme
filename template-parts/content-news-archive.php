<?php

$image = get_field('featured_image', $post->ID);

if ( get_field('news_post_source') == 'External' ):
	$link = get_field('external_news_link');
else: 
	$link = get_permalink();
endif;

?>
<div class="news-item-list margin-bottom-one">
	<div class="row news-item padding-bottom-one">
		<div class="col-sm-12">
			<a href="<?php echo $link; ?>" <?php if ( get_field('news_post_source') == 'External' ): ?> target="_blank" <?php endif; ?>>
				<h3 class="news-item-title"><?php the_title(); ?></h3>
			</a>
			<div class="post-meta post-meta-sm">
				<span id="post-date"><?php the_time('F j, Y'); ?>,</span>
				<?php if ( get_field('news_post_source') != 'External' ): ?><span id="post-author"> by <?php the_author(); ?></span><?php endif; ?>
				<div class="post-social pull-right  hidden-xs">
					<div class="addthis_sharing_toolbox"></div>
				</div>
			</div>
			<p class="margin-bottom-none"><?php the_field('featured_text', $post->ID); ?></p>
		</div>
	</div>
</div>