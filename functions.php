<?php 
/*
 * Enqueue styles
 *
 * @since CSD Schools 2.0
 */

add_action( 'wp_enqueue_scripts', 'csd_enqueue_style', 100 );

function csd_enqueue_style() {
	
	wp_enqueue_style( 'csd-fonts', 'https://use.typekit.net/iqq6yaa.css' );
	
	wp_enqueue_style( 'print.css', get_template_directory_uri() . '/assets/stylesheets/print.css' ); 
	
	wp_enqueue_style( 'font-awesome-5', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css' ); 
	
}

/*
 * Enqueue Scripts
 *
 * @since CSD Schools 2.0
 */

add_action( 'wp_enqueue_scripts', 'csd_enqueue_script' );

function csd_enqueue_script() {
	
	wp_deregister_script('jquery');
	
	wp_register_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', false, null);
	
	wp_enqueue_script('jquery');
	
	wp_enqueue_script( 'popper.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 'jquery', '', true );
	
	wp_enqueue_script( 'bootstrap.min.js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', 'jquery', '', true );
	
	wp_enqueue_script( 'core.js', get_template_directory_uri() . '/assets/js/core.js', '', null, true );

	wp_enqueue_script( 'js.cookie', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', '', null, true );

	if ( is_singular( 'news' ) ) {

		wp_enqueue_script( 'addthis_widget.js', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56c3954e3471722a' );	
			
	}	
	
}

/*
 * Add image sizes
 *
 * @since CSD Schools 1.0
 */
 
add_theme_support('post-thumbnails');
add_image_size('square', 600, 600, true);
add_image_size('Square Column 3', 295, 295, true);
add_image_size('Square Column 4', 405, 405, true);
add_image_size('News Image Small', 295, 175, true);
add_image_size('News Image Medium', 410, 273, true);
add_image_size('News Image Large', 750, 500, true);
add_image_size('News Image Featured', 600, 356, true);
add_image_size('Staff Directory', 326, 453, true);
add_image_size('Callout Block', 586, 416, true);
add_image_size('Page Builder Image', 945, 315, true);
add_image_size('Parent Header', 1600, 314, true);
add_image_size('Home Slider', 1600, 500, true);
add_image_size('Full Width', 1300);
add_image_size('card', 184, 184, true);
add_image_size('Text Block', 530, 640, true);

/*
 * Register menus
 *
 * @since CSD Schools 1.0
 */

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu' ),
		'header-toplinks' => __( 'Header Top Links Menu' ),
    ) );
    
}

/*
 * Register sidebar widget areas
 *
 * @since CSD Schools 1.0
 */

add_action( 'widgets_init', 'csd_widgets_init' );

function csd_widgets_init() {
	
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'csd' ),
        'id' => 'sidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'csd' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Calendar - Home', 'csd' ),
        'id' => 'home_calendar',
        'description' => __( 'Widget area for calendar events on home page.', 'csd' ),

    ) );
    
}

/*
 * Custom Wordpress admin css
 *
 * @since CSD Schools 1.0
 */

add_action('admin_head', 'custom_admin_css');

function custom_admin_css() {
  echo '<style>
    #wp-admin-bar-wpfc-toolbar-parent > .ab-empty-item::before { content: ""; padding: 0; margin:0; }
    .installer-plugin-update-tr { display:none; }
    
    
    /* 
	** Plugin: ACF-Crop
	*/
	.acf-field-image-crop {
		display: none;
	}
  </style>';
}

/*
 * Setup custom excerpt length
 *
 * @since CSD Schools 1.0
 */

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_length( $length ) {
	
	return 10;

}

/*
 * Remove excerpt more label
 *
 * @since CSD Schools 1.0
 */

add_filter('excerpt_more', 'new_excerpt_more');

function new_excerpt_more( $more ) {
	
	return '';

}

/*
 * Custom pagination function
 *
 * @since CSD Schools 1.2.6
 */
 
