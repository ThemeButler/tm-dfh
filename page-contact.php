<?php

// Setup the contact page
add_action( 'beans_before_load_document', 'dfh_contact_setup' );

function dfh_contact_setup() {

  beans_remove_action( 'beans_post_title' );
  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-contact' );
  beans_add_attribute( 'beans_main_grid', 'class', 'uk-grid-collapse' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enque_uikit_contact' );

function dfh_enque_uikit_contact() {

  beans_uikit_enqueue_components( array( 'article', 'contrast' ) );

}


// Include contact form
function dfh_contact_form() {

  include( get_stylesheet_directory() . '/inc/contact-form.php' );

}


// Output contact form
beans_modify_action_callback( 'beans_loop_template', 'dfh_view_content' );

function dfh_view_content() {

  dfh_contact_form();

}


// Load Beans
beans_load_document();