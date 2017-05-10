<?php 

  // Brochure Link 

  // https://css-tricks.com/snippets/javascript/get-url-variables/ 

  $load_on_page = array(
    'brochure', 
    'register', 
    'reserve',  
    'subscribe',
    'viewing'
  );

  // if (is_page( array('brochure', 'viewing', 'reserve' ))) { 

  if (is_page($load_on_page)){ ?>

  <script id="dh_brochure_uri">
  
    jQuery(document).ready(function($) {

      function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
          var pair = vars[i].split("=");
          if(pair[0] == variable){return pair[1];}
         }
       return(false);
      }

      var type      = decodeURIComponent(getQueryVariable('dh_type'));
      var option    = decodeURIComponent(getQueryVariable('dh_option'));
      var name      = decodeURIComponent(getQueryVariable('dh_site_name'));
      var thumb     = decodeURIComponent(getQueryVariable('dh_logo'));
      var link      = decodeURIComponent(getQueryVariable('dh_link'));
      var source    = decodeURIComponent(getQueryVariable('dh_source'));
      var image     = decodeURIComponent(getQueryVariable('dh_image'));
      var plot      = decodeURIComponent(getQueryVariable('dh_plot_no'));
      var val       = decodeURIComponent(getQueryVariable('dh_plot_val'));
      var desc      = decodeURIComponent(getQueryVariable('dh_plot_desc'));




      if (type !== 'false') {

        $('#dl_form').show();
        $('#default_content').remove();
        $('.gform_confirmation_wrapper').addClass('xv box');


        if (type == 'brochure') {

          $('#sub_head').html('<em>The</em> ' + name + ' Brochure');

        } 

        if (type == 'viewing') {

          $('#sub_head').html('<em>at</em> ' + name);

        }

        if (type == 'reserve') {

          $('#sub_head').html('<em>for</em> Plot ' + plot + ', ' + name);
          // $('#dl_form').addClass('xv box');
          $('#plot_details').html('<p><strong>Plot ' + plot + '</strong> £' + val + '<br /> ' + desc + '</p>').addClass('call-out');
          $('.gform_footer').append('<div class="aside" style="color: #222; margin-top: 1em;"><p>Making a Reservation Request is free of charge and without any obligation to proceed to purchase.</p></div>');

        }

        if (type == 'register') {

          $('#sub_head').html('<em>in</em> ' + name);
          $('.gform_footer').append('<div class="aside" style="color: #222; margin-top: 1em;"><p>Registering your interest is free of charge and without any obligation to proceed to purchase.</p></div>');

          if(option == 'dh_reserve_buyer') {

            $('#site_intro_wrap').append('<div class="alert"><h4 class="ntm">Please let us know if you missed out on your favourite plot in ' + name + '.</h4><p>Drop in your contact details below and should the sale, for any reason, not go through, we will contact you before offering it out to the open market.</p></div>');
          
          } else {

            $('#site_intro_wrap').append('<div class="alert box xv"><h4 class="ntm">Interested in our upcoming new home development, ' + name + '?</h4><p>Subscribe for pre-release information and opportunities by entering your name and email into the form below.</p><p><strong>Subscribing is the smartest way to get your choice of the best plots!</strong> As with our other developments, we will be contacting our subscribers before offering ' + name + ' to the open market.</p></div>');

          }


        }


        if (thumb !== 'false') {

          $('#site_logo').attr('src', thumb);

        } 


        if (image !== 'false') {

          $('.wp-post-image').attr('src', image);

        }

      }


    });

  </script>

  <?php }


