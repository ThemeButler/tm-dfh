<?php

// Register taxonomies
require_once( get_stylesheet_directory() . '/admin/portfolio-taxonomies.php' );


// Register portfolio post type
add_action( 'init', 'dfh_portfolio_post_type' );

function dfh_portfolio_post_type() {

    $args = array(
      'public' => true,
      'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail' ),
      'menu_icon' => 'dashicons-align-left',
      'label'  => 'Portfolio',
      'rewrite' => array(
        'with_front'=> true
      )
    );
    register_post_type( 'portfolio', $args );

}


// Register portfolio meta
add_action( 'admin_init', 'dfh_portfolio_post_meta' );

function dfh_portfolio_post_meta() {

  $fields = array(
    array(
      'id' => 'portfolio_url',
      'label' => 'Website url',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'portfolio_status',
      'label' => 'Status',
      'type' => 'radio',
      'default' => '',
      'options' => array(
         '0' => 'Offline',
         '1' => 'Online',
         '2' => 'Coming soon'
        )
    ),
    array(
      'id' => 'portfolio_colophon',
      'label' => 'Colophon',
      'type' => 'textarea',
      'default' => ''
    ),
    array(
      'id' => 'portfolio_gallery',
      'label' => 'Gallery',
      'type' => 'image',
      'multiple' => true
    )
  );
  beans_register_post_meta( $fields, array( 'portfolio' ), 'beans', array( 'title' => 'Project Info' ) );

}


// Register client meta
add_action( 'admin_init', 'dfh_portfolio_client_meta' );

function dfh_portfolio_client_meta() {

  $option = array(
    array(
      'id' => 'client_url',
      'label' => 'Website',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'client_location',
      'label' => 'Location',
      'type' => 'text',
      'default' => ''
    )
  );

  beans_register_term_meta( $option, array( 'portfolio_clients' ), 'beans' );

}


// Register partners meta
add_action( 'admin_init', 'dfh_portfolio_partners_meta' );

function dfh_portfolio_partners_meta() {

  $option = array(
    array(
      'id' => 'partner_website',
      'label' => 'Website',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'partner_location',
      'label' => 'Location',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'partner_role',
      'label' => 'Role',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'partner_image',
      'label' => 'Photo',
      'type' => 'image',
      'default' => '',
      'multiple' => false
    )
  );

  beans_register_term_meta( $option, array( 'portfolio_partners' ), 'beans' );

}