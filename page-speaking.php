<?php

// Setup the speaking page
add_action( 'beans_before_load_document', 'dfh_page_setup' );

function dfh_page_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-speaking' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-padding-remove' );
  beans_remove_action( 'beans_post_title' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_primary' );
  beans_remove_markup( 'beans_post_header' );
  beans_remove_markup( 'beans_post_content' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_markup( 'beans_post' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enque_uikit_speaking' );

function dfh_enque_uikit_speaking() {

  beans_uikit_enqueue_components( array( 'article', 'cover' ) );
  beans_uikit_enqueue_components( array( 'accordion' ), 'add-ons' );

}


// Load Beans
beans_load_document();