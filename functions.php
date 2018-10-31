<?php 
/*
 * Theme update checker and auto update 
 *
 * @since CSD Schools 1.1
 */
require WP_CONTENT_DIR . '/plugins/plugin-update-checker-master/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/csd509j/SchoolsTheme',
	__FILE__,
	'SchoolsTheme'
);

$myUpdateChecker->setBranch('master'); 

/*
 * Enqueue styles
 *
 * @since CSD Schools 1.0
 */

function csd_enqueue_style() {
	
	wp_enqueue_style( 'print.css', get_template_directory_uri() . '/assets/stylesheets/print.css' ); 
	wp_enqueue_style( 'ie10-viewport-bug-workaround.css', get_template_directory_uri() . '/assets/stylesheets/ie10-viewport-bug-workaround.css' ); 

}
add_action( 'wp_enqueue_scripts', 'csd_enqueue_style', 100 );

/*
 * Enqueue Scripts
 *
 * @since CSD Schools 1.0
 */
 
function csd_enqueue_script() {
	
	wp_deregister_script('jquery');
	
	wp_register_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', false, null);
	
	wp_enqueue_script('jquery');
	
	wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', null, true );
	
	wp_enqueue_script( 'core.js', get_template_directory_uri() . '/assets/js/core.js', '', null, true );
	
	if ( is_singular( 'news' ) ) {

		wp_enqueue_script( 'addthis_widget.js', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56c3954e3471722a' );	
			
	}	
}
add_action( 'wp_enqueue_scripts', 'csd_enqueue_script' );

/*
 * Add image sizes
 *
 * @since CSD Schools 1.0
 */
 
add_theme_support('post-thumbnails');
add_image_size('square', 600, 600, true);
add_image_size('square-md-col-4', 258, 258, true);
add_image_size('square-xs-col-4', 100, 100, true);
add_image_size('News Image Small', 262, 175, true);
add_image_size('News Image Medium', 410, 273, true);
add_image_size('News Image Large', 750, 500, true);
add_image_size('News Image Featured', 824, 425, true);
add_image_size('Staff Directory', 326, 453, true);
add_image_size('Callout Block', 586, 416, true);
add_image_size('Page Builder Image', 825, 315, true);
add_image_size('carousel-lg', 1600, 596, true);
add_image_size('carousel-md', 1140, 425, true);
add_image_size('carousel-sm', 768, 286, true);
add_image_size('card', 184, 184, true);

/*
 * Register menus
 *
 * @since CSD Schools 1.0
 */
 
function register_my_menus() {
	
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu' ),
		'header-toplinks' => __( 'Header Top Links Menu' ),
    ) );
    
}
add_action( 'init', 'register_my_menus' );

/*
 * Register sidebar widget areas
 *
 * @since CSD Schools 1.0
 */
 
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
add_action( 'widgets_init', 'csd_widgets_init' );


/*
 * Custom Wordpress admin css
 *
 * @since CSD Schools 1.0
 */
function custom_admin_css() {
  echo '<style>
    #wp-admin-bar-wpfc-toolbar-parent > .ab-empty-item::before { content: ""; padding: 0; margin:0; }
    .installer-plugin-update-tr { display:none; }
  </style>';
}
add_action('admin_head', 'custom_admin_css');

/*
 * Setup custom excerpt length
 *
 * @since CSD Schools 1.0
 */
 
function custom_excerpt_length( $length ) {
	
	return 10;

}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*
 * Remove excerpt more label
 *
 * @since CSD Schools 1.0
 */
 
function new_excerpt_more( $more ) {
	
	return '';

}
add_filter('excerpt_more', 'new_excerpt_more');

/*
 * Custom pagination function
 *
 * @since CSD Schools 1.2.6
 */
function show_pagination_links()
{
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
			'prev_text'    => __('&lsaquo; Previous', 'progression'),
			'next_text'    => __('Next &rsaquo;', 'progression'),
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
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
if( function_exists('acf_add_options_sub_page') ) {
    acf_add_options_sub_page( 'General' );
    acf_add_options_sub_page( 'Pages' );
    acf_add_options_sub_page( 'Calendar' );
    acf_add_options_sub_page( 'Footer' );
    acf_add_options_sub_page( '404 Page' );
    acf_add_options_sub_page( 'District Info' );
    acf_add_options_sub_page( 'Google Analytics' );
}

/**
 * Load sidebar select fields with callout blocks from options
 *
 * @since CSD Schools 1.0
 */
function acf_load_sidebar_callout_blocks_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();

    // if has rows
    if( have_rows('callout_blocks', 'option') ) {
        
        // while has rows
        while( have_rows('callout_blocks', 'option') ) {
            
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
add_filter('acf/load_field/name=sidebar_callout_blocks', 'acf_load_sidebar_callout_blocks_field_choices');

/**
 * Load sidebar select fields with contact blocks from options
 *
 * @since CSD Schools 1.0
 */
function acf_load_sidebar_contact_blocks_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();

    // if has rows
    if( have_rows('contact_blocks', 'option') ) {
        
        // while has rows
        while( have_rows('contact_blocks', 'option') ) {
            
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
add_filter('acf/load_field/name=sidebar_contact_block', 'acf_load_sidebar_contact_blocks_field_choices');

/**
 * Set featured image from ACF field
 *
 * @since CSD Schools 1.0
 */
function acf_set_featured_image( $value, $post_id, $field  ){
	
	$id = $value;
	
	if( ! is_numeric( $id ) ){
		
		$data = json_decode( stripcslashes($id), true );
		$id = $data['cropped_image'];
	
	}
	
	update_post_meta( $post_id, '_thumbnail_id', $id );
	
	return $value;
}
add_filter( 'acf/update_value/name=featured_image', 'acf_set_featured_image', 10, 3 );

/**
 * Language toggle button
 *
 * @since CSD Schools 1.4.5
 */
function languages_toggle(){
/*
	global $wp;
	$url = $wp->request;
  	$languages = icl_get_languages('skip_missing=1');
*/
  	
  	$google_languages = array(
	  	'googtrans(en|es)' => 'Spanish',
	  	'googtrans(en|ar)' => 'ترجمه',
	  	'googtrans(en|zh-CN)' => 'Chinese',
	  	'googtrans(en|fr)' => 'French',
	  	'googtrans(en|de)' => 'German',
	  	'googtrans(en|ko)' => 'Korean',
	  	'googtrans(en|vi)' => 'Vietnamese'
  	);
  	
/*
	if(1 < count($languages)){
		foreach($languages as $l) {
			if($l['active']) {
				$active = $l['native_name'];
			}
		}
	} else {
*/
		if(strpos($url, "#") === false) {
			$active = "English";
		} else {
			$key = explode("#", $url)[0];
			$active = $google_languages[$key];
		}		
// 	}
	?>

  	<div class="translated-btn">
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				<i class="fa fa-comment"></i> Translate <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
<!--
			<?php if(1 < count($languages)): ?>
				<?php foreach($languages as $l): ?>
					<?php if(!$l['active']): ?>
						<li><a href="<?php echo $l['url']; ?>"><?php echo $l['translated_name']; ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
-->
			
			<?php foreach($google_languages as $key => $val): ?>
				<li><a href="<?php echo home_url(); ?>/#<?php echo $key; ?>" target="_blank"><?php echo $val; ?></a></li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
	
<?php
}