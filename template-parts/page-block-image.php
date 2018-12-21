<div class="pb-2">

	<?php echo wp_get_attachment_image(get_sub_field('image'), 'Page Builder Image', 0, array('class' => 'img-fluid')); ?>
	<?php if ( get_sub_field('image_caption') ): ?>
		<p class="post-image-caption"><?php the_sub_field('image_caption'); ?></p>		
	<?php endif; ?>

</div>