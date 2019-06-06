<?php
/**
 * The template used for displaying directory profile content
 *
 * @package WordPress
 * @subpackage CSD
 * @since CSD 1.0
 */
 
 $image = get_field( 'profile_image' );
?>
<h1 class="mb-1"><?php _e('Staff Profile','csdschools'); ?></h1>
<div class="entry-content">
	<div class="row">
		<div class="col-5 col-sm-3">
			
			<?php echo wp_get_attachment_image($image['id'], 'Staff Directory', 0, array('class' => 'img-fluid')); ?>
			
			<div class="profile-meta pt-1">
				<div class="subsection d-none d-sm-block">
					<h3><?php the_title(); ?></h3>
				</div>
				<div class="sub-meta d-none d-sm-block">
					<p>
						<i class="fa fa-envelope"></i> <a href="mailto:<?php the_field( 'email' ); ?>"><?php _e('Email','csdschools'); ?> <?php the_title(); ?></a><br>
						<i class="fa fa-phone"></i> <?php the_field( 'phone' ) ; ?>
					</p>
				</div>
				
			</div>
		</div>
		<div class="col-7 d-block d-sm-none">
			<div class="subsection">
				<h3><?php the_title(); ?></h3>
				<div class="sub-meta">
					<a class="btn btn-primary btn-block my-1" href="mailto:<?php the_field( 'email' ); ?>"><i class="fa fa-envelope"></i> <?php _e('Email','csdschools'); ?></a> <a class="btn btn-secondary btn-block" href="tel:<?php the_field( 'phone' ) ; ?>"><i class="fa fa-phone"></i> <?php _e('Call','csdschools'); ?></a>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-9">
			<div class="bg-light"><?php the_field( 'bio' ); ?></div>	
		</div>
	</div>
</div><!-- .entry-content -->