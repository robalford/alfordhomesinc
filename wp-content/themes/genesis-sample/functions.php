<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
    // changed this from Lato to Muli
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Muli:300,400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

/* CUSTOM FUNCTIONS FOR ALFORD HOMES WEBSITE BELOW */

// Add custom image size for full width front page
add_image_size('front-page', 2590, 1200, true);

/* Code to Display Featured Image on top of the post */
add_action( 'genesis_before_entry_content', 'featured_post_image', 8 ); //make sure before entry content is the right place for this
function featured_post_image() {
    if ( !is_front_page() && is_singular() ) {
        the_post_thumbnail('large'); //you can use medium, large or a custom size
    }
}

// remove the title from the top of the post
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
// move it to display before content, remove for front page
add_action( 'genesis_entry_content', 'ahi_do_post_title_if_not_front_page', 7 ); // make sure entry content is the right place for this
function ahi_do_post_title_if_not_front_page() {
    if ( !is_front_page() ) {
        genesis_do_post_title();
    }
}
// add fullscreen photo to landing page
add_action( 'genesis_after_header', 'full_featured_image' );
function full_featured_image() {
    if ( is_front_page() ) {
        echo '<div id="full-image">';
        echo the_post_thumbnail('front-page');
        echo '</div>';
    }
}

if (is_front_page()) {
    remove_action('genesis_loop', 'genesis_do_loop');
}

