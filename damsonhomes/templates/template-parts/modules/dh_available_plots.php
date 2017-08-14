<?php

function dh_available_plots(&$site_meta=array(), &$link_to=array()) {


  global $post;

  $plot_map_id  = get_post_meta($post->ID, 'dh_plot_map_id', true) ? get_post_meta($post->ID, 'dh_plot_map_id', true) : '';
  $dh_plots     = get_post_meta($post->ID, 'dh_plot_avail', true) ? get_post_meta($post->ID, 'dh_plot_avail', true) : '';
  $dh_plot      = get_post_meta($post->ID, 'dh_plot_avail', true);
  $res_buyer    = get_post_meta($post->ID, 'dh_show_reserve_buyer', true) ? get_post_meta($post->ID, 'dh_show_reserve_buyer', true) : '';
  $dh_htb       = get_post_meta($post->ID, 'dh_h2b_available', true) ? get_post_meta($post->ID, 'dh_h2b_available', true) : '';


  $count = count($dh_plots);

  if ($count <= 4) { $size = 'small'; }
  if ($count >= 5) { $size = 'medium'; }
  if ($count >= 9) { $size = 'large'; }

  ?>

<div class="headline-wrapper twelve columns">
  <h2 class="headline h2 ntm">Plot Plan and Availability</h2>
  <div class="action-box mb-large">
    <a class="button large" target="_blank" href="<?php dh_link($site_meta, $link_to['viewing']); ?>">Arrange a Viewing</a><a class="button large" target="_blank" href="<?php dh_link($site_meta, $link_to['brochure']); ?>">View Brochure</a>
  </div>
</div>

<div class="plot-plan eight columns">

  <?php if (!empty($plot_map_id)) { 
    echo wp_get_attachment_image( $plot_map_id, 'full', '', array( 'class' => 'plot-map' )); 
  } ?>

</div>

<div id="dh_plot_availability" class="plot-availability four columns <?php echo $count ?>-plot-site <?php echo $size; ?>-site xv box">


<?php

  $is_reserved = false;

  $counter = 0;

?>
  <div class="plots-header">
    <h3>Plots</h3>
    <p>Make a Reservation Request by choosing your plot below</p>
  </div>

<?php if (!empty($res_buyer)) {

  $option = 'dh_reserve_buyer';

  ?>

  <p class="aux res-buyer-prompt"><a class="button cta" target="_blank" href="<?php dh_link($site_meta, $link_to['register'], $option); ?>"><strong>Favourite Plot Reserved?</strong> Tell us here and we will let you know first if it becomes available again.</a></p>

<?php } ?>

  <ul class="block-list aside no-style">

  <?php foreach( $dh_plot as $key => $plot){

    $counter ++;

    if ($plot['dh_plot_status'] === 'sstc') {
      $is_reserved = true;
    }

    $h2b = ((isset($plot['dh_h2b_available']) ?  (($plot['dh_h2b_available'] === 'on') ? 'on' : '')  : '' ));

    $plot_meta = array (
      'plot_no'   => $plot['dh_plot_number'],
      'plot_val'  => $plot['dh_plot_value'],
      'plot_desc' => $plot['dh_plot-desc'],
      'plot_h2b'  => $h2b
    );

    $merged_meta = array_merge($site_meta, $plot_meta);

    ?>

      <li class="<?php echo $plot['dh_plot_status']; ?> plot-<?php echo $counter; ?>">
    
        <?php if ($plot['dh_plot_status'] == 'available') { ?>

          <a class="block-link" target=_blank" href="<?php dh_link($merged_meta, $link_to['reserve']); ?>">

        <?php }

          echo

          "\t\t\t" . dh_get_svg(array('icon' => 'home')) . "\n".
          "\t\t\t<span class=\"dh-plot-number ilb\">" . (is_numeric($plot['dh_plot_number']) ? 'Plot ' . $plot['dh_plot_number'] : $plot['dh_plot_number'] ) . "</span>\n".
          (($plot['dh_plot_status'] == 'available')  ? "\t\t\t<span class=\"dh-plot-value ilb\">£" . $plot['dh_plot_value'] . "</span>\n" : '').

          (!empty($h2b) ? "\t\t\t<span class=\"dh-plot-h2b ilb\">" . dh_get_svg(array('icon' => 'h2b')) . "</span>\n" : '') .

          "\t\t\t<span class=\"dh-plot-desc ilb\">" . $plot['dh_plot-desc'] . "</span>\n";
          
        if ($plot['dh_plot_status'] == 'available') { ?>
          </a>
        <?php } ?>
      </li>

  <?php } ?>

  </ul> 

  <div class="legend aside">
    <h5>Key</h5>
    <ul class="no-style inline aside">
      <li class="available"><?php echo dh_get_svg(array('icon' => 'home')); ?> For Sale</li>
      <li class="sstc"><?php echo dh_get_svg(array('icon' => 'home')); ?> <abbr title="Sold Subject to Contract">SSTC</abbr></li>
      <li class="sold"><?php echo dh_get_svg(array('icon' => 'home')); ?> Sold</li>
      <li class="h2b"><?php echo dh_get_svg(array('icon' => 'h2b')); ?> Help to Buy</li>
    </ul>
  </div>

</div>



<?php }