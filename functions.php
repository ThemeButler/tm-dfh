<?php

// Include Beans
require_once( get_template_directory() . '/lib/init.php' );


// Enqueue child theme assets
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enqueue_uikit_assets', 5 );

function dfh_enqueue_uikit_assets() {

	$less_dir = get_stylesheet_directory() . '/assets/less/';

	// Include uikit overwrite folder
	beans_uikit_enqueue_theme( 'dfh', $less_dir . 'uikit' );

	// Add the theme style as a uikit fragment to have access to all the variables
  beans_compiler_add_fragment( 'uikit', $less_dir . 'style.less', 'less' );

  // Add the theme js as a uikit fragment
  beans_compiler_add_fragment( 'uikit', get_stylesheet_directory() . '/assets/js/theme.min.js', 'js' );

}


// Remove unnecessary classes
add_filter( 'nav_menu_css_class', '__return_false' );


// Dequeue unnecessary uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_home_remove_uikit_components' );

function dfh_home_remove_uikit_components() {

  $components = array(
    'alert',
    'article',
    'breadcrumb',
    'badge',
    'comment',
    'dropdown',
    'pagination',
    'offcanvas',
    'table',
    'subnav',
    'nav'
  );
  beans_uikit_dequeue_components( $components );

}


// Setup theme
add_action( 'beans_before_load_document', 'dfh_setup_theme' );

function dfh_setup_theme() {

  beans_replace_attribute( 'beans_favicon', 'href', 'http://devignerforhire.com/favicon.ico' );
  beans_remove_action( 'beans_comments' );
  beans_remove_action( 'beans_replace_nojs_class' );
  beans_add_attribute( 'beans_site', 'class', 'uk-container uk-container-center' );
  beans_remove_markup( 'beans_fixed_wrap_header' );
  beans_remove_markup( 'beans_site_branding' );
  beans_remove_markup( 'beans_content' );
  beans_add_attribute( 'beans_primary', 'role', 'main' );
  beans_remove_markup( 'beans_fixed_wrap_main' );
  beans_replace_attribute( 'beans_header', 'class', 'uk-block', 'uk-overflow-container uk-margin-large-top' );
  beans_remove_attribute( 'beans_menu_navbar_primary', 'id' );
  beans_replace_attribute( 'beans_menu_navbar_primary', 'class', ' uk-navbar-nav', 'uk-navbar-nav' );
  beans_remove_action( 'beans_site_title_tag' );
  beans_add_attribute( 'beans_site_title_link', 'class', 'tm-logo uk-float-left' );
  beans_add_attribute( 'beans_site_title_tag', 'class', 'tm-tagline uk-float-left' );
  beans_remove_attribute( 'beans_main', 'class', 'uk-block' );
  beans_remove_attribute( 'beans_footer', 'class', 'uk-block' );
  beans_remove_action( 'beans_breadcrumb' );
  beans_modify_action_hook( 'beans_footer', 'beans_main_after_markup' );
  beans_remove_markup( 'beans_fixed_wrap_footer' );
  beans_remove_attribute( 'beans_post', 'id' );

}


// Add footer content
beans_modify_action_callback( 'beans_footer_content', 'dfh_footer' );

function dfh_footer() { ?>

  <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-2 uk-text-small uk-margin-top uk-margin-large-bottom uk-text-muted">
    <div class="tm-copyright">&#169; Chris Rault <?php echo date('Y'); ?>. All rights reserved.</div>
    <div class="tm-credits uk-text-right">Built with <a href="https://getbeans.io" target="_blank" title="Build Smarter with Beans.">Beans</a>. Powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.</div>
  </div>

<? }


// Add footer content
add_action( 'beans_html_before_markup', 'dfh_10up' );

