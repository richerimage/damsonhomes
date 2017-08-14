<?php

function dh_spec(&$site_meta = '', &$button_link = '') {

  global $post;

  ?>


  <div class="spec-intro text-columns mb-large">
    <p>Our breathtaking 5 &times; signature specification is fitted into each and every single one of our luxuruous new homes.</p>
    <p>From contemporary kitchens to stunning bathrooms and from luxury floorings to designer lighting, all is included as standard when you own a Damson Home.<p>
    <p>For full specifcation details see the <?php echo $site_meta['name']; ?> brochure&hellip;</p>
    <p><a class="button large cta" href="<?php dh_link($site_meta, $button_link); ?>">View the Brochure</a></p>
  </div>

  <?php $attached = get_post_meta( get_the_ID(), 'dh_site_specs', true );

  foreach ( $attached as $attached_post ) {

    $spec = get_post( $attached_post );

    // var_dump($post->post_title);
    // var_dump($post);
    ?>

    <div class="xv box clearfix mb">
      <div class="headline-wrapper twelve columns">
        <h3 class="headline"><?php echo $spec->post_title; ?></h3>
      </div>
      <?php echo get_the_post_thumbnail( $spec->ID, 'letterbox-large',  array( 'class' => 'six columns spec-img' )); ?> 
      <div class="post-excerpt six columns">
        <?php echo wpautop(do_shortcode($spec->post_content)); ?>
      </div>
    </div>

  <?php } ?>




<?php }
