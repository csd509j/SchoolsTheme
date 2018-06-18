<div id="sidebar-first" class="pull-left">
	<div class="navbar navbar-default" role="navigation">
		<?php 
		
		if ( is_page_template( 'page-parent.php' ) ): ?>
			
			<div class="block-menu">
		
		<?php 
		
		endif;
		// If the page has a parent
		if( $post->post_parent ):
		  	//Get array of post_id's of parents
		  	$parents = get_post_ancestors( $post->ID );
		  	// This is a second level page
		  	if ( empty($parents) || count($parents) == 1 ):
		  		$root_page_id = $parents[0];
		  		$titlenamer = get_the_title($parents[0]);
		  	// This is more than a second level page
		  	else:
		  		$x = $post->ancestors;
		  		end($x);
		  		$root_page_id = prev($x);
		  		$titlenamer = get_the_title($root_page_id);
		  	endif;
		  		
			$walker = new Razorback_Walker_Page_Selective_Children();
			$children = wp_list_pages( array(
			    'title_li' => '',
			    'child_of' => $root_page_id,
			    'walker' => $walker,
			    'echo'	=> 0,
			    'sort_column' => 'post_title'
			));
		// If the page is a top-level parent	
		else:
		
			$children = wp_list_pages( array (
				'title_li' => '',
				'depth' => 1,
				'child_of' => $post->ID,
				'echo' => 0,
				'sort_column' => 'post_title'
			));
			
			$titlenamer = get_the_title($post->ID);
			
		
		endif;
			  
		if ($children): ?>
		
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<i class="fa fa-1x fa-chevron-down"></i>
			</button>
			<span class="visible-xs">
				<h2>
					<span <?php if ( is_page_template( 'page-parent.php' ) ): ?> class="sidebar-parent-title" <?php endif; ?>><a href="<?php the_permalink($root_page_id); ?>"><?php echo $titlenamer; ?></a></span>
				</h2>
			</span>
		</div>
		<h2 class="hidden-xs">
			<span<?php if ( is_page_template( 'page-parent.php' ) ): ?> class="sidebar-parent-title" <?php endif; ?>><a href="<?php the_permalink($root_page_id); ?>"><?php echo $titlenamer; ?></a></span>
		</h2>
		<div class="navbar-collapse collapse sidebar-navbar-collapse">
			<ul class="nav navbar-nav">
		  		
		  		<?php echo $children; ?>
		  		
			</ul>
		</div>		
		
		<?php 
			
		endif; 
		
		if ( is_page_template( 'page-parent.php' ) ): ?>
		
		</div>
		
		<?php endif; ?>
		
	</div>
</div>