function show_pagination_links() {
   
	global $wp_query;

	$page_tot   = $wp_query->max_num_pages;
	$page_cur   = get_query_var( 'paged' );
	$big        = 999999999;
	
	if ( $page_tot == 1 ) return;
	
	echo paginate_links( array(
	        'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
	        'format'    => '?paged=%#%',
	        'current'   => max( 1, $page_cur ),
	        'total'     => $page_tot,
	        'prev_next' => true,
			'prev_text'    => __('&lsaquo; Previous', 'csdschools'),
			'next_text'    => __('Next &rsaquo;', 'csdschools'),
	        'end_size'  => 1,
	        'mid_size'  => 2,
	        'type'      => 'list'
	    )
	);
	
}

/**
 * Add option menus
 *
 * @since CSD Schools 1.0
 */

if ( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

if ( function_exists('acf_add_options_sub_page') ) {
    
    acf_add_options_sub_page( 'General' );
    acf_add_options_sub_page( 'Pages' );
    acf_add_options_sub_page( 'Quick Links' );
    acf_add_options_sub_page( 'Calendar' );
    acf_add_options_sub_page( 'Footer' );
    acf_add_options_sub_page( '404/Search' );
    acf_add_options_sub_page( 'Google Analytics' );

}

/**
 * Add ACF JSON
 *
 * @since CSD Schools 1.7.1
 */

add_filter( 'acf/settings/save_json', function() {

	return get_stylesheet_directory() . '/acf-json';

} );

add_filter( 'acf/settings/load_json', function( $paths ) {
	
	$paths = array();

	if ( is_child_theme() ) {
		
		$paths[] = get_stylesheet_directory() . '/acf-json';
		
	}
	
	$paths[] = get_template_directory() . '/acf-json';
	
	return $paths;
	
} );

/**
 * Load sidebar select fields with callout blocks from options
 *
 * @since CSD Schools 1.0
 */

add_filter('acf/load_field/name=sidebar_callout_blocks', 'acf_load_sidebar_callout_blocks_field_choices');

function acf_load_sidebar_callout_blocks_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();

    // if has rows
    if ( have_rows('callout_blocks', 'option') ) {
        
        // while has rows
        while ( have_rows('callout_blocks', 'option') ) {
            
            // instantiate row
            the_row();
            
            // vars
            $value = get_sub_field('callout_block_heading');
            $label = get_sub_field('callout_block_heading');

            
            // append to choices
            $field['choices'][ $value ] = $label;
            
        }
        
    }

    // return the field
    return $field;
    
} 


/**
 * Load sidebar select fields with contact blocks from options
 *
 * @since CSD Schools 1.0
 */

add_filter('acf/load_field/name=sidebar_contact_block', 'acf_load_sidebar_contact_blocks_field_choices');

function acf_load_sidebar_contact_blocks_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();

    // if has rows
    if ( have_rows('contact_blocks', 'option') ) {
        
        // while has rows
        while ( have_rows('contact_blocks', 'option') ) {
            
            // instantiate row
            the_row();
            
            // vars
            $value = get_sub_field('contact_name');
            $label = get_sub_field('contact_name');

            
            // append to choices
            $field['choices'][ $value ] = $label;
            
        }
        
    }

    // return the field
    return $field;
    
} 

/**
 * Set featured image from ACF field
 *
 * @since CSD Schools 1.0
 * @updated CSD Schools 3.1.9
 */
 
add_filter( 'acf/update_value/name=featured_img', 'acf_set_featured_image', 10, 3 );

function acf_set_featured_image( $value, $post_id, $field  ){
	
	update_post_meta( $post_id, '_thumbnail_id', $value );
	
	return $value;
	
}

/**
 * Helper function to help migrate away from ACF-Crop
 *
 * @since CSD Schools 3.1.3
 */

function get_string_between( $string, $start, $end ) {
	
	$string = ' ' . $string;
	$ini = strpos($string, $start);
	
	if ( $ini == 0 ) return '';
	
	$ini += strlen($start);
	$len = strpos($string, $end, $ini) - $ini;
	
	return substr($string, $ini, $len);

}

