<?php

add_filter ('post_gallery', 'dh_post_gallery', 10, 2);

function dh_post_gallery($output, $attr) {
      
  global $post, $wp_locale;

  static $instance = 0;
  $instance++;

  // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'div',
    'icontag'    => 'div',
    'captiontag' => 'span',
    'columns'    => '',
    'link'       => 'file',
    'size'       => 'thumbnail',
    'class'      => '', 
    'include'    => '',
    'exclude'    => '',
    'option'     => 'fancybox'
  ), $attr));


  //
  // Add a script
  //
  // if ($class_option == 'owl-carousel') {
  //   $this->addScript = true;
  // }

  $id = intval($id);
  if ( 'RAND' == $order )
      $orderby = 'none';
  if ( !empty($include) ) {
    $include = preg_replace( '/[^0-9,]+/', '', $include );
    $_attachments = get_posts(
      array(
        'include'         => $include,
        'post_status'     => 'inherit',
        'post_type'       => 'attachment',
        'post_mime_type'  => 'image',
        'order'           => $order,
        'orderby'         => $orderby));

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
    $attachments = get_children(
      array(
        'post_parent'     => $id,
        'exclude'         => $exclude,
        'post_status'     => 'inherit',
        'post_type'       => 'attachment',
        'post_mime_type'  => 'image',
        'order'           => $order,
        'orderby'         => $orderby));
  } else {
    $attachments = get_children(
      array(
        'post_parent'     => $id,
        'post_status'     => 'inherit',
        'post_type'       => 'attachment',
        'post_mime_type'  => 'image',
        'order'           => $order,
        'orderby'         => $orderby));
  }

  if ( empty($attachments) )
      return '';

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
  }

  $itemtag    = tag_escape($itemtag);
  $captiontag = tag_escape($captiontag);
  $columns    = intval($columns);
  $itemwidth  = $columns > 0 ? floor(100/$columns) : 100;
  $float      = is_rtl() ? 'right' : 'left';
  $selector   = "gallery-{$instance}";


  // dump($class);

  // $plugin_class = !empty($this->options['gallery-output']) ? 'owl-carousel ' : '';

  $option_class     = (!empty($option) ? ' gallery-'. $option : '');
  $gallery_columns  = (!empty($columns) ? ' gallery-columns-' . $columns . ' ' : '');
  $user_class       = (!empty($class) ? ' ' . $class : '');

  $class_output     = 'gallery gallery-id-' . $id . $option_class . $gallery_columns . $user_class;




  $output     = "<div id=\"$selector\" class=\"{$class_output}\">";

  $counter = '0';


  if ($option === 'fancybox') {

    foreach ( $attachments as $id => $attachment ) {

        $counter++;

        $thumb_data   = wp_get_attachment_image_src($id, 'thumbnail');
        $medium_data  = wp_get_attachment_image_src($id, 'medium');
        $large_data   = wp_get_attachment_image_src($id, 'letterbox-large');


        // $img_src = wp_get_attachment_image_url( $id, 'medium' );   
        $img_srcset = wp_get_attachment_image_srcset( $id );

        $thumb = $thumb_data['0'];

        $output .= "<{$itemtag} class=\"gallery-item gallery-item-{$counter}\">\n";
        $output .= "\t<a class=\"gallery-img-link\" data-fancybox=\"fancybox-gallery-{$instance}\" data-type=\"image\" data-srcset=\"{$img_srcset}\" data-width=\"{$large_data['1']}\" data-height=\"{$large_data['2']}\" href=\"{$large_data['0']}\" >\n";

        if ($counter === '1') {

          $output .= "\t\t<img src=\"{$large_data['0']}\" width=\"{$large_data['1']}\" height=\"{$large_data['2']}\">\n";

        } else {

          $output .= "\t\t<img src=\"{$thumb_data['0']}\" width=\"{$thumb_data['1']}\" height=\"{$thumb_data['2']}\">\n";

        }
        // $output .= (!empty($title) ? '<div class="image-title">' . $attachment->post_title . '</div>' : '');
        $output .= "</a>\n";
        $output .= "</{$itemtag}>\n";


    } // End of foreach

  } else { // Start of defaul Gallery Output


    foreach ( $attachments as $id => $attachment ) {


      $link = isset($attr['link']) && 'file' == $attr['link'] 

        ? wp_get_attachment_link($id, $size, false, false) 

        : wp_get_attachment_image($id, $size, false);


      $output .= "<{$itemtag} class='gallery-item'>";
      $output .= "<{$icontag} class='gallery-icon'>";
      $output .= (!empty($title) ? '<div class="image-title">' . $attachment->post_title . '</div>' : '');
      $output .= $link;
      $output .= "</{$icontag}>";
      if ( $captiontag && trim($attachment->post_excerpt) ) {
        $output .= "<{$captiontag} class='gallery-caption'>";
        $output .= wptexturize($attachment->post_excerpt);
        $output .= "</{$captiontag}>";
      }
      $output .= "</{$itemtag}>";

      } // End of default gallery output

  }


  $output .= "</div>"; // end of .Gallery

  return $output;

}