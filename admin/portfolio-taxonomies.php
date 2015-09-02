<?php

// Register client taxonomy
add_action( 'init', 'dfh_portfolio_project_type_taxonomy' );

function dfh_portfolio_project_type_taxonomy() {
  register_taxonomy(
    'portfolio_project_types',
    'portfolio',
    array(
      'label' => 'Types',
      'rewrite' => array( 'slug' => 'type' ),
      'hierarchical' => true,
    )
  );
}


// Register skills taxonomy
add_action( 'init', 'dfh_portfolio_skills_taxonomy' );

function dfh_portfolio_skills_taxonomy() {
  register_taxonomy(
    'portfolio_skills',
    'portfolio',
    array(
      'label' => 'Skills',
      'rewrite' => array( 'slug' => 'skill' ),
      'hierarchical' => false,
    )
  );
}


// Register client taxonomy
add_action( 'init', 'dfh_portfolio_partners_taxonomy' );

function dfh_portfolio_partners_taxonomy() {
  register_taxonomy(
    'portfolio_partners',
    'portfolio',
    array(
      'label' => 'Partners',
      'rewrite' => array( 'slug' => 'partner' ),
      'hierarchical' => false,
    )
  );
}


// Register client taxonomy
add_action( 'init', 'dfh_portfolio_clients_taxonomy' );

function dfh_portfolio_clients_taxonomy() {
  register_taxonomy(
    'portfolio_clients',
    'portfolio',
    array(
      'label' => 'Clients',
      'rewrite' => array( 'slug' => 'client' ),
      'hierarchical' => false,
    )
  );
}


// Register keyword taxonomy
add_action( 'init', 'dfh_portfolio_tags_taxonomy' );

function dfh_portfolio_tags_taxonomy() {
  register_taxonomy(
    'portfolio_tags',
    'portfolio',
    array(
      'label' => 'Tags',
      'rewrite' => array( 'slug' => 'tag' ),
      'hierarchical' => false,
    )
  );
}