/**
* Get pages for full-width subnav
*
* @since CSD Schools 3.6.9
*/

function get_full_width_children_pages( $post ) {
	
	if ( $post->post_parent ) {
		
		$parent_id = get_topmost_parent($post->id);
			  				  	
		$children = wp_list_pages( array(
		    'title_li' => '',
		    'child_of' => $parent_id,
		    'echo'	=> 0,
		    'sort_column' => 'post_title',
		));
		
	} else {
		
		$parent_id = $post->ID;
		
		$children = wp_list_pages( array (
			'title_li' => '',
			'depth' => 1,
			'child_of' => $post->ID,
			'echo' => 0,
			'sort_column' => 'post_title',
		));
		
	}

	if ( $children ) {
		
		$pages = array(
			'parent' => $parent_id,
			'children' => $children,
		);
		
		return($pages);
		
	} else {
		
		return false;
		
	}
	
}

/**
* Return calendars from CSD API
*
* @since CSD Schools 3.7.1
*/

function get_calendars() {

	$response = wp_remote_get( 'https://www.csd509j.net/wp-json/acf/v3/options/options/calendar_downloads' );

	if ( is_wp_error( $response ) ) {
		
		return;
	}

	$all_calendars = json_decode( wp_remote_retrieve_body( $response ) );
	
	$school_calendars = array();
	
	$school_type = get_field('school_type', 'options');

	foreach ( $all_calendars->calendar_downloads as $calendar ) {

		if ( $calendar->grade_level == $school_type || $calendar->grade_level == 'All Grades' ) {

			$school_calendars[] = array( 'name' => $calendar->calendar_name, 'url' => $calendar->calendar_file );
			
		}
		
	}

	return $school_calendars;
	
}

/**
* Return Alerts from CSD API
*
* @since CSD Schools 3.8.4
*/

function get_alerts() {
	
	$response = wp_remote_get( 'https://www.csd509j.net/wp-json/acf/v3/emergency-alert/', array( 'sslverify' => false ) );

	if ( is_wp_error( $response ) ) {
		
		return;
	}
	
	$alerts = json_decode( wp_remote_retrieve_body( $response ), true );

	foreach( $alerts as $alert ) {
		
		if ( isset( $alert['acf']['sites'] ) ) {
			
			if ( in_array( get_bloginfo( 'name' ), $alert['acf']['sites'] ) ) {
				
				$tz = new DateTimeZone( 'America/Los_Angeles' );
				
				$date_now = new DateTime();
				
				$date_now->setTimezone( $tz );
				
				$start = new DateTime( $alert['acf']['start_time'] );
				
				$start->setTimezone( $tz );
				
				$end = new DateTime( $alert['acf']['end_time'] );
				
				$end->setTimezone( $tz );
				
				if ( $start->format('Y-m-d H:i:s') <= $date_now->format('Y-m-d H:i:s') && $end->format('Y-m-d H:i:s') >= $date_now->format('Y-m-d H:i:s') ) {
					
					wp_cache_set( 'alert', $alert );
					
					return ( $alert );
				
				}
				
			}
			
		}
			
	}
	
	return false;
		
}

// Add search weight to more recently published entries in SearchWP.
add_filter( 'searchwp\query\mods', function( $mods ) {
	global $wpdb;

	$mod = new \SearchWP\Mod();
	$mod->set_local_table( $wpdb->posts );
	$mod->on( 'ID', [ 'column' => 'id' ] );
	$mod->relevance( function( $runtime ) use ( $wpdb ) {
		return "
			COALESCE( ROUND( ( (
				UNIX_TIMESTAMP( {$runtime->get_local_table_alias()}.post_date )
				- (
					SELECT UNIX_TIMESTAMP( {$wpdb->posts}.post_date )
					FROM {$wpdb->posts}
					WHERE {$wpdb->posts}.post_status = 'publish'
					ORDER BY {$wpdb->posts}.post_date ASC
					LIMIT 1
				)
			) / 86400 ), 0 ), 0 )";
	} );

	$mods[] = $mod;

	return $mods;
} );