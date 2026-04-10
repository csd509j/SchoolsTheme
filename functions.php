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
	
	wp_deregister_script( 'jquery' );
	
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', false, null );
	
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'popper.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 'jquery', '', true );
	
	wp_enqueue_script( 'bootstrap.min.js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', 'jquery', '', true );
	
	wp_enqueue_script( 'core.js', get_template_directory_uri() . '/assets/js/core.js', '', null, true );

	wp_enqueue_script( 'js.cookie', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', '', null, true );

	if ( is_singular( 'news' ) ) {

		wp_enqueue_script( 'addthis_widget.js', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56c3954e3471722a' );	
			
	}	
	
}
add_action( 'wp_dashboard_setup', 'hide_plugin_dashboard_meta_boxes' );

function hide_plugin_dashboard_meta_boxes() {
 
 	// Yoast
    remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
    
    remove_meta_box( 'wpseo-wincher-dashboard-overview', 'dashboard', 'normal' );
    
    // Postman
    remove_meta_box( 'example_dashboard_widget', 'dashboard', 'normal' );
    remove_meta_box( 'post_smtp_reports_widget_lite', 'dashboard', 'normal' );

}

/*
 * Add image sizes
 *
 * @since CSD Schools 1.0
 */
 
add_theme_support( 'post-thumbnails' );
add_image_size( 'square', 600, 600, true );
add_image_size( 'Square Column 3', 295, 295, true );
add_image_size( 'Square Column 4', 405, 405, true );
add_image_size( 'News Image Small', 295, 175, true );
add_image_size( 'News Image Medium', 410, 273, true );
add_image_size( 'News Image Large', 750, 500, true );
add_image_size( 'News Image Featured', 600, 356, true );
add_image_size( 'Staff Directory', 326, 453, true );
add_image_size( 'Callout Block', 586, 416, true );
add_image_size( 'Page Builder Image', 945, 315, true );
add_image_size( 'Parent Header', 1600, 314, true );
add_image_size( 'Home Slider', 1600, 500, true );
add_image_size( 'Full Width', 1300 );
add_image_size( 'card', 184, 184, true );
add_image_size( 'Text Block', 530, 640, true );

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
    .post-type-attachment .media-types-required-info, #searchwp_document_content, .compat-field-wpmf_media_selection .wpmfjaoassign_row, .compat-field-wpmf_pdf_embed, #litespeed_meta_boxes, .installer-plugin-update-tr { display:none !important; }
    .post-type-attachment .wp_attachment_image .spinner { width: 0 !important; }
	    
    
    /* 
	** Plugin: ACF-Crop
	*/
	.acf-field-image-crop {
		display: none;
	}
	.acf-escaped-html-notice {
		display: none !important;
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
	acf_add_options_sub_page( 'Alert' );
    acf_add_options_sub_page( '404/Search' );
    acf_add_options_sub_page( 'Google Analytics' );
    acf_add_options_sub_page( 'Monsido' );

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

		$parent_id = get_topmost_parent( $post->ID );
			  				  	
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
* @since CSD Schools 3.7.2
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

add_filter( 'acf/the_field/allow_unsafe_html', function( $allowed, $selector ) {

	return true;

}, 10, 2);

/*
 * Purge Cache
 */

add_action( 'wp_before_admin_bar_render', 'custom_admin_bar_links' );

add_action( 'admin_post_csd_purge_cache', 'csd_handle_purge_cache' );

function custom_admin_bar_links() {

	global $wp_admin_bar;

	$url = wp_nonce_url( admin_url( 'admin-post.php?action=csd_purge_cache' ), 'csd_purge_cache' );

	$wp_admin_bar->add_menu( array(
		'id'    => 'purge_cache',
		'title' => 'Purge Cache',
		'href'  => $url,
		'meta'  => array(
			'class' => 'purge-cache-link',
		),
	) );

}

function csd_handle_purge_cache() {

	if ( ! current_user_can( 'manage_options' ) ) {

		wp_die( 'Unauthorized', 403 );

	}

	check_admin_referer( 'csd_purge_cache' );

	do_action( 'litespeed_purge_all' );

	wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url() );

	exit;

}

/*
 * Emergency Alert Receiver
 *
 * @since CSD Schools 4.0
 */

add_action( 'init', 'csd_emergency_alert_receiver_register_post_type' );

add_action( 'acf/init', 'csd_emergency_alert_receiver_register_acf_fields' );

add_action( 'rest_api_init', 'csd_emergency_alert_receiver_register_routes' );

function csd_emergency_alert_receiver_register_post_type() {

	if ( post_type_exists( 'emergency-alert' ) ) {

		return;

	}

	$labels = array(
		'name' => __( 'Emergency Alerts', 'csdschools' ),
		'singular_name' => __( 'Emergency Alert', 'csdschools' ),
		'add_new_item' => __( 'Add Emergency Alert', 'csdschools' ),
		'edit_item' => __( 'Edit Emergency Alert', 'csdschools' ),
		'new_item' => __( 'New Emergency Alert', 'csdschools' ),
		'view_item' => __( 'View Emergency Alert', 'csdschools' ),
		'search_items' => __( 'Search Emergency Alerts', 'csdschools' ),
		'not_found' => __( 'No emergency alerts found.', 'csdschools' ),
		'not_found_in_trash' => __( 'No emergency alerts found in Trash.', 'csdschools' ),
		'all_items' => __( 'Emergency Alerts', 'csdschools' ),
		'menu_name' => __( 'Emergency Alerts', 'csdschools' ),
	);

	register_post_type( 'emergency-alert', array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => false,
		'show_in_rest' => true,
		'has_archive' => false,
		'rewrite' => false,
		'menu_icon' => 'dashicons-warning',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
	) );

}

