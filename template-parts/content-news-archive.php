<?php if (get_field('news_post_type') != 'Featured'): ?>
	<?php $link = ( get_field('news_post_source') == 'External' ) ? get_field('external_news_link') : get_permalink(); ?>
	<div class="news-item-list mb-1">
		<div class="row news-item pb-1">
			<div class="col-12">
				<h3 class="news-item-title"><a href="<?php echo $link; ?>" <?php if ( get_field('news_post_source') == 'External' ): ?> target="_blank" <?php endif; ?>><?php the_title(); ?></h3></a>
				<div class="post-meta post-meta-sm">
					<span id="post-date"><?php the_time('F j, Y'); ?></span>
<!-- 					<?php if ( get_field('news_post_source') != 'External' ): ?><span id="post-author"> by <?php the_author(); ?></span><?php endif; ?> -->
					<div class="post-social d-none d-md-flex justify-content-end">
						<div class="addthis_sharing_toolbox"></div>
					</div>
				</div>
				<p class="mb-0"><?php the_field('featured_text', $post->ID); ?></p>
			</div>
		</div>
	</div>
<?php endif; ?>