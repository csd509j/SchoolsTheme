<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar' )  ) : ?>
	<div class="sidebar">
		<?php get_template_part('template-parts/content','sidenav'); ?>
	</div><!-- .sidebar -->
<?php endif; ?>