function csd_emergency_alert_receiver_register_acf_fields() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {

		return;

	}

	acf_add_local_field_group( array(
		'key' => 'group_csd_emergency_alert_receiver',
		'title' => 'Emergency Alert Fields',
		'fields' => array(
			array(
				'key' => 'field_csd_emergency_alert_title',
				'label' => 'Alert Title',
				'name' => 'alert_title',
				'type' => 'text',
				'required' => 0,
			),
			array(
				'key' => 'field_csd_emergency_alert_sub_title',
				'label' => 'Alert Sub Title',
				'name' => 'alert_sub_title',
				'type' => 'text',
				'required' => 0,
				'default_value' => 'Important News',
			),
			array(
				'key' => 'field_csd_emergency_alert_type',
				'label' => 'Alert Type',
				'name' => 'alert_type',
				'type' => 'select',
				'required' => 0,
				'choices' => array(
					'Default' => 'Default',
					'Pop-up' => 'Pop-up',
					'Both' => 'Both',
				),
				'default_value' => 'Default',
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 1,
				'return_format' => 'value',
			),
			array(
				'key' => 'field_csd_emergency_alert_color',
				'label' => 'Alert Color',
				'name' => 'alert_color',
				'type' => 'select',
				'required' => 0,
				'choices' => array(
					'C36714' => 'Orange',
					'C61723' => 'Red',
				),
				'default_value' => 'C36714',
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'return_format' => 'value',
			),
			array(
				'key' => 'field_csd_emergency_alert_start_time',
				'label' => 'Start Time',
				'name' => 'start_time',
				'type' => 'date_time_picker',
				'required' => 0,
				'display_format' => 'm/d/Y g:i a',
				'return_format' => 'm/d/Y g:i a',
				'first_day' => 1,
			),
			array(
				'key' => 'field_csd_emergency_alert_end_time',
				'label' => 'End Time',
				'name' => 'end_time',
				'type' => 'date_time_picker',
				'required' => 0,
				'display_format' => 'm/d/Y g:i a',
				'return_format' => 'm/d/Y g:i a',
				'first_day' => 1,
			),
			array(
				'key' => 'field_csd_emergency_alert_link_to_post',
				'label' => 'Link To Post',
				'name' => 'link_to_post',
				'type' => 'true_false',
				'required' => 0,
				'default_value' => 0,
				'ui' => 1,
			),
			array(
				'key' => 'field_csd_emergency_alert_link_type',
				'label' => 'Link Type',
				'name' => 'link_type',
				'type' => 'select',
				'required' => 0,
				'choices' => array(
					'Internal' => 'Internal',
					'External' => 'External',
				),
				'default_value' => 'Internal',
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'return_format' => 'value',
			),
			array(
				'key' => 'field_csd_emergency_alert_link',
				'label' => 'Link',
				'name' => 'link',
				'type' => 'url',
				'required' => 0,
			),
			array(
				'key' => 'field_csd_emergency_alert_sites',
				'label' => 'Sites',
				'name' => 'sites',
				'type' => 'textarea',
				'instructions' => 'For manual edits, enter one site name per line.',
				'required' => 0,
				'new_lines' => 'br',
			),
			array(
				'key' => 'field_csd_emergency_alert_image',
				'label' => 'Alert Image',
				'name' => 'alert_image',
				'type' => 'image',
				'required' => 0,
				'return_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array(
				'key' => 'field_csd_emergency_pop_up_image',
				'label' => 'Pop-Up Image',
				'name' => 'pop_up_image',
				'type' => 'image',
				'required' => 0,
				'return_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array(
				'key' => 'field_csd_emergency_alert_image_url',
				'label' => 'Alert Image URL',
				'name' => 'alert_image_url',
				'type' => 'url',
				'required' => 0,
			),
			array(
				'key' => 'field_csd_emergency_pop_up_image_url',
				'label' => 'Pop-Up Image URL',
				'name' => 'pop_up_image_url',
				'type' => 'url',
				'required' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'emergency-alert',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
		'show_in_rest' => 1,
	) );

}

function csd_emergency_alert_receiver_register_routes() {

	register_rest_route( 'csd/v1', '/emergency-alert', array(
		'methods' => WP_REST_Server::CREATABLE,
		'callback' => 'csd_emergency_alert_receiver_handle_webhook',
		'permission_callback' => '__return_true',
	) );

}

function csd_emergency_alert_receiver_handle_webhook( WP_REST_Request $request ) {

	$raw_body = (string) $request->get_body();

	$payload = json_decode( $raw_body, true );

	if ( ! is_array( $payload ) ) {

		return new WP_Error( 'csd_emergency_alert_invalid_payload', 'Invalid JSON payload.', array( 'status' => 400 ) );

	}

	$auth_result = csd_emergency_alert_receiver_validate_signature( $request, $raw_body );

	if ( is_wp_error( $auth_result ) ) {

		return $auth_result;

	}

	$source = ! empty( $payload['source'] ) && is_array( $payload['source'] ) ? $payload['source'] : array();

	$source_post_id = ! empty( $source['post_id'] ) ? (int) $source['post_id'] : 0;

	$source_site_url = ! empty( $source['site_url'] ) ? esc_url_raw( $source['site_url'] ) : '';

	if ( $source_post_id <= 0 || ! $source_site_url ) {

		return new WP_Error( 'csd_emergency_alert_missing_source', 'Missing source details in payload.', array( 'status' => 400 ) );

	}

	if ( ! csd_emergency_alert_receiver_is_allowed_source( $source_site_url ) ) {

		return new WP_Error( 'csd_emergency_alert_forbidden_source', 'Source site is not allowed.', array( 'status' => 403 ) );

	}

	$event = ! empty( $payload['event'] ) ? sanitize_key( $payload['event'] ) : 'upsert';

	if ( ! in_array( $event, array( 'upsert', 'delete' ), true ) ) {

		return new WP_Error( 'csd_emergency_alert_invalid_event', 'Unsupported event type.', array( 'status' => 400 ) );

	}

	$post_id = 0;

	if ( 'delete' === $event ) {

		$post_id = csd_emergency_alert_receiver_delete_post( $payload );

	} else {

		$post_id = csd_emergency_alert_receiver_upsert_post( $payload );

	}

	if ( is_wp_error( $post_id ) ) {

		return $post_id;

	}

	return rest_ensure_response( array(
		'success' => true,
		'event' => $event,
		'local_post_id' => (int) $post_id,
	) );

}

function csd_emergency_alert_receiver_validate_signature( WP_REST_Request $request, $raw_body ) {

	$secret = csd_emergency_alert_receiver_get_secret();

	if ( '' === $secret ) {

		return new WP_Error( 'csd_emergency_alert_missing_secret', 'Webhook secret is not configured.', array( 'status' => 500 ) );

	}

	$timestamp = $request->get_header( 'x-csd-timestamp' );

	$signature = $request->get_header( 'x-csd-signature' );

	if ( ! $timestamp || ! $signature || ! ctype_digit( (string) $timestamp ) ) {

		return new WP_Error( 'csd_emergency_alert_missing_signature', 'Missing or invalid webhook signature headers.', array( 'status' => 401 ) );

	}

	$max_skew = (int) apply_filters( 'csd_emergency_alert_receiver_timestamp_tolerance', 300 );

	$time_diff = abs( time() - (int) $timestamp );

	if ( $time_diff > $max_skew ) {

		return new WP_Error( 'csd_emergency_alert_expired_signature', 'Webhook timestamp is outside the allowed window.', array( 'status' => 401 ) );

	}

	$expected_signature = hash_hmac( 'sha256', $timestamp . '.' . $raw_body, $secret );

	if ( ! hash_equals( $expected_signature, (string) $signature ) ) {

		return new WP_Error( 'csd_emergency_alert_bad_signature', 'Webhook signature validation failed.', array( 'status' => 401 ) );

	}

	return true;

}

function csd_emergency_alert_receiver_get_secret() {

	$secret = '';

	if ( defined( 'CSD_EMERGENCY_ALERT_WEBHOOK_SECRET' ) ) {

		$secret = (string) CSD_EMERGENCY_ALERT_WEBHOOK_SECRET;

	}

	$secret = (string) apply_filters( 'csd_emergency_alert_receiver_secret', $secret );

	return trim( $secret );

}

function csd_emergency_alert_receiver_is_allowed_source( $source_site_url ) {

	$allowed_sources = apply_filters( 'csd_emergency_alert_receiver_allowed_sources', array() );

	if ( ! is_array( $allowed_sources ) || empty( $allowed_sources ) ) {

		return true;

	}

	$normalized_source = untrailingslashit( strtolower( $source_site_url ) );

	foreach ( $allowed_sources as $allowed_source ) {

		$allowed_source = untrailingslashit( strtolower( (string) $allowed_source ) );

		if ( $allowed_source && $allowed_source === $normalized_source ) {

			return true;

		}
	}

	return false;

}

function csd_emergency_alert_receiver_upsert_post( $payload ) {

	if ( ! post_type_exists( 'emergency-alert' ) ) {

		return new WP_Error( 'csd_emergency_alert_missing_post_type', 'The emergency-alert post type is not registered on this site.', array( 'status' => 500 ) );

	}

	$source = ! empty( $payload['source'] ) && is_array( $payload['source'] ) ? $payload['source'] : array();

	$post_data = ! empty( $payload['post'] ) && is_array( $payload['post'] ) ? $payload['post'] : array();

	$source_post_id = ! empty( $source['post_id'] ) ? (int) $source['post_id'] : 0;

	$source_site_url = ! empty( $source['site_url'] ) ? esc_url_raw( $source['site_url'] ) : '';

	$existing_post_id = csd_emergency_alert_receiver_find_local_post( $source_post_id, $source_site_url );

	$local_status = ! empty( $post_data['status'] ) ? sanitize_key( $post_data['status'] ) : 'publish';

	$local_status = in_array( $local_status, array( 'publish', 'future' ), true ) ? 'publish' : 'draft';

	$postarr = array(
		'post_type' => 'emergency-alert',
		'post_status' => $local_status,
		'post_title' => ! empty( $post_data['title'] ) ? wp_strip_all_tags( $post_data['title'] ) : 'Emergency Alert ' . $source_post_id,
		'post_name' => ! empty( $post_data['slug'] ) ? sanitize_title( $post_data['slug'] ) : '',
		'post_content' => ! empty( $post_data['content'] ) ? $post_data['content'] : '',
		'post_excerpt' => ! empty( $post_data['excerpt'] ) ? $post_data['excerpt'] : '',
	);

	if ( $existing_post_id > 0 ) {

		$postarr['ID'] = $existing_post_id;

		$result = wp_update_post( wp_slash( $postarr ), true );

	} else {

		$result = wp_insert_post( wp_slash( $postarr ), true );

	}

	if ( is_wp_error( $result ) ) {

		return $result;

	}

	$local_post_id = (int) $result;

	update_post_meta( $local_post_id, '_csd_source_post_id', $source_post_id );

	update_post_meta( $local_post_id, '_csd_source_site_url', untrailingslashit( $source_site_url ) );

	update_post_meta( $local_post_id, '_csd_last_synced_gmt', current_time( 'mysql', true ) );

	$acf_fields = ! empty( $payload['acf'] ) && is_array( $payload['acf'] ) ? $payload['acf'] : array();

	csd_emergency_alert_receiver_sync_acf_meta( $local_post_id, $acf_fields );

	csd_emergency_alert_receiver_sync_images( $local_post_id, $payload );

	do_action( 'csd_emergency_alert_receiver_synced', $local_post_id, $payload );

	return $local_post_id;

}

function csd_emergency_alert_receiver_delete_post( $payload ) {

	$source = ! empty( $payload['source'] ) && is_array( $payload['source'] ) ? $payload['source'] : array();

	$source_post_id = ! empty( $source['post_id'] ) ? (int) $source['post_id'] : 0;

	$source_site_url = ! empty( $source['site_url'] ) ? esc_url_raw( $source['site_url'] ) : '';

	if ( $source_post_id <= 0 || ! $source_site_url ) {

		return new WP_Error( 'csd_emergency_alert_missing_source', 'Missing source details for delete payload.', array( 'status' => 400 ) );

	}

	$local_post_id = csd_emergency_alert_receiver_find_local_post( $source_post_id, $source_site_url );

	if ( $local_post_id <= 0 ) {

		return 0;

	}

	if ( 'trash' !== get_post_status( $local_post_id ) ) {

		wp_trash_post( $local_post_id );

	}

	do_action( 'csd_emergency_alert_receiver_deleted', $local_post_id, $payload );

	return $local_post_id;

}

function csd_emergency_alert_receiver_find_local_post( $source_post_id, $source_site_url ) {

	$args = array(
		'post_type' => 'emergency-alert',
		'post_status' => 'any',
		'posts_per_page' => 1,
		'fields' => 'ids',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => '_csd_source_post_id',
				'value' => (int) $source_post_id,
				'compare' => '=',
				'type' => 'NUMERIC',
			),
			array(
				'key' => '_csd_source_site_url',
				'value' => untrailingslashit( $source_site_url ),
				'compare' => '=',
			),
		),
	);

	$posts = get_posts( $args );

	return ! empty( $posts ) ? (int) $posts[0] : 0;

}

