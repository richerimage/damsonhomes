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

global $post; ?>

	<footer id="colophon" class="footer-area" role="contentinfo">
		<div class="footer row aside">

      <div class="left-menus three columns">
        <h5 class="ntm">Current New Home Sites</h5>
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
          echo "<ul class=\"no-style\">\n";
          while ( $live_site_query->have_posts() ) {
            $live_site_query->the_post();
            echo "    <li><a href=\"" . get_the_permalink() . "\" title=\"" . get_the_title() . "\">" . get_post_meta($post->ID, 'dh_site_name', true) . "</a></li>\n";
          }
          echo "  </ul>\n";
        } else {
          echo "<p class=\"nbm\">Sorry, there are no available New Home developments at this moment. <a href=\"/coming-soon/\">Visit the Coming Soon Page</a> to see our forthcoming new home developments.</p>\n";
        }
        
        wp_reset_postdata(); // Restore original Post Data

        ?>

        <h5>Past Sites Portfolio</h5>
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

          echo "<ul class=\"no-style\">\n".
               "    <li><a href=\"/portfolio/\" title=\"Past New Home Developments Portfolio\"><strong>Portfolio Homepage</strong></a></li>\n";

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
          <li><a href="/coming-soon/">Coming Soon</a></li>
          <li><a href="/opendays/">Open Days</a></li>
          <li><a href="/helptobuy/">Help to Buy</a></li>
          <li><a href="/land/">Selling your land</a></li>
          <li><a href="/lapland/">Lapland</a></li>
          <li><a href="/hearthouse/">The Heart House</a></li>
          <li><a href="/spec/">Our Spec</a></li>
          <li><a href="/aftercare/">After Care</a></li>
          <li><a href="/buyers-faq/">Buying FAQ</a></li>
          <li><a href="/awards/">Awards</a></li>
        </ul>
      </div>

      <div class="footer-right six columns">
        <h5 class="ntm">Be the 1st to hear about our latest New Home developments</h5>
        <p><a href="/subscribe/">Subscribe Today</a></p>
        <h5>Get in Touch</h5>
        <p><span>0121 709 0539</span> <span><?php echo do_shortcode('[email mailto="enquiries@damsonhomes.net"]')?></span></p>
        <address class="grmb">Damson Homes, Damson Court, 87 Westley Road, Birmingham, B27 7UQ</address>
        <p><a href="/privacy-policy/">Privacy Policy</a> | <a href="/terms/">Terms</a></p>
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
