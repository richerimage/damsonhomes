  <?php

  public function dh_post_gallery($output, $attr) {
      
      global $post, $wp_locale;

      static $instance = 0;
      $instance++;

      // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
      if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
      }

      $class_option = 'owl-carousel';

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
        'exclude'    => ''
      ), $attr));

      if ($class_option == 'owl-carousel') {
        $this->addScript = true;
      }

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

      // var_dump($this->options['gallery-output']);

      // $plugin_class = !empty($this->options['gallery-output']) ? 'owl-carousel ' : '';

      $class = !empty($class) ? $class . ' ' . $class_option . ' ' : $class_option . ' ';

      // $class_option = !empty($class_option) ? ' ' . $class_option : '';
      

      $output     = "<div id=\"$selector\" class=\"gallery gallery-id-{$id} " . $class . (!empty($columns) ? 'gallery-columns-' . $columns . ' ' : '') . "clearfix\">";

      $i = 0;

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
      }
      $output .= "</div>";

      return $output;
  }