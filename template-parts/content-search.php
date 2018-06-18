<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage CSD
 * @since CSD 1.0
 */

if ( 'page' === get_post_type() || 'news' === get_post_type() ):
	
	$title = get_the_title();
	
	if( have_rows('page_content_blocks', get_the_ID()) ):
			
		while( have_rows('page_content_blocks') ): the_row(); 
			
			if( get_sub_field('lead_text_block') ): 
				
				$text = get_sub_field('lead_text_block');
			
			endif;
		
		endwhile;
	
	endif;

elseif ( 'attachment' === get_post_type() ):
	
	$icon = '<i class="fa fa-file-text-o"></i>';
	$char = array('-', '_');
	$title = get_the_title();
	$title = str_replace($char, ' ', $title);
				
elseif ( 'tribe_events' === get_post_type() ):
	
	$icon = '<i class="fa fa-calendar"></i>';
	$title = get_the_title() . ' - ' . tribe_get_start_date();

endif;

?>

<div class="search-results">
	<header class="entry-header">
		<h3 class="margin-bottom-none">
			<?php echo $icon; ?>
			<a href="<?php the_permalink(); ?>" <?php if ('attachment' === get_post_type($post)): ?>target="_blank" <?php endif; ?>rel="bookmark"><?php echo $title; ?></a>
		</h3>
	</header><!-- .entry-header -->
	<?php echo $text; ?>
</div><!-- #search-result-## -->