function csd_emergency_alert_receiver_sync_acf_meta( $post_id, $acf_fields ) {

	$sync_keys = array();

	foreach ( $acf_fields as $field_name => $field_value ) {

		if ( ! is_string( $field_name ) || '' === $field_name || 0 === strpos( $field_name, '_' ) ) {

			continue;

		}

		update_post_meta( $post_id, $field_name, $field_value );

		$sync_keys[] = $field_name;

	}

	$previous_sync_keys = get_post_meta( $post_id, '_csd_synced_acf_keys', true );

	if ( ! is_array( $previous_sync_keys ) ) {

		$previous_sync_keys = array();

	}

	$keys_to_delete = array_diff( $previous_sync_keys, $sync_keys );

	foreach ( $keys_to_delete as $meta_key ) {

		if ( is_string( $meta_key ) && '' !== $meta_key ) {

			delete_post_meta( $post_id, $meta_key );

		}
	}

	update_post_meta( $post_id, '_csd_synced_acf_keys', $sync_keys );

}

function csd_emergency_alert_receiver_sync_images( $post_id, $payload ) {

	$images = ! empty( $payload['images'] ) && is_array( $payload['images'] ) ? $payload['images'] : array();

	$image_map = array(
		'alert_image' => 'alert_image_url',
		'pop_up_image' => 'pop_up_image_url',
	);

	foreach ( $image_map as $field_name => $url_key ) {

		$image_url = ! empty( $images[ $url_key ] ) ? esc_url_raw( $images[ $url_key ] ) : '';

		if ( ! $image_url ) {

			continue;

		}

		$attachment_id = csd_emergency_alert_receiver_import_image( $image_url, $post_id );

		if ( $attachment_id > 0 ) {

			update_post_meta( $post_id, $field_name, $attachment_id );

		}

		update_post_meta( $post_id, $url_key, $image_url );

	}

}

