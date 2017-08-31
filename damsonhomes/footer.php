<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Damson_Homes
 */

global $post; 

$footer_class = '';

if ( (is_archive()) || (is_home()) || (is_page('coming-soon')) ) {

  $footer_class = ' footer-border-top';

}




?>

	<footer id="colophon" class="footer-area<?php echo $footer_class; ?>" role="contentinfo">
		<div class="footer row aside">

      <div class="left-menus three columns">
        <?php if (false === ($live_site_query = get_transient( 'live_site_query' ))) {
          
            // No Transient?, Lets regenerate the data and save the transient

            $args = array(
              'tax_query' => array(
                array(
                  'taxonomy' => 'dnh_site_status_taxonomy',
                  'field'    => 'slug',
                  'terms'    => 'live',
                )));
            
            $live_site_query = new WP_Query($args); // The Query

            set_transient( 'live_site_query', $live_site_query, 60*60*12); // Store for 12 hrs

          } 

        // The Loop
        if ( $live_site_query->have_posts() ) {
          echo "<h5 class=\"ntm\"><a href=\"/for-sale/\">New Homes For Sale</a></h5>\n".
               "<ul class=\"no-style site-nav\">\n";
          while ( $live_site_query->have_posts() ) {
            $live_site_query->the_post();
            echo "    <li><a href=\"" . get_the_permalink() . "\" title=\"" . get_the_title() . "\">" . get_post_meta($post->ID, 'dh_site_name', true) . "</a></li>\n";
          }
          echo "  </ul>\n";
        } else { }
        
        wp_reset_postdata(); // Restore original Post Data

        


        if (false === ($soon_site_query = get_transient( 'soon_site_query' ))) {
          
            // No Transient?, Lets regenerate the data and save the transient

            $args = array(
              'tax_query' => array(
                array(
                  'taxonomy' => 'dnh_site_status_taxonomy',
                  'field'    => 'slug',
                  'terms'    => 'coming-soon',
                )));
            
            $soon_site_query = new WP_Query($args); // The Query

            set_transient( 'soon_site_query', $soon_site_query, 60*60*12); // Store for 12 hrs

          } 

        // The Loop
        if ( $soon_site_query->have_posts() ) {
          echo "<h5 class=\"ntm\"><a href=\"/coming-soon/\">Coming Soon</a></h5>\n".
               "<ul class=\"no-style site-nav\">\n";
          while ( $soon_site_query->have_posts() ) {
            $soon_site_query->the_post();
            echo "    <li><a href=\"" . get_the_permalink() . "\" title=\"" . get_the_title() . "\">" . get_post_meta($post->ID, 'dh_site_name', true) . "</a></li>\n";
          }
          echo "  </ul>\n";
        } else { }
        
        wp_reset_postdata(); // Restore original Post Data

        ?>




        <h5><a href="\portfolio\">Past Sites Portfolio</a></h5>
        <?php

          $counter = '';

          if (false === ($past_site_query = get_transient('past_site_query'))) {
            // No Transient?, Lets regenerate the data and save the transient

            $counter = 1;

            $args = array(
              'posts_per_page'  => '-1',
              'tax_query'       => array(
                array(
                  'taxonomy' => 'dnh_site_status_taxonomy',
                  'field'    => 'slug',
                  'terms'    => 'portfolio',
                )));

            $past_site_query = new WP_Query($args); // The Query

            set_transient('past_site_query', $past_site_query, 60*60*12); // Store for 12 hrs

          }

        // The Loop
        if ( $past_site_query->have_posts() ) {

          echo "<ul class=\"no-style site-nav\">\n";

          while ( $past_site_query->have_posts() ) {
            $past_site_query->the_post();
            echo "    <li><a href=\"" . get_the_permalink() . "\" title=\"" . get_the_title() . "\">" . get_post_meta($post->ID, 'dh_site_name', true) . "</a></li>\n";

            $counter++;

            if( $counter === 5 ) { 
              echo 
              "    <span class=\"dh-reveal-wrap\">\n" .
              "    <li><a href=\"#\" class=\"reveal\" title=\"See the rest of our past developements\">More...</a></li>\n" .
              "    <span class=\"reveal-box\" style=\"display: none;\">\n";

            }
          }
            echo
              "    </span>\n" .
              "    </span>\n" .
              "  </ul>";
        }

        wp_reset_postdata(); // Restore original Post Data ?>

      </div>

      <div class="left-center-menus three columns">

        <h5 class="ntm">New Homes in&hellip;</h5>
        <ul class="no-style">
          <li><a href="/new-homes-in/solihull/">Solihull</a></li>
          <li><a href="/new-homes-in/hall-green">Hall Green</a></li>
          <li><a href="/new-homes-in/birmingham">Birmingham</a></li>
          <li><a href="/new-homes-in/sutton-coldfield">Sutton Coldfield</a></li>
        </ul>

        <h5 class="ntm">Popular Pages</h5>
        <ul class="no-style">
          <li><a href="/spec/">Our Spec</a></li>
          <li><a href="/aftercare/">Aftercare</a></li>
          <li><a href="/opendays/">Open Days</a></li>
          <li><a href="/land/">Selling your land</a></li>
          <li><a href="/together/">Damson Together</a></li>
          <li><a href="/together/heart/"> &ndash; Heart Breakfast</a></li>
          <li><a href="/together/heart/lapland-2016/"> &ndash; Lapland</a></li>
          <li><a href="/together/heart/hearthouse/"> &ndash; The Heart House</a></li>
          <li><a href="/helptobuy/">Help to Buy</a></li>
        </ul>
      </div>

      <div class="footer-right six columns">
        <div class="get-in-touch">
          <h4 class="ntm">Get in Touch</h4>
          <?php dh_address(); ?>
          <p class="portal-login nbm has-icon"><?php echo dh_get_svg(array('icon' => 'client')); ?> <a href="http://portal.damsonhomes.net/" class="icon-alone" title="Log in to the Client Portal" target="_blank">Client Portal</a></p>
        </div>
        <div class="subscribe-today">
          <h4 class="ntm">Be first to hear about our latest New Homes</h4>
          <p class="nbm"><a class="button" href="/subscribe/?dh_source=<?php the_permalink(); ?>">Subscribe Today</a></p>
        </div>
        <div class="social-channels">
          <h4 class="nbm">Follow us</h4>
          <p>On your favourite Social Media Channels for live updates.</p>
            <ul class="dna-social-wrapper clearfix nbm">
              <li class="dna_sm_facebook">
                <a href="https://facebook.com/damsonnewbuild/" class="icon-alone" title="Like us on Facebook" target="_blank">
                  <?php echo dh_get_svg(array('icon' => 'facebook')); ?>
                </a>
              </li>
              <li class="dna_sm_twitter">
                <a href="https://twitter.com/damsonhomes/" class="icon-alone" title="Follow us on Twitter" target="_blank">
                  <?php echo dh_get_svg(array('icon' => 'twitter')); ?>
                </a>
                </a>
              </li>
              <li class="dna_sm_instagram">
                <a href="https://instagram.com/damsonhomes/" class="icon-alone" title="Follow us on Instagram" target="_blank">
                  <?php echo dh_get_svg(array('icon' => 'instagram')); ?>
                </a>
              </li>
            </ul>
        </div>
      </div>

		</div><!-- .footer.page -->
	</footer><!-- #colophon -->


  <aside class="dna-credits-box row">
    <div class="dna-copyright-date six columns aside aux">
      <p>© 2004&ndash;<?php echo date('Y') ; ?> Damson Homes</p>
    </div>
    <div class="dna-studio-link six columns aside aux">
      <p><a href="/privacy/" target="_blank">Privacy</a> | <a href="/terms/" target="_blank">Terms and Conditions</a></p>
    </div>
  </aside>

  <aside class="row legal-footer">
    <div class="dh-legal-footer twelve columns aside aux">
      <p>Damson Properties Ltd &amp; Damson New Build Ltd t/a <span class="ilb">Damson Homes</span><br>
      Registered Address: Shah &amp; Co, Cash’s Business Centre, Widdrington Road, Coventry, CV1 4PB<br>
      Damson Properties Ltd Reg No: 04888424 | Damson New Build Ltd Reg No: 06436944</p>
    </div>
  </aside>

<?php wp_footer(); ?>

</body>
</html>
