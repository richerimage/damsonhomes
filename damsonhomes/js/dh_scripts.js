// START OF DNA SCRIPTS ----

document.body.classList.remove('no-js');


/**
 * jQuery-viewport-checker - v1.8.7 - 2015-12-17
 * https://github.com/dirkgroenen/jQuery-viewport-checker
 *
 * Copyright (c) 2015 Dirk Groenen
 * Licensed MIT <https://github.com/dirkgroenen/jQuery-viewport-checker/blob/master/LICENSE>
 */

!function(a){a.fn.viewportChecker=function(b){var c={classToAdd:"visible",classToRemove:"invisible",classToAddForFullView:"full-visible",removeClassAfterAnimation:!1,offset:100,repeat:!1,invertBottomOffset:!0,callbackFunction:function(a,b){},scrollHorizontal:!1,scrollBox:window};a.extend(c,b);var d=this,e={height:a(c.scrollBox).height(),width:a(c.scrollBox).width()},f=-1!=navigator.userAgent.toLowerCase().indexOf("webkit")||-1!=navigator.userAgent.toLowerCase().indexOf("windows phone")?"body":"html";return this.checkElements=function(){var b,g;c.scrollHorizontal?(b=a(f).scrollLeft(),g=b+e.width):(b=a(f).scrollTop(),g=b+e.height),d.each(function(){var d=a(this),f={},h={};if(d.data("vp-add-class")&&(h.classToAdd=d.data("vp-add-class")),d.data("vp-remove-class")&&(h.classToRemove=d.data("vp-remove-class")),d.data("vp-add-class-full-view")&&(h.classToAddForFullView=d.data("vp-add-class-full-view")),d.data("vp-keep-add-class")&&(h.removeClassAfterAnimation=d.data("vp-remove-after-animation")),d.data("vp-offset")&&(h.offset=d.data("vp-offset")),d.data("vp-repeat")&&(h.repeat=d.data("vp-repeat")),d.data("vp-scrollHorizontal")&&(h.scrollHorizontal=d.data("vp-scrollHorizontal")),d.data("vp-invertBottomOffset")&&(h.scrollHorizontal=d.data("vp-invertBottomOffset")),a.extend(f,c),a.extend(f,h),!d.data("vp-animated")||f.repeat){String(f.offset).indexOf("%")>0&&(f.offset=parseInt(f.offset)/100*e.height);var i=f.scrollHorizontal?d.offset().left:d.offset().top,j=f.scrollHorizontal?i+d.width():i+d.height(),k=Math.round(i)+f.offset,l=f.scrollHorizontal?k+d.width():k+d.height();f.invertBottomOffset&&(l-=2*f.offset),g>k&&l>b?(d.removeClass(f.classToRemove),d.addClass(f.classToAdd),f.callbackFunction(d,"add"),g>=j&&i>=b?d.addClass(f.classToAddForFullView):d.removeClass(f.classToAddForFullView),d.data("vp-animated",!0),f.removeClassAfterAnimation&&d.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){d.removeClass(f.classToAdd)})):d.hasClass(f.classToAdd)&&f.repeat&&(d.removeClass(f.classToAdd+" "+f.classToAddForFullView),f.callbackFunction(d,"remove"),d.data("vp-animated",!1))}})},("ontouchstart"in window||"onmsgesturechange"in window)&&a(document).bind("touchmove MSPointerMove pointermove",this.checkElements),a(c.scrollBox).bind("load scroll",this.checkElements),a(window).resize(function(b){e={height:a(c.scrollBox).height(),width:a(c.scrollBox).width()},d.checkElements()}),this.checkElements(),this}}(jQuery);


// lazyload.js (c) Lorenzo Giuliani <img src="blank.gif" data-src="my_image.png" width="600" height="400" class="lazy">
// ! function(a) {
//     function e(a, b) {
//         var c       = new Image,
//             d       = a.getAttribute("data-src");
//             //target  = [data-group="lazy"];
//             // target  = a.getAttribute("data-load");


//         c.onload = function() {
//             a.parent ? a.parent.replaceChild(c, a) : a.src = d, b && b()
//         }, c.src = d
//     }

//     function f(b) {
//         var c = b.getBoundingClientRect();
//         return c.top >= 0 && c.left >= 0 && c.top <= (a.innerHeight || document.documentElement.clientHeight)
//     }
//     for (var b = function(a, b) {
//             if (document.querySelectorAll) b = document.querySelectorAll(a);
//             else {
//                 var c = document,
//                     d = c.styleSheets[0] || c.createStyleSheet();
//                 d.addRule(a, "f:b");
//                 for (var e = c.all, f = 0, g = [], h = e.length; f < h; f++) e[f].currentStyle.f && g.push(e[f]);
//                 d.removeRule(0), b = g
//             }
//             return b
//         }, c = function(b, c) {
//             a.addEventListener ? this.addEventListener(b, c, !1) : a.attachEvent ? this.attachEvent("on" + b, c) : this["on" + b] = c
//         }, g = new Array, h = b('img[data-load="lazy"]'), i = function() {
//             for (var a = 0; a < g.length; a++) f(g[a]) && e(g[a], function() {
//                 g.splice(a, a)
//             })
//         }, j = 0; j < h.length; j++) g.push(h[j]);
//     i(), c("scroll", i)
// }(this);