function csd_emergency_alert_receiver_import_image( $image_url, $post_id ) {

	$allow_sideload = (bool) apply_filters( 'csd_emergency_alert_receiver_sideload_images', true, $image_url, $post_id );

	if ( ! $allow_sideload ) {

		return 0;

	}

	$existing = get_posts( array(
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'posts_per_page' => 1,
		'fields' => 'ids',
		'meta_key' => '_csd_source_image_url',
		'meta_value' => $image_url,
	) );

	if ( ! empty( $existing ) ) {

		return (int) $existing[0];

	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$attachment_id = media_sideload_image( $image_url, $post_id, null, 'id' );

	if ( is_wp_error( $attachment_id ) ) {

		error_log( 'Emergency alert image sideload failed: ' . $attachment_id->get_error_message() );

		return 0;

	}

	update_post_meta( (int) $attachment_id, '_csd_source_image_url', $image_url );

	return (int) $attachment_id;

}

add_action( 'csd_emergency_alert_receiver_synced', 'csd_emergency_alert_purge_litespeed_cache' );

add_action( 'csd_emergency_alert_receiver_deleted', 'csd_emergency_alert_purge_litespeed_cache' );

add_action( 'save_post_emergency-alert', 'csd_emergency_alert_purge_litespeed_cache' );

function csd_emergency_alert_purge_litespeed_cache() {

	do_action( 'litespeed_purge_all' );

}

// Enforce persistent language based on cookie
add_action( 'template_redirect', 'preferred_language_check', 0 );

function preferred_language_check() {
    
    if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
    
        return;
    
    }

    // Only proceed if our persistent cookie exists
    if ( isset( $_COOKIE['persistent_wpml_language'] ) ) {
		
		$chosen_lang = $_COOKIE['persistent_wpml_language'];

        // If current page language differs from the cookie
        if ( ICL_LANGUAGE_CODE !== $chosen_lang ) {
          
			// Get the translated URL for the current page
            $translated_url = apply_filters( 'wpml_permalink', get_permalink(), $chosen_lang );

            // Redirect if the URL differs from current request
            if ( $translated_url && $translated_url !== $_SERVER['REQUEST_URI'] ) {
             
                // Set WPML cookie to chosen language for this request
                setcookie( 'wp-wpml_current_language', $chosen_lang, time() + 365*24*60*60, COOKIEPATH, COOKIE_DOMAIN );
                
                $_COOKIE['wp-wpml_current_language'] = $chosen_lang;

                wp_redirect( $translated_url );
                
                exit;
                
            }
        
        }
    
    }

}
