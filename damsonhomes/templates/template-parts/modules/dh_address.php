<?php

function dh_address() { ?>


<div class="dh-address mb has-icon" itemscope itemtype="http://schema.org/LocalBusiness">

  <?php echo dh_get_svg(array('icon' => 'location')); ?>

  <p class="nbm"><strong><span itemprop="name">Damson Homes</span></strong></p>

  <link itemprop="url" href="https://damsonhomes.net/">

  <link itemprop="sameAs" href="https://www.facebook.com/damsonnewbuild/">

  <link itemprop="hasMap" href="https://www.google.co.uk/maps/place/Damson+Homes/@52.4463633,-1.8291047,17z/data=!3m1!4b1!4m5!3m4!1s0x4870b9e3f6d78d65:0xdc397db4b18bcf21!8m2!3d52.4463633!4d-1.826916?hl=en">

  <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

    <span class="address-part" itemprop="streetAddress">87 Westley Road</span>

    <span class="address-part" itemprop="addressLocality">Birmingham</span>

    <span class="address-part" itemprop="postalCode">B27 7UQ</span>

  </p>

   

  <span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">

    <meta itemprop="latitude" content="52.4461088" />

    <meta itemprop="longitude" content="-1.8269067" />

  </span>

</div>


<?php }

/*
 *
 *   Resource
 *
 *   https://whitespark.ca/blog/why-your-local-business-schema-sucks-and-how-to-make-it-better/
 *
 *
 */
