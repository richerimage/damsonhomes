<?php

function dh_spec(&$name = '', &$site_logo_id = '', &$brochure = '') {

  global $post;


  ?>

  <div class="dh-spec columns">
    <div class="spec-intro hentry">
      <p>Our breathtaking 5 &times; signature specification is fitted into each and every single one of our luxuruous new homes.</p>
      <p>From contemporary kitchens to stunning bathrooms and from luxury floorings to designer lighting, all is included as standard when you own a Damson Home.<p>
      <p class="text-center">For full specifcation details see the <?php echo $name; ?> brochure&hellip;</p>
      <p class="text-center button-holder"><a class="button cta" href="#0">View the Brochure</a></p>
    </div>

  <?php $attached = get_post_meta( get_the_ID(), 'dh_site_spec', true );

  foreach ( $attached as $attached_post ) {

    $spec = get_post( $attached_post );

    // var_dump($post->post_title);
    // var_dump($post);
    ?>

    <div class="card xv">
      <h3 class="headline"><?php echo $spec->post_title; ?></h3>
      <div class="row">
        <?php echo get_the_post_thumbnail( $spec->ID, 'Square',  array( 'class' => 'spec-ftr-img' )); ?> 
        <div>
          <?php echo wpautop(do_shortcode($spec->post_content)); ?>
        </div>
      </div>
    </div>

  <?php } ?>


  </div>


<?php }
