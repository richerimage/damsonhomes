<?php 


function dh_social_share(&$type = 'blog!', &$id='') {

  global $post;

  $id         = (!empty($id) ? 'id="' . $id . '" ' : '');
  //$type       = (!empty($type) ? 'post!' : '');
  $hook       = 'dh_social_share_box';
  $cache_key  = 'dh_social_share_' . get_the_ID();
  $count      = get_transient( $cache_key ); // try to get value from Wordpress cache


  echo "<div {$id}class=\"dh-social-share-box\">\n";

  if ( $count === false ) { // if no value in the cache

    if (is_home()) {
      $response = wp_remote_get('http://graph.facebook.com/?fields=og_object{likes.summary(true).limit(0)},share&id=' . get_the_permalink());
    } else {
      $response = wp_remote_get('http://graph.facebook.com/?fields=og_object{likes.summary(true).limit(0)},share&id=' . get_home_url() . '/blog/');
    }

    $body = json_decode( $response['body'] );

    // var_dump($body);

    $likes  = (isset($body->og_object->likes->summary->total_count) ? intval($body->og_object->likes->summary->total_count) : '0');

    $shares = (isset($body->share->share_count) ? intval($body->share->share_count) : '0');

    $count  = intval( $likes + $shares );

    set_transient( $cache_key, $count, 3600 ); // store value in cache for a 1 hour

  }


  if ($count == '0' || $count == '' ) {

    echo "\t<p class=\"shares shares-first nbm\">Be the First to share this {$type}</p>";

  } else if ($count === 1) {

    echo "\t<p class=\"shares nbm\"><span id=\"count\">" . $count . "</span> Share</p>";

  } else {

    echo "\t<p class=\"shares nbm\"><span id=\"count\">" . $count . "</span> Shares</p>";

  }

  echo

  "\t<div class=\"share-buttons\">\n".

  (!empty($count) ? "\t\t<span class=\"share-btn share-cta\">Now it's your turn&hellip;</span>\n" : '' ) .

  "\t\t<a class=\"share-btn share-btn-facebook\" href=\"https://www.facebook.com/sharer/sharer.php?u=" . get_the_permalink() . "\" title=\"Share on Facebook\">" . dh_get_svg(array('icon' => 'facebook')) . "</a>\n".

  "\t\t<a class=\"share-btn share-btn-twitter\" href=\"https://twitter.com/share?url=" . get_the_permalink() . "&text=" . get_the_title() . "&via=damsonhomes\"
       title=\"Share on Twitter\">" . dh_get_svg(array('icon' => 'twitter')) . "</a>\n".

  "\t\t<a class=\"share-btn share-btn-email\" href=\"mailto:?subject=" . get_the_title() . "&body=Check this out: " . get_the_permalink() . "\" title=\"Share via Email\">" . dh_get_svg(array('icon' => 'envelope-o')) . "</a>\n".

  "\t</div>\n".
  "</div>\n";

}

