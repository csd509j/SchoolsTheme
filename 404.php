<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

get_header(); ?>

<div id="primary" class="content-area pb-2">
	<div class="container">
		<?php get_template_part( 'template-parts/content', 'page-not-found' ); ?>
	</div>
</div>
<?php get_footer(); ?>