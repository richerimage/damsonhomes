<?php

function dh_available_plots() {

  global $post;

  $plot_map_id = get_post_meta($post->ID, 'dh_plot_map_url_id', true) ? get_post_meta($post->ID, 'dh_plot_map_url_id', true) : '';

  $dh_plots   = get_post_meta($post->ID, 'dh_plot_avail', true) ? get_post_meta($post->ID, 'dh_plot_avail', true) : '';

  $dh_plot    = '';
  $dh_plot    = get_post_meta($post->ID, 'dh_plot_avail', true);

  $res_buyer  = get_post_meta($post->ID, 'dh_show_reserve_buyer', true) ? get_post_meta($post->ID, 'dh_show_reserve_buyer', true) : '';

  $count = count($dh_plots);

  if ($count <= 4) { $size = 'small'; }
  if ($count >= 5) { $size = 'medium'; }
  if ($count >= 9) { $size = 'large'; }



  ?>
    <div class="plot-plan columns">
      <h2>Plot Plan &amp; Availablity</h2>
      <div class="action-box">
        <a id="viewing_trigger" class="dnh-popup-trigger button" href="#">Arrange a Viewing</a> <a id="reservation_trigger" class="button" href="#">View Brochure</a>
      </div>

  <?php if (!empty($plot_map_id)) { 
      echo wp_get_attachment_image( $plot_map_id, 'large', '', array( 'class' => 'plot-map' )); 
  } ?>

    </div>

    <div id="dh_plot_availability" class="plot-availability columns <?php echo $count ?>-plot-site <?php echo $size; ?>-site">


    <?php

      $is_reserved = false;

      $counter = 0;

    ?>

      <h5>Arrange a viewing or request a reservation</h5>
      <p class="aux">by selecting your favourite plot below&hellip;</p>

    <?php if (!empty($res_buyer)) { ?>

      <p class="aux res-buyer-prompt"><a class="button cta" href="#"><strong>Favourite Plot Reserved?</strong> Tell us here and we will let you know first if it becomes available again.</a></p>

    <?php } ?>

      <ul class="dh-plot-list">

      <?php foreach( $dh_plot as $key => $plot){

        $counter ++;

        if ($plot['dh_plot_status'] === 'sstc') {
          $is_reserved = true;
        }

        echo 
        "\t\t<li class=\"" . $plot['dh_plot_status'] . " plot-" . $counter . "\">\n".
        (($plot['dh_plot_status'] == 'available') ? "\t\t\t<a class=\"block-link\" href=\"#\">\n" : '') .
        "\t\t\t<span class=\"dh-svg dh-svg-home icon-home-22\">\n".
        "\t\t\t\t<svg class=\"icon-home\" height=\"100%\" width=\"100%\">\n".
        "\t\t\t\t\t<use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-home\"></use>\n".
        "\t\t\t\t</svg>\n".
        "\t\t\t</span>\n".
        "\t\t\t<span class=\"screen-reader-text\">Values from</span>\n".
        "\t\t\t<span class=\"dh-plot-number ilb\">" . (is_numeric($plot['dh_plot_number']) ? 'Plot ' . $plot['dh_plot_number'] : $plot['dh_plot_number'] ) . "</span>\n".
        (($plot['dh_plot_status'] == 'available')  ? "\t\t\t<span class=\"dh-plot-value ilb\">£" . $plot['dh_plot_value'] . "</span>\n" : '').
        "\t\t\t<span class=\"dh-plot-desc ilb\">" . $plot['dh_plot-desc'] . "</span>\n".
        (($plot['dh_plot_status'] == 'available') ? "\t\t\t</a>\n" : '') .
        "\t\t</li>\n";

      } ?>

      </ul> 

    </div>


<?php }