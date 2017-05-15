<?php

function dh_fancybox_video_handle() { ?>

  $('[data-fancybox="video"]').fancybox({
    afterLoad : function( instance, current ) {

       // Remove scrollbars and change background
      current.$content.css({
        overflow   : 'visible',
        background : '#000'
      });
            
    },
    onUpdate : function( instance, current ) {
      var width,
          height,
          ratio = 16 / 9,
          video = current.$content;
      
      if ( video ) {
        video.hide();

        width  = current.$slide.width();
        height = current.$slide.height() - 100;
        
        if ( height * ratio > width ) {
          height = width / ratio;
        } else {
          width = height * ratio;
        }

        video.css({
          width  : width,
          height : height
        }).show();

      }
    }
  })

<?php }

add_action( 'dh_footer_doc_ready', 'dh_fancybox_video_handle' );