function dfh_10up() { ?>

<!--
     /\__\         /\  \         /\  \
    /:/  /         \:\  \       /::\  \
   /:/  /           \:\  \     /:/\:\__\
  /:/  /  ___   _____\:\  \   /:/ /:/  /
 /:/__/  /\__\ /::::::::\__\ /:/_/:/__/___
 \:\  \ /:/  / \:\~~\~~\/__/ \:\/:::::/  /
  \:\  /:/  /   \:\  \        \::/~~/~~~~
   \:\/:/  /     \:\  \        \:\~~\
    \::/  /       \:\__\        \:\__\
     \/__/         \/__/         \/__/


     #    # ######   ##   #####  #####  ####
#    # #       #  #  #    #   #   #
###### #####  #    # #    #   #    ####
#    # #      ###### #####    #        #
#    # #      #    # #   #    #   #    #
#    # ###### #    # #    #   #    ####


MMMMMMMMZ$MMMMMMMMMM$$$$$$$$$$$$8MMMMMMM
MMMMM$$$$$MMMMMMMN$$$$$$$$$$$$$$$$$MMMMM
MM$$$$$$$$MMMMMM$$$$$$$$$$$$$$$$$$$$MMMM
$$$$$$$$$$MMMMM$$$$$$$$$$$$$$$$$$$$$$DMM
M$$$$$$$$$MMMM$$$$$$$$$$$$$$$$$$$$$$$$MM
MM$$$$$$$$MMM$$$$$$$$MMMMMMMMMM$$$$$$$$M
MM$$$$$$$$MMM$$$$$$$$$MMMMMMMMM$$$$$$$$M
MM$$$$$$$$MMM$$$$$$$$MMMMMMMMMM$$$$$$$$O
MM$$$$$$$$MMM$$$$$$MMMMMMMMMMMM$$$$$$$$8
MM$$$$$$$$MMM$$$$OMMMMMMMMMMMMM$$$$$$$$M
MM$$$$$$$$MMMZ$$MMMMMMMMMMMM$MM$$$$$$$$M
MM$$$$$$$$MMMMDMMMMMMMMMMMM$$$D$$$$$$$MM
MM$$$$$$$$MMMMMMMMMMMMMMM$$$$$$$$$$$$MMM
MM$$$$$$$$MMMMMMMMMMMMMO$$$$$$$$$$$$MMMM
MM$$$$$$$OMMMMMMMMMMMM$$$$$$$$$$$$ZMMMMM
MM$$$$$$MMMMMMMMMMMM8$$$$$$$$$$$MMMMMMMM
MM$$$$MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MM$$$MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MM$MMMMMMMMMMMMIMMMI....MM....M ... DMMM
MMMMMMMMMMMMMM..MMMI....MM....... ....MM
MMMMMMMMMMMM. . MMMI   .MM ....MMM.  ..M
MMMMMMMMMMMM  . MMMI....MM. ..MMMMM . .M
MMMMMMMMMMMM  . MMMI   .MM    MMMMM    M
MMMMMMMMMMMM. ..MMM.....MM.....MMM ....M
MMMMMMMMMMMM  .   .  . .MM  .. .  .   NM
MMMMMMMMMMMMM .    I ...MM....M.. . .MMM
MMMMMMMMMMMMMMMMMMMMMMMMMM ...MMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMM.. .MMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMM....MMMMMMMMMM
-->

<? }


// Add primaray menu search field
beans_add_smart_action( 'beans_primary_menu_append_markup', 'dfh_primary_menu_search' );

function dfh_primary_menu_search() { ?>

  <div class="tm-search uk-visible-large uk-navbar-content" style="display:none;">
    <?php get_search_form(); ?>
  </div>
  <div class="tm-search-toggle uk-visible-large uk-navbar-content uk-display-inline-block uk-contrast">
    <i class="uk-icon-search"></i>
  </div>

<? }


// Set the content width
if ( ! isset( $content_width ) ) $content_width = 880;


// Include cleanup functions
require_once( get_stylesheet_directory() . '/inc/cleanup.php' );

// Include portfolio functions (move to plugin)
require_once( get_stylesheet_directory() . '/admin/portfolio.php' );
