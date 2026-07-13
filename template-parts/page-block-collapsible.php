<?php $collapsible_id = 'collapsible-' . get_row_index(); ?>

<div class="collapsible-block mb-2">

	<?php if ( get_sub_field('collapsible_heading') ): ?>

		<h2 class="mb-1"><?php the_sub_field('collapsible_heading'); ?></h2>

	<?php endif; ?>

	<?php if ( have_rows('collapsible_items') ): ?>

		<div id="<?php echo esc_attr( $collapsible_id ); ?>">

			<?php $counter = 0; ?>

			<?php while ( have_rows('collapsible_items') ): the_row(); ?>

				<?php $item_id = $collapsible_id . '-item-' . $counter; ?>

				<div class="collapsible-item">

					<h3 class="mb-0">

						<button class="collapsible-toggle collapsed" type="button" data-toggle="collapse" data-target="#<?php echo esc_attr( $item_id ); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr( $item_id ); ?>" id="<?php echo esc_attr( $item_id ); ?>-toggle">

							<span><?php the_sub_field('item_title'); ?></span>

							<i class="fas fa-chevron-down" aria-hidden="true"></i>

						</button>

					</h3>

					<div id="<?php echo esc_attr( $item_id ); ?>" class="collapse" aria-labelledby="<?php echo esc_attr( $item_id ); ?>-toggle">

						<div class="collapsible-content">

							<?php the_sub_field('item_content'); ?>

						</div>

					</div>

				</div>

				<?php $counter ++; ?>

			<?php endwhile; ?>

		</div>

	<?php endif; ?>

</div>
