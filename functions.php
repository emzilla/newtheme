<?php
/**
 * Theme Functions
 *
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */


function custom_setup() {

  // launching operation cleanup
  add_action( 'init', 'head_cleanup' );
  // remove WP version from RSS
  add_filter( 'the_generator', 'rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'gallery_style' );
  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'scripts_and_styles', 999 );
  // launching this stuff after theme setup
  theme_setup();
  // adding sidebars to Wordpress (these are created in functions.php)
  // add_action( 'widgets_init', 'theme_widgets_init' );
  
}

// let's get this party started
add_action( 'after_setup_theme', 'custom_setup' );


/* Register widget area. (If needed)
------------------------------------------------------------------------ */

function theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.'),
	) );
}

/* Extras
------------------------------------------------------------------------ */
function head_cleanup() {
  remove_action( 'wp_head', 'rsd_link' );
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // index link
  remove_action( 'wp_head', 'index_rel_link' );
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version
  remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );

}

// remove WP version from RSS
function rss_version() { return ''; }

// remove WP version from scripts
function remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}

// remove injected CSS for recent comments widget
function remove_wp_widget_recent_comments_style() {
  if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
    remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
  }
}

// remove injected CSS from recent comments widget
function remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

// remove injected CSS from gallery
function gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

// remove admin bar
add_filter('show_admin_bar', '__return_false');


/* Enqueue scripts and styles.
------------------------------------------------------------------------ */

function scripts_and_styles() {

	// Enqueue Styles
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Register Styles
	wp_register_style( 'newtheme-stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array(), '', 'all' );

	// Register Scripts
	wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/js/vendors/modernizr.js', array( 'jquery' ), '', false );

	//For Production
	wp_register_script( 'sitejs', get_stylesheet_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), '', true );

	wp_register_script( 'classie', get_stylesheet_directory_uri() . '/js/vendors/classie.js', array( 'jquery' ), '', true );

	wp_register_script( 'sidebar-effects', get_stylesheet_directory_uri() . '/js/vendors/sidebar-effects.js', array( 'jquery', 'classie' ), '', true );

	wp_register_script( 'custom-scripts', get_stylesheet_directory_uri() . '/js/init.js', array( 'jquery' ), '', true );

	wp_localize_script( 'theme-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu' ) . '</span>',
	) );

	// enqueue styles and scripts
	wp_enqueue_style( 'newtheme-stylesheet' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'classie' );
	wp_enqueue_script( 'sidebar-effects' );
	wp_enqueue_script( 'custom-scripts' );

}


/* Accessibility
------------------------------------------------------------------------ */

// Add a `screen-reader-text` class to the search form's submit button.
function theme_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'theme_search_form_modify' );


/* Theme Setup
------------------------------------------------------------------------ */

function theme_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	// set_post_thumbnail_size( 825, 510, true );

	// wp custom background (thx to @bransonwerner for update)
	  add_theme_support( 'custom-background',
	      array(
	      'default-image' => '',    // background image default
	      'default-color' => '',    // background color default (dont add the #)
	      'wp-head-callback' => '_custom_background_cb',
	      'admin-head-callback' => '',
	      'admin-preview-callback' => ''
	      )
	  );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu' ),
		'utility' => __( 'Utility Menu' ),
		'footer'  => __( 'Footer Menu' ),
		'social'  => __( 'Social Links Menu' ),
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	
	) );

}


/* Custom Functions
------------------------------------------------------------------------ */

// Custom Excerpts

function excerpt($limit) {
	 $excerpt = explode(' ', get_the_excerpt(), $limit);
	 if (count($excerpt)>=$limit) {
	 array_pop($excerpt);
	 $excerpt = implode(" ",$excerpt).'...';
	 } else {
	 $excerpt = implode(" ",$excerpt);
	 }
	 $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	 return $excerpt;
	}

	function content($limit) {
	 $content = explode(' ', get_the_content(), $limit);
	 if (count($content)>=$limit) {
	 array_pop($content);
	 $content = implode(" ",$content).'...';
	 } else {
	 $content = implode(" ",$content);
	 }
	 $content = preg_replace('/[.+]/','', $content);
	 $content = apply_filters('the_content', $content);
	 $content = str_replace(']]>', ']]&gt;', $content);
	 return $content;
}

// Pagination

function numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination"><ul class="menu">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}



