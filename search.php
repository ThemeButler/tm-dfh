<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'dfh_search_setup' );

function dfh_search_setup() {

  beans_remove_markup( 'beans_grid' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_post_header' );
  beans_remove_markup( 'beans_post_content' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_action( 'beans_post_navigation' );
  beans_remove_action( 'beans_post_image' );
  beans_modify_action_hook( 'beans_posts_pagination', 'beans_primary_after_markup' );
  beans_replace_attribute( 'beans_primary', 'class', 'tm-primary uk-width-medium-4-4', 'tm-search uk-list uk-list-striped' );
  beans_modify_markup( 'beans_primary', 'ol' );
  beans_modify_markup( 'beans_post', 'li' );
  beans_remove_attribute( 'beans_post', 'id' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_remove_attribute( 'beans_post_title', 'class' );
  beans_add_attribute( 'beans_search_form_input', 'class', 'uk-form-large' );
  beans_modify_action_hook( 'beans_post_search_title', 'beans_primary_before_markup' );
  beans_remove_attribute( 'beans_search_title', 'class', 'uk-article-title' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enque_uikit_search' );

function dfh_enque_uikit_search() {

    beans_uikit_enqueue_components( array( 'list', 'badge', 'text', 'pagination' ) );

}


// Remove the categories prefix
add_filter( 'beans_search_title_text_output', 'dfh_search_title' );

function dfh_search_title() {

  return 'Results for: ';

}


// Add the search form
add_action( "beans_primary_before_markup", "dfh_add_search_form" );

function dfh_add_search_form() { ?>

    <div class="tm-search-form tm-box tm-box4">
      <?php echo get_search_form(); ?>
    </div>

<?php }


// Set the excerpt and readon link
add_filter( 'beans_post_append_markup', 'dfh_add_meta' );

function dfh_add_meta() {

  global $post; ?>

  <div class="tm-search-meta uk-clearfix uk-margin-small-top uk-margin-small-bottom">
    <span><?php echo $post->post_type; ?></span> <em><?php echo the_permalink(); ?></em>
  </div>

<?php }


// Set the excerpt and readon link
add_filter( 'the_content', 'dfh_modify_post_content' );

function dfh_modify_post_content( $content ) {

  if (function_exists('relevanssi_the_excerpt')) {

    $content = relevanssi_the_excerpt();

  }

  return $content;

}


// Load Beans
beans_load_document();