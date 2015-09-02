<?php

// Clean up head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );


// Remove editor filters
remove_filter('term_description','wpautop');
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
remove_filter('the_title', 'wptexturize');


// Unregister all unnecessary widgets
add_action('widgets_init', 'dfh_unregister_default_widgets', 11);

function dfh_unregister_default_widgets() {

  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Nav_Menu_Widget');
  unregister_widget('Akismet_Widget');

}

// Remove offcanvas support
remove_theme_support( 'offcanvas-menu' );


// Enable svg support
add_filter('upload_mimes', 'dfh_svg_mime_type');

function dfh_svg_mime_type($mimes) {

  $mimes['svg'] = 'image/svg+xml';
  return $mimes;

}


// Remove emojis
add_action( 'init', 'dfh_disable_wp_emojicons' );

function dfh_disable_wp_emojicons() {

  // All actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // Filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );

}

// Disable emojis in the editor
function disable_emojicons_tinymce( $plugins ) {

  if ( is_array( $plugins ) ) {

    return array_diff( $plugins, array( 'wpemoji' ) );

  } else {

    return array();

  }

}


// Remove comments on pages
add_action( 'init', 'dfh_remove_page_comments' );

function dfh_remove_page_comments() {

  remove_post_type_support( 'page', 'comments' );

}


// Remove type attribute from scripts tag
add_filter( 'script_loader_tag', 'dfh_remove_script_type_attribute' );

function dfh_remove_script_type_attribute( $script ) {

  return str_replace( "type='text/javascript' ", '', $script );

}


// Remove type attribute from style tag
add_filter( 'style_loader_tag', 'dfh_remove_style_type_attribute' );

function dfh_remove_style_type_attribute( $style ) {

  $style = preg_replace( "# id='.*?' #", '', $style );
  return str_replace( " type='text/css'", '', $style );

}