jQuery(document).ready(function($) {
  $('body').removeClass('no-jq').addClass('jq-loaded');

  var ww = document.body.clientWidth;

  $(document).ready(function($) {
    // $('.dna-nav li a').each(function() {
    //   if ($(this).next().length > 0) {
    //     jQuery(this).addClass('parent');
    //   };
    // })

    $('#hamburger_menu').click(function(e) {
      e.preventDefault();
      $('#hamburger_menu .bar').toggleClass('active');
      $('.dna-nav').toggleClass('active');
    });

    $('#side_menu_trigger').click(function(e) {
      e.preventDefault();
      $('#hamburger_menu_2 .bar').toggleClass('active');
      $('#fly_out_menu').toggleClass('active');
    });

    $('#close_fly_out').click(function(e) {
      e.preventDefault();
      $('#fly_out_menu').removeClass('active');
      $('#hamburger_menu_2 .bar').removeClass('active');
    });
    // adjustMenu();
  })
  // $(window).bind('resize orientationchange', function() {
  //   ww = document.body.clientWidth;
  //   adjustMenu();
  // });
  // var adjustMenu = function() {
  //   if (ww < 768) {
  //     // if 'more' link not in DOM, add it
  //     if (!$('.more')[0]) {
  //       $('<div class="more">&nbsp;</div>').insertBefore($('.parent')); 
  //     }
  //     $('.dna-nav li').unbind('mouseenter mouseleave');
  //     $('.dna-nav li a.parent').unbind('click');
  //     $('.dna-nav li .more').unbind('click').bind('click', function() {
  //       $(this).parent('li').toggleClass('hover');
  //     });
  //   } else if (ww >= 768) {
  //     // remove .more link in desktop view
  //     $('.more').remove();
  //     $('.dna-nav').show();
  //     $('.dna-nav li').removeClass('hover');
  //     $('.dna-nav li a').unbind('click');
  //     $('.dna-nav li').unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
  //       // must be attached to li so that mouseleave is not triggered when hover over submenu
  //       $(this).toggleClass('hover');
  //     });
  //   }
  // }  	

  // Start > DNA Reveal JS
	$('.dh-reveal-wrap').on('click', 'a.reveal', function(e) {
		e.preventDefault();
		$(this).closest('a.reveal').toggleClass('open');
		$(this).closest('.dh-reveal-wrap').find('.reveal-box').slideToggle('medium').toggleClass('open');
	});


// DNA Optin Modal
	// open popup
	$('.dna-popup-trigger').on('click', function(event){
		event.preventDefault();
		$('.dna-popup').addClass('is-visible');
		var winTop = $(window).scrollTop() + 50;
		$('.dna-popup-container').css('margin-top', winTop);
	});
	// close popup
	$('.dna-popup').on('click', function(event){
		if($(event.target).is('.dna-close') || $(event.target).is('.dna-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	// close popup with the esc key
	$(document).keyup(function(event){
		if(event.which=='27'){
			$('.dna-popup').removeClass('is-visible');
		}
	});

  // Start > Smart Resposive Objects
  // var smartRwdo = function() {
  //   $('.sro').each(function() {
  //     var width = $(this).innerWidth();
  //     $(this).removeClass('sro-tiny sro-small sro-med sro-large sro-omg');
  //     if (width < 249) {
  //       $(this).addClass('sro-tiny').removeClass('sro-small sro-med sro-large sro-omg');
  //     } else if (width >= 250 && width < 499) {
  //       $(this).addClass('sro-tiny sro-small').removeClass('sro-med sro-large sro-omg');
  //     } else if (width >= 500 && width < 649) {
  //       $(this).addClass('sro-tiny sro-small sro-med').removeClass('sro-large sro-omg');
  //     } else if (width >= 650 && width < 999) {
  //       $(this).addClass('sro-tiny sro-small sro-med sro-large').removeClass('sro-omg');
  //     } else if (width >= 1000) {
  //       $(this).addClass('sro-tiny sro-small sro-med sro-large sro-omg');
  //     }
  //   });
  // }
  // $(document).ready(function($) {
  //   smartRwdo();
  // });
  // $(window).resize(function(){
  //   smartRwdo();
  // });

	//Start > Social Share Display Switch
	$('.ss-switch').on('click', function(){
		$('.dna_ssb_links').toggleClass('ss-show');
	});
	//END > Social Share Display Switch

	$('.size-medium').parent('.wp-caption').addClass('size-medium');
	$('.wp-caption .size-medium').removeClass('size-medium');
	//END > Social Share Display Switch


  // Tabs - START

  $('.tabs a').click(function(e){
    e.preventDefault();
      var $this = $(this),
        tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),
        others = $this.closest('li').siblings().children('a'),
        target = $this.attr('href');
    others.removeClass('active');
    $this.addClass('active');

    $(tabgroup).children('.tab-content').addClass('tab-bottom').removeClass('tab-top');
    $(target).addClass('tab-top').removeClass('tab-bottom');
  });


  // Tabs End

  /*
   * Test if inline SVGs are supported.
   * @link https://github.com/Modernizr/Modernizr/
   */

  function supportsInlineSVG() {
    var div = document.createElement( 'div' );
    div.innerHTML = '<svg/>';
    return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
  }
  
  if ( true === supportsInlineSVG() ) {
    document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
  }


  $( document ).ready(function() {
    moveThis();
  });

  $( window ).resize( function() {
      moveThis();
  });

  function moveThis(){
      var ww = document.body.clientWidth;
      if (ww >= 768) {
          $( '#dh_social_share' ).appendTo($( '#entry_meta' ) );
      }else{
          $( '#dh_social_share' ).insertBefore($( '#post_content' ) );
      }
  }


  // Add Classes ect

  $('.ftr-section').addClass('clearfix');



// $('html').toggleClass('flexbox no-flexbox');

















});







// END OF DNA SCRIPTS