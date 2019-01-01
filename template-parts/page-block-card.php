<div class="row pb-2">
	<?php if( get_sub_field('card_image') ): ?>
		<?php $image = get_sub_field('card_image'); ?>
		<div class="col-sm-4 col-md-4">
			<?php echo wp_get_attachment_image($image['id'], 'Square Column 3', 0, array('class' => 'img-fluid w-100 mb-1 mb-sm-0')); ?>
		</div>
	<?php endif; ?>
	<div class="col-sm-8 col-md-8 card-text ">
		<div class="subhead">
			<h3><?php the_sub_field('card_title'); ?></h3>
		</div>
		<?php the_sub_field('card_text'); ?>
			
		<?php if ( get_sub_field('card_links_col_1') ): ?>
			<div class="row">
				<div class="card-links col-md-6"><?php the_sub_field('card_links_col_1'); ?></div>
				<?php if ( get_sub_field('card_links_col_2') ): ?>
					<div class="card-links col-md-6"><?php the_sub_field('card_links_col_2'); ?></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>	
	</div>							
</div>