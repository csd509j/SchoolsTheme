<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage CSD
 * @since CSD 1.0
 */
?>
<?php the_title( '<h1>', '</h1>' ); ?>
<?php
// check for rows (parent repeater)
if( have_rows('page_content_blocks') ):
	
	while( have_rows('page_content_blocks') ): the_row(); 
		
		if( get_row_layout() == 'table_of_contents' ):
				
			get_template_part( 'template-parts/page-block', 'table-of-contents' ); 
			
		endif;
		
		if( get_sub_field('lead_text_block') ): ?>
			
			<div class="entry-lead">
				<p class="lead"><?php the_sub_field('lead_text_block'); ?></p>
			</div>			
		
		<?php 
		
		endif;
		
		if( get_row_layout() == 'text_block' ):
		
			echo ( get_sub_field('anchor') ? '<div id="'. get_sub_field('anchor') . '">' : '' ); 
			
			if( get_sub_field('heading') ): ?>
	
				<h2><?php the_sub_field('heading'); ?></h2>
	
			<?php 
			
			endif;
	
			if( get_sub_field('text') ):
			
				the_sub_field('text'); 
				
			endif; 
			
			echo ( get_sub_field('anchor') ? '</div>' : '' ); 
			
		endif; 
		
		if( get_row_layout() == 'image' ): 
		
			get_template_part( 'template-parts/page-block', 'image' );	
					
		endif;

		if( get_row_layout() == 'button_group' ):
		
			echo ( get_sub_field('anchor') ? '<div id="'. get_sub_field('anchor') . '">' : '' );
			
			get_template_part( 'template-parts/page-block', 'button' );
			
			echo ( get_sub_field('anchor') ? '</div>' : '' ); 
			
		endif; 
		
		if ( get_row_layout() == 'page_links'): 
			
			get_template_part( 'template-parts/page-block', 'links' );
							
		endif;
		
		if( get_row_layout() == 'card' ):
		
			echo ( get_sub_field('anchor') ? '<div id="'. get_sub_field('anchor') . '">' : '' );
		
			get_template_part( 'template-parts/page-block', 'card' );
			
			echo ( get_sub_field('anchor') ? '</div>' : '' ); 
		
		endif;
		
		if( get_row_layout() == 'card_vertical' ):
		
			get_template_part( 'template-parts/page-block', 'card-vertical' );
		
		endif;
		
		if( get_sub_field( 'form_select' ) ): 
		
			echo ( get_sub_field('anchor') ? '<div id="'. get_sub_field('anchor') . '">' : '' );
			
			$form_object = get_sub_field('form_select');
			echo do_shortcode('[gravityform id="' . $form_object['id'] . '" title="true" description="true" ajax="true"]');
		
			echo ( get_sub_field('anchor') ? '</div>' : '' );
		
		endif;
		
		if ( get_sub_field ( 'add_directory' ) ): 
			
			get_template_part( 'template-parts/page-block', 'directory' );
		
		endif;
		
		if ( get_row_layout() == "video_embed"): 
			
			get_template_part( 'template-parts/page-block', 'video' );
			
		endif;
		
		if ( get_row_layout() == "table"): 
		
			echo ( get_sub_field('anchor') ? '<div id="'. get_sub_field('anchor') . '">' : '' );
			
			get_template_part( 'template-parts/page-block', 'table' );
			
			echo ( get_sub_field('anchor') ? '</div>' : '' ); 
			
		endif;
		
		if ( get_row_layout() == "divider"): 
			
			get_template_part( 'template-parts/page-block', 'divider' );
			
		endif;	
		
		if ( get_row_layout() == "calendar"): 
			
			get_template_part( 'template-parts/page-block', 'calendar' );
			
		endif;		
				
	endwhile;
	
endif; ?>