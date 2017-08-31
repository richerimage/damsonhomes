<?php

function dh_spec(&$site_meta = '', &$button_link = '') {

  global $post;

  ?>


  <div class="spec-intro text-columns mb-large">
    <p>Our breathtaking 5 &times; signature specification is fitted into each and every single one of our luxuruous new homes.</p>
    <p>From contemporary kitchens to stunning bathrooms and from luxury floorings to designer lighting, all is included as standard when you own a Damson Home.<p>
    <p>For full specifcation details see the <?php echo $site_meta['name']; ?> brochure&hellip;</p>
    <p><a class="button large cta" href="<?php dh_link($site_meta, $button_link); ?>">View the Brochure &rarr;</a></p>
  </div>

  <?php $attached = get_post_meta( get_the_ID(), 'dh_site_specs', true );

  foreach ( $attached as $attached_post ) {

    $spec = get_post( $attached_post );
    
    ?>

    <div class="xv box clearfix mb">
      <div class="headline-wrapper twelve columns">
        <h3 class="headline"><?php echo $spec->post_title; ?></h3>
      </div>

      <?php 

        $img_id     = get_post_thumbnail_id($spec->ID);
        $slide_att  = wp_get_attachment_image_src($img_id, 'letterbox-small');
        
        echo '<img class="attachment-letterbox-small size-letterbox-small wp-post-image attachment-id-' . $img_id . ' six columns spec-img" src="' . $slide_att[0] . '" width="' . $slide_att[1] . '" height="' . $slide_att[2] . '">';

        ?> 
      <div class="post-content six columns">
        <?php echo wpautop(do_shortcode($spec->post_content)); ?>
      </div>
    </div>

  <?php } ?>




<?php }
