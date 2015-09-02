<aside class="tm-portfolio-sidebar uk-width-1-1 uk-width-medium-4-10 uk-width-large-3-10" role="complimentary">
  <div class="tm-post-nav uk-grid uk-grid-small uk-grid-width-1-2">
    <div class="tm-prev">
      <?php
        $prev_post = get_previous_post();
        if($prev_post) {
           $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
           echo '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class="uk-display-block">Previous Project</a>';
        }
      ?>
    </div>
    <div class="tm-next uk-text-right">
      <?
        $next_post = get_next_post();
        if($next_post) {
           $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
           echo '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class="uk-display-block">Next Project</a>';
        }
      ?>
    </div>
  </div>
  <div class="tm-summary tm-box">
    <div class="tm-box-inner tm-divider">
      <h2 class="uk-h4">Summary</h2>
      <ul class="uk-list uk-list-space">
        <li><strong>Project</strong> <?php the_title(); ?></li>
        <li><strong>Client</strong> <?php the_terms( get_the_ID(), 'portfolio_clients' ); ?></li>
        <li><strong>Type</strong> <?php the_terms( get_the_ID(), 'portfolio_project_types' ); ?></li>
        <li><strong>Status</strong> <?php echo $status_title; ?> <span class="tm-status<?php echo $status_class; ?>"></span></li>
        <li><strong>Date</strong> <?php the_date('M, Y'); ?></li>
      </ul>
    </div>
  </div>
  <div class="tm-skills tm-box">
    <div class="tm-box-inner tm-divider">
      <h2 class="uk-h4">Skills Used</h2>
      <ul class="uk-subnav">
        <?php the_terms( get_the_ID(), 'portfolio_skills', '<li>', '</li><li>', '</li>' ); ?>
      </ul>
    </div>
  </div>
  <div class="tm-colophon tm-box tm-last">
    <h2 class="uk-h4">Colophon</h2>
    <ul class="uk-list uk-list-space tm-list-style-1">
    <?php $colophon = explode( PHP_EOL, $colophon ); foreach ( $colophon as $colophon_line ) : ?>
      <li><?php echo $colophon_line; ?></li>
    <?php endforeach; ?>
    </ul>
  </div>
</aside>