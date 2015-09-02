<?php

// Setup the portfolio single layout
add_action( 'beans_before_load_document', 'dfh_modify_portfolio_markup' );

function dfh_modify_portfolio_markup() {

  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_primary' );
  beans_remove_attribute( 'beans_post', 'id' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-portfolio' );
  beans_add_attribute( 'beans_post_header', 'class', 'uk-clearfix' );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-float-left uk-margin-remove' );
  beans_add_attribute( 'beans_post', 'class', 'tm-portfolio-single uk-padding-remove' );
  beans_wrap_inner_markup( 'beans_post', 'tm_portfolio_content', 'div', array( 'class' => 'tm-portfolio-content uk-width-1-1 uk-width-medium-6-10 uk-width-large-7-10' ) );
  beans_add_attribute( 'tm_portfolio_content', 'role', 'main' );
  beans_add_attribute( 'beans_post', 'class', 'uk-grid uk-grid-collapse' );
  beans_add_attribute( 'beans_main', 'class', 'uk-padding-remove' );
  beans_modify_action_hook( 'beans_post_image', 'beans_post_before_markup' );
  beans_add_attribute( 'beans_post_image', 'class', 'uk-margin-bottom-remove uk-cover' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'dfh_enque_uikit_single' );

function dfh_enque_uikit_single() {

  beans_uikit_enqueue_components( array( 'thumbnail', 'overlay', 'modal', 'icon', 'subnav', 'article', 'cover' ) );
  beans_uikit_enqueue_components( array( 'lightbox', 'slidenav' ), 'add-ons' );

}


// Resize and crop the posts featured image
add_filter( 'beans_edit_post_image_args', 'dfh_edit_post_image' );

function dfh_edit_post_image() {

  return array(
   'resize' => array( '1370', '540', 'true', )
  );

}


// Modify portfolio single
add_action( 'beans_post_header_append_markup', 'dfh_add_site_link' );

function dfh_add_site_link() {

  global $post;

  $status = get_post_meta( $post->ID, 'portfolio_status', true );
  $url = get_post_meta( $post->ID, 'portfolio_url', true );

  if($status[0] != 1)
    return; ?>

  <a href="<?php echo $url; ?>" class="uk-button uk-button-primary uk-button-large uk-float-right uk-visible-medium" target="_blank">View Project</a>

<? }


// Add uk-article-lead class to excerpt
add_filter( "the_excerpt", "dfh_modify_excerpt" );

function dfh_modify_excerpt( $excerpt ) {

    return str_replace('<p', '<p class="uk-article-lead"', $excerpt);

}


// Add the excerpt
add_action( "beans_post_header_after_markup", "dfh_add_excerpt" );

function dfh_add_excerpt( $excerpt ) {

  echo the_excerpt();

}


// Add the portfolio single meta
add_action( 'tm_portfolio_content_after_markup', 'dfh_add_portfolio_sidebar' );

function dfh_add_portfolio_sidebar() {

  global $post;

  $colophon = get_post_meta( $post->ID, 'portfolio_colophon', true );
  $status = get_post_meta( $post->ID, 'portfolio_status', true );
  $status_title = '';

  if ( $status[0] == 0 )
    $status_title = 'Offline';
  elseif ( $status[0] == 1 )
    $status_title = 'Online';
  else
    $status_title = 'Coming soon';

  $status_class = '';

  if ( $status[0] == 0 )
    $status_class = ' tm-status-offline';
  elseif ( $status[0] == 1 )
    $status_class = ' tm-status-online';
  else
    $status_class = ' tm-status-coming';

  require_once( get_stylesheet_directory() . '/inc/portfolio-sidebar.php' );

?>

<? }


// Add the portfolio gallery
add_action( 'beans_post_body_append_markup', 'dfh_portfolio_gallery' );

function dfh_portfolio_gallery() {

  global $post;

  $images = get_post_meta( $post->ID, 'portfolio_gallery', true );

  ?>
  <h2 class="uk-margin-large-top">Screenshots</h2>
  <div class="tm-gallery uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3">
    <?php

    foreach ( (array) $images as $image_id ) {

      $image = wp_get_attachment_image_src( $image_id, 'full' );
      $full_src = $image[0];
      $url = $full_src;
      $file = substr($url, strrpos($url,'/')+1,strlen($url)-strrpos($url,'/'));
      $newfile = substr($file, 0,strrpos($file,'.'));
      $caption = str_replace('-', ' ', $newfile);

      $resized_src = beans_edit_image( $full_src, array(
        'resize' => array( 260, 203, array( 'center', 'top' ) )
      ) );

    ?>
      <figure>
        <a href="<?php echo $full_src; ?>" class="uk-overlay uk-overlay-hover uk-thumbnail" data-uk-lightbox="{group:'<?php echo $post->ID; ?>'}" title="<?php echo $caption; ?>">
          <img src="<?php echo $resized_src; ?>" />
          <div class="uk-overlay-panel uk-overlay-icon uk-overlay-background"></div>
          <figcaption class="uk-thumbnail-caption uk-text-center"><?php echo $caption; ?></figcaption>
        </a>
      </figure>
  <?php

  }

?>
  </div>
<?php

}


// Load Beans
beans_load_document();