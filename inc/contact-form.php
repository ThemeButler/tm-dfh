<?php

if ( !isset( $errors ) ) {
  $errors = '';
}

if ( beans_post( 'action' ) === 'dfh_contact' ) {

  // Check message
  if ( !beans_post( 'dfh_message' ) )
    $errors['dfh_message'] = __( 'Please enter your message.', 'dfh' );

  // Check first
  if ( !beans_post( 'dfh_first' ) )
    $errors['dfh_first'] = __( 'Please enter your first name.', 'dfh' );

  // Check last
  if ( !beans_post( 'dfh_last' ) )
    $errors['dfh_last'] = __( 'Please enter your last name.', 'dfh' );

  // Check e-mail
  if ( !$email = beans_post( 'dfh_email' ) )
    $errors['dfh_email'] = __( 'Please enter an e-mail address.', 'dfh' );
  elseif ( !is_email( $email ) )
    $errors['dfh_email'] = __( 'Please enter a valid e-mail address.', 'dfh' );

  // Preceed if no errors
  if ( !isset( $errors ) ) {

    $first = $_POST['dfh_first'];
    $last = $_POST['dfh_last'];
    $email = $_POST['dfh_email'];
    $website = $_POST['dfh_website'];
    $message = $_POST['dfh_message'];
    $subject = 'New message from ' . $first . ' ' . $last;
    $body = "New message received from the DfH site :)\n\nName: {$first} {$last}\nEmail: {$email}\nWebsite: {$website}";
    $body .= "\nMessage: {$message}";
    $headers = "From: {$first} {$last}<{$email}>\r\nReply-To: {$email}";
    wp_mail( 'chris@devignerforhire.com', $subject, $body, $headers ); ?>

    <div class="uk-text-center uk-block">
      <h2>Nice one! Your message is on its way to my inbox!</h2>
      <p>Expect a reply within 24 hours.</p>
      <a class="uk-button uk-button-primary uk-button-large uk-margin-top" href="<?php echo home_url(); ?>">Back to the site</a>
    </div>

  <?php }

}

?>
<div class="uk-grid uk-grid-collapse">
  <div class="tm-contact-form uk-width-1-1 uk-width-medium-6-10 uk-width-large-7-10">
    <form method="post" id="tm-contact-form" class="uk-form contact-form">
      <h1 class="uk-article-title">Say Hello</h1>
      <p class="uk-article-lead">Got a project you'd like to discuss? Send me a summary of what you need help with and I'll get back to you ASAP.</p>
      <hr class="uk-article-divider">
      <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-2 uk-margin-bottom">
        <div class="uk-margin-bottom">
          <label class="uk-form-label" for="dfh_first">First</label>
          <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'dfh_first', $errors ) ) echo ' tm-field-error'; ?>" type="text" value="<?php echo beans_post( 'dfh_first' ); ?>" placeholder="Snoop" name="dfh_first"  tabindex="1">
          <?php if ( $message = beans_get( 'dfh_first', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
        </div>
        <div class="uk-margin-bottom">
          <label class="uk-form-label" for="dfh_last">Last</label>
          <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'dfh_last', $errors ) ) echo ' tm-field-error'; ?>" type="text" value="<?php echo beans_post( 'dfh_last' ); ?>" placeholder="Dogg" name="dfh_last" tabindex="2">
          <?php if ( $message = beans_get( 'dfh_last', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
        </div>
        <div class="uk-margin-bottom">
          <label class="uk-form-label" for="dfh_email">Email</label>
          <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'dfh_email', $errors ) ) echo ' tm-field-error'; ?>" type="email" value="<?php echo beans_post( 'dfh_email' ); ?>" placeholder="snoop@doggydog.yo" name="dfh_email" tabindex="3">
          <?php if ( $message = beans_get( 'dfh_email', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
        </div>
        <div class="uk-margin-bottom">
          <label class="uk-form-label" for="dfh_website">Website</label>
          <input class="uk-width-1-1 tm-field" type="text" value="<?php echo beans_post( 'dfh_website' ); ?>" placeholder="http://doggydog.yo" name="dfh_website" tabindex="4">
        </div>
        <div class="uk-width-1-1 uk-form-row tm-form-actions uk-margin-top">
          <label class="uk-form-label" for="dfh_message">Message</label>
          <textarea class="uk-form-large uk-width-1-1 tm-field<?php if ( $message = beans_get( 'dfh_message', $errors ) ) echo ' tm-field-error';?>" cols="13" rows="10" placeholder="Yo C-dog, lovin the new crib! Super tight, yo! High times we be chattin bout doggydogdog.me, homey. Got me some mad ideas for da new site! Hit me up on da Skype, so we can chat my nizzle. Snoop out!" name="dfh_message" autofocus tabindex="5"><?php echo beans_post( 'dfh_message' ); ?></textarea>
          <?php if ( $message = beans_get( 'dfh_message', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
        </div>
        <div class="uk-width-1-1 uk-form-row tm-form-actions uk-margin-top">
          <input type="hidden" name="action" value="dfh_contact" />
          <button class="uk-button uk-button-primary uk-button-large uk-margin-top" name="dfh_register" tabindex="6"><?php _e( 'Send it, papi', 'dfh' ); ?></button>
        </div>
      </div>
    </form>
  </div>
  <?php

  // Include Sidebar
  require_once( get_stylesheet_directory() . '/inc/contact-sidebar.php' );

  ?>
</div>