<?php 
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
	
	wp_enqueue_script( 'jquery.min.js', get_template_directory_uri() . '/assets/js/jquery-1.11.3.min.js', '', null, true );

	wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery.min.js', null, true );
	
	wp_enqueue_script( 'core.js', get_template_directory_uri() . '/assets/js/core.js', '', null, true );
	
	if ( is_page_template( 'page-calendar.php' ) || is_singular( 'tribe_events' ) || is_singular( 'news' ) || is_singular('tribe_venue') ) {

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
add_image_size('square', 600, 600);
add_image_size('News Image Small', 262, 175);
add_image_size('News Image Medium', 410, 273);
add_image_size('News Image Large', 750, 500);
add_image_size('News Image Featured', 824, 425);
add_image_size('Staff Directory', 326, 453);
add_image_size('Callout Block', 586, 416);
add_image_size('Page Builder Image', 825, 315);
add_image_size('Carousel Image', 1140, 425);

/*
 * Register menus
 *
 * @since CSD Schools 1.0
 */
 
function register_my_menus() {
	
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu' ),
		'header-menu-mobile' => __( 'Header Menu Mobile' ),      
		'header-toplinks' => __( 'Header Top Links Menu' ),
		'footer-topmenu-col-1-1' => __( 'Footer Menu Column 1.1' ),   
		'footer-topmenu-col-1-2' => __( 'Footer Menu Column 1.2' ), 
		'footer-topmenu-col-1-3' => __( 'Footer Menu Column 1.3' ),              
		'footer-topmenu-col-2-1' => __( 'Footer Menu Column 2.1' ),
		'footer-topmenu-col-3-1' => __( 'Footer Menu Column 3.1' ),
		'footer-topmenu-col-3-2' => __( 'Footer Menu Column 3.2' ),
		'footer-topmenu-col-4-1' => __( 'Footer Menu Column 4.1' ),
		'footer-bottommenu' => __( 'Header Bottom Menu' ),
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