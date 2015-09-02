<?php

// Setup the random facts page
add_action( 'beans_before_load_document', 'dfh_page_setup' );

function dfh_page_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-random' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enque_uikit_page' );

function dfh_enque_uikit_page() {

  beans_uikit_enqueue_components( array( 'article' ) );

}


// Load Beans
beans_load_document();