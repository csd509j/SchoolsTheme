<?php $image = get_sub_field('image'); ?>
<?php echo wp_get_attachment_image($image['id'], 'Page Builder Image', 0, array('class' => 'img-fluid mb-2')); ?>
<?php if (get_sub_field('image_caption')): ?>
	<p class="post-image-caption"><?php the_sub_field('image_caption'); ?></p>		
<?php endif; ?>
