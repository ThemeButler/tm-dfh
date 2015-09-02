<?php

// Setup the about page
add_action( 'beans_before_load_document', 'dfh_page_setup' );

function dfh_page_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-about' );
  beans_add_attribute( 'beans_main_grid', 'class', 'uk-grid-collapse' );
  beans_add_attribute( 'beans_widget_panel_sidebar_primary_text_text-2', 'class', 'uk-panel-box' );
  beans_add_attribute( 'beans_widget_panel_sidebar_primary_text_text-7', 'class', 'uk-panel-box' );
  beans_add_attribute( 'beans_widget_panel_sidebar_primary_text_text-8', 'class', 'uk-panel-box' );
  beans_remove_markup( 'beans_widget_content_sidebar_primary_text_text-2' );
  beans_remove_markup( 'beans_widget_panel_sidebar_primary_text_text-2' );

}


// Adjust the grid
add_filter( 'beans_layout_grid_settings', 'dfh_modify_grid_settings' );
function dfh_modify_grid_settings( $args ) {

    return array_merge( $args, array(
        'grid' => 10,
        'sidebar_primary' => 5
    ) );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enque_uikit_page' );

function dfh_enque_uikit_page() {

  beans_uikit_enqueue_components( array( 'article', 'cover' ) );
  beans_uikit_enqueue_components( array( 'progress' ), 'add-ons' );

}


// Load Beans
beans_load_document();