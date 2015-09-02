<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'dfh_frontpage_setup' );

function dfh_frontpage_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-home' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_primary' );

}

// Add the bottom widget area
add_action( 'beans_header_after_markup', 'dfh_welcome' );

function dfh_welcome() { ?>

  <div class="tm-welcome uk-contrast">
    <h1 class="uk-article-title uk-text-center">Howzit! My name is Chris</h1>
    <p class="uk-margin-remove uk-h3 uk-text-center">I am an Entrepreneur, Designer and Front-end Developer. I get a kick out of creating interfaces that people love using. Below are a few examples of my work.</p>
  </div>

<? }


// Modify the loop output
beans_modify_action_callback( 'beans_loop_template', 'dfh_home_work_loop' );

function dfh_home_work_loop( $query ) {

  $the_query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => '15', 'no_found_rows' => true ) ); ?>

  <div class="uk-grid uk-grid-match uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-large-1-3" data-uk-grid-match="{target:'.uk-thumbnail'}">
    <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

    if ( $images = get_post_meta( get_the_ID(), 'portfolio_gallery', true ) ) {

      $image = wp_get_attachment_image_src( $images[0], 'full' );
      $image_src = beans_edit_image( $image[0], array(
        'resize' => array( 380, 298, array( 'center', 'top' ) )
      ) );

    } else {

      $image_src = false;

    }

    ?>
      <div class="tm-item">
        <figure>
          <a rel="bookmark" href="<?php echo get_permalink(); ?>" title="Learn more" class="uk-thumbnail">
            <img src="<?php echo $image_src; ?>" class="uk-overlay-scale" width="380" height="300" alt="<?php echo the_title(); ?>" />
            <figcaption class="uk-margin-top">
               <h3 class="uk-margin-small-bottom uk-h5"><?php echo the_title(); ?></h3>
               <?php the_excerpt(); ?>
            </figcaption>
          </a>
        </figure>
      </div>
    <?php endwhile; else: ?>
      <div>Sorry, there are no posts to display</div>
    <?php endif; ?>
    </div>
  <?php

  wp_reset_query();

}


// Load Beans
beans_load_document();