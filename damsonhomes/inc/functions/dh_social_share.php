<?php 


function dh_social_share(&$type = 'blog!', &$url='', &$id='') {

  global $post;

  $id         = (!empty($id) ? 'id="' . $id . '" ' : '');
  $url        = (!empty($url) ? $url : get_the_permalink());
  //$type       = (!empty($type) ? 'post!' : '');
  $hook       = 'dh_social_share_box';
  $cache_key  = 'dh_social_share_' . get_the_ID();
  $count      = get_transient( $cache_key ); // try to get value from Wordpress cache

  $blog_id    = get_option( 'page_for_posts' );

  if (is_home()) {

    $base_count = get_post_meta($blog_id, 'dh_share_count_base', true) ? get_post_meta($blog_id, 'dh_share_count_base', true) : ''; 

  } else {

    $base_count = get_post_meta($post->ID, 'dh_share_count_base', true) ? get_post_meta($post->ID, 'dh_share_count_base', true) : ''; 

  }


  echo "<div {$id}class=\"dh-social-share-box aside\">\n";

  if ( $count === false ) { // if no value in the cache

    if (is_home()) {
      $response = wp_remote_get('https://graph.facebook.com/?fields=og_object%7Blikes.summary(true).limit(0)%7D,share&id=' . $url);
    } else {
      $response = wp_remote_get('https://graph.facebook.com/?fields=og_object%7Blikes.summary(true).limit(0)%7D,share&id=' . get_home_url() . '/blog/');
    }

    $body = json_decode( $response['body'] );

    // var_dump($body);

    $likes  = (isset($body->og_object->likes->summary->total_count) ? intval($body->og_object->likes->summary->total_count) : '0');

    $shares = (isset($body->share->share_count) ? intval($body->share->share_count) : '0');

    $comments = (isset($body->share->comment_count) ? intval($body->share->comment_count) : '0');

    $count  = intval( $likes + $shares + $comments);

    set_transient( $cache_key, $count, 3600 ); // store value in cache for a 1 hour

  }

  $total_kudos = $count + $base_count;


  if ($total_kudos == '0' || $total_kudos == '' ) {

    echo "\t<p class=\"shares shares-first nbm\">Be the First to share this {$type}</p>";

  } else if ($total_kudos === 1) {

    echo "\t<p class=\"shares nbm\"><span id=\"count\">" . $total_kudos . "</span> Share</p>";

  } else {

    echo "\t<p class=\"shares nbm\"><span id=\"count\">" . $total_kudos . "</span> Shares</p>";

  }

  echo

  "\t<div class=\"share-buttons\">\n".

  (!empty($total_kudos) ? "\t\t<span class=\"share-btn share-cta\">Now it's your turn&hellip;</span>\n" : '' ) .

  "\t\t<a class=\"share-btn share-btn-facebook\" href=\"https://www.facebook.com/sharer/sharer.php?u=" . $url . "\" target=\"_blank\" title=\"Share on Facebook\">" . dh_get_svg(array('icon' => 'facebook')) . "</a>\n".

  "\t\t<a class=\"share-btn share-btn-twitter\" href=\"https://twitter.com/share?url=" . $url . "&text=" . get_the_title() . "&via=damsonhomes\"
       target=\"_blank\" title=\"Share on Twitter\">" . dh_get_svg(array('icon' => 'twitter')) . "</a>\n".

  "\t\t<a class=\"share-btn share-btn-email\" href=\"mailto:?subject=" . get_the_title() . "&body=Check this out: " . $url . "\" target=\"_blank\" title=\"Share via Email\">" . dh_get_svg(array('icon' => 'envelope-o')) . "</a>\n".

  "\t</div>\n".
  "</div>\n";

}

