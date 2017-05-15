<?php 

function dh_slick_trigger() {
  
  echo "    \$('[data-gallery=\"slider\"]').slick({
                autoplay: false,
                adaptiveHeight: true,
                arrows: true,
                dots: true,
                mobileFirst: true,
                nextArrow: '<button type=\"button\" class=\"slick-buttons slick-next\"><svg class=\"icon icon-arrow-right\" aria-hidden=\"true\" role=\"img\"><use href=\"#icon-arrow-right\" xlink:href=\"#icon-arrow-right\"></use></svg></button>',
                prevArrow: '<button type=\"button\" class=\"slick-buttons slick-prev\"><svg class=\"icon icon-arrow-left\" aria-hidden=\"true\" role=\"img\"><use href=\"#icon-arrow-left\" xlink:href=\"#icon-arrow-left\"></use></svg></button>',
            });\n";
  
}

add_action( 'dh_footer_doc_ready', 'dh_slick_trigger' );