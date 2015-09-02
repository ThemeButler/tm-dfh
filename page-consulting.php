<?php

// Setup the consulting page
add_action( 'beans_before_load_document', 'dfh_page_setup' );

function dfh_page_setup() {

  beans_add_attribute( 'beans_main_grid', 'class', 'uk-grid-collapse' );
  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-consulting' );
  beans_remove_attribute( 'beans_primary', 'class' );
  beans_remove_attribute( 'beans_sidebar_secondary', 'class' );
  beans_add_attribute( 'beans_primary', 'class', 'tm-primary uk-width-medium-6-10 uk-width-large-7-10' );
  beans_add_attribute( 'beans_sidebar_secondary', 'class', 'tm-tertiary uk-width-medium-4-10 uk-width-large-3-10' );

}


// adjust grid
add_filter( 'beans_layout_grid_settings', 'dfh_modify_grid_settings' );

function dfh_modify_grid_settings( $args ) {

    return array_merge( $args, array(
        'grid' => 10,
        'sidebar_primary' => 3
    ) );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enque_uikit_consulting' );

function dfh_enque_uikit_consulting() {

  beans_uikit_enqueue_components( array( 'article' ) );

}


// Load Beans
beans_load_document();