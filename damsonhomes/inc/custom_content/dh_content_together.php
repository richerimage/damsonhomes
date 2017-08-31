<?php

/*
 * 
 * Template Name: Property Listings
 * 
 *
 * 
 */

add_action('dh_custom_template', 'dh_together_content');

function dh_together_content() {

  if(is_page('together')) { 

    global $post;

    get_header(); 

    $counter = 0; 
    $prehead    = get_post_meta($post->ID, 'dh_prehead', true) ? '<h5 class="pre-head">' . get_post_meta($post->ID, 'dh_prehead', true) . '</h5>' : '';
    $subhead    = get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

    $hero       = get_post_meta($post->ID, 'dh_has_hero', true) ? get_post_meta($post->ID, 'dh_has_hero', true) : '';

    $hero_class = (!empty($hero) ? ' ' . $hero : '');

    ?>

    <section id="hero_area" class="hero-area<?php echo $hero_class; ?>">
      <div class="row hero-box">
        <div class="hero-left six columns">
          <header class="headline-area">
            <?php echo $prehead;
            the_title( '<h1 class="headline archive-headline h2">', '</h1>' );
            echo $subhead; ?>
          </header>
            <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
              <div class="post-content archive-description">
                <?php the_content(); ?>
            </div>
            <?php } } else {} ?>
          <?php dh_social_share($type); ?>
        </div>
      </div>
    </section>
    <?php do_action('dh_before_main_content'); ?>
    <section id="primary" class="content-area bg-white">
      <main id="main_content" class="main-content row listings" role="main">
        <div class="headline-wrapper twelve columns text-center">
            <h2 class="headline h2 ntm"><span style="width: 90%; max-width: 16em; display: inline-block; margin-bottom: 0.5em;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2920 650" title="Damson Together"><defs><style>.cls-1{fill:#c08802;}.cls-2{fill:#fff;}.cls-3{fill:#6b1c56;}</style></defs><title>dh-together-logo-long</title><g id="dht-logo-long"><g id="icon"><path id="heart" class="cls-1" d="M352.47,588.76,350,590.24l-1.47-.92C-119.7,307.95,41,36.38,214.78,39.66a140,140,0,0,1,16.75,1.23C301.47,49.36,334.43,88.16,350,121.55c15.52-33.36,48.52-72.19,118.49-80.34,179.15-22.07,365.75,257.28-116,547.56Z"/><g id="dh"><path id="dh-h" class="cls-2" d="M326.81,449.55q12.1-1.62,15.86-6T346.44,423V281.34q0-8.26-2.14-12.17t-10.4-3.91a22.44,22.44,0,0,0-3.17.22l-3.47.52v-5.31q6.49-1.92,16-4.65t13.21-3.91l14.16-4.43.29,1v90.59q9.3-10.62,16.53-15.64a48.8,48.8,0,0,1,28-8.85q23.9,0,32.61,20.07,4.72,10.62,4.72,27.89V423q0,15.64,3.62,20.36t14.83,6.2v4.13H407.37v-4.13q12.84-1.77,16.53-6T427.59,423V363.23q0-14.31-4.79-23.16t-18.07-8.85q-11.51,0-22.28,8.26t-10.77,10.77V423q0,16.53,3.84,20.66t16.38,5.9v4.13H326.81Z"/><path id="dh-d" class="cls-3" d="M361.12,359.14q-10,0-12.36-3.78t-2.33-13.23l0-7.35,0,.07v-53.5q0-8.26-2.14-12.17t-10.4-3.91a22.44,22.44,0,0,0-3.17.22l-3.47.52v-5.31q6.49-1.92,16-4.65l3.39-1,.08-31.69q0-8.58.15-17.37t.29-17.08l.29-15.26-.87-.29q-5.38,2-7.7,2.76-4.94,1.74-11.48,3.63t-13.08,3.63l-11.92,3.05v4.8q4.51-.44,5.81-.58a28.5,28.5,0,0,1,3.05-.15q7.41,0,9.37,3.34t2,12.21V252.3a46.57,46.57,0,0,0-11.19-8.43,41.3,41.3,0,0,0-19.48-4.65q-26.6,0-45,22.6T228.55,316q0,25.15,15.34,44.26t40,19.11a45.85,45.85,0,0,0,24.57-6.54q6-3.78,14.1-12.65V378l1,1.31,22.82-8.58,21.08-7.27v-4.8a23.52,23.52,0,0,1-3.2.36Q362.72,359.14,361.12,359.14ZM322.6,344.31q0,6-7,12.65t-18.31,6.69q-21.51,0-32.34-18.32t-10.83-41.72q0-23.69,10.18-39.9T292.8,247.5q9.59,0,19.7,7.78T322.6,282Z"/></g></g><g id="text"><path id="together" class="cls-1" d="M2883.64,365.48c-2.28,0-4.17.38-5.31,2.28C2867.7,381.42,2854,389,2844.54,389c-5.31,0-8.73-3.42-8.73-8.73,0-14.42,30.74-44.79,49.34-61.48a7,7,0,0,0,1.9-4.55c0-4.55-3.42-10.63-8.35-10.63-3.42,0-10.25,2.28-17.84,2.28-4.55,0-12.9-1.52-12.9-4.93,0-3.8,6.07-7.59,6.07-11.76,0-4.55-6.45-7.59-11-7.59a6.88,6.88,0,0,0-5.31,1.9c-28.09,27.71-47.82,46.68-55.79,53.51l-.21.19c-8.76,7.5-68.48,57.88-114,57.88-10.63,0-15.56-4.18-15.56-15.94a21.79,21.79,0,0,1,.38-4.55c47.06-.76,93-27.71,93-59.21,0-12.9-8.35-19.36-19.74-19.36-29.82,0-71,24.39-92.19,54.38-20.1,16.87-53.61,42.79-71.76,42.79-4.55,0-7.21-4.18-7.21-8.73,0-11.77,16.7-28.85,31.88-41.37,10.25-8.73,31.88-22,31.88-28.85,0-5.69-5.31-15.56-11-15.56-14.42,0-60,22-102.48,52a620.48,620.48,0,0,1,44.41-52C2648,204.94,2704.89,151,2784.22,66c8.73-9.11,12.9-16.7,12.9-22,0-4.55-3-6.83-7.59-6.83-6.45,0-15.18,3.8-25,12.15-49.34,41.37-133.22,121.45-211.4,211.4-29.6,30.74-70.21,69.46-78.18,76.29l-.34.3c-11.27,9.73-57.51,52.83-73.66,52.83-6.83,0-11-4.93-11-11.39,0-15.18,10.63-30.36,23.53-45.92,23.15-22,51.62-50.1,78.94-78.56h24.29c8,0,19.74-9.87,19.74-15.56,0-3-1.9-4.55-6.45-5.31l-15.56-1.52c24.29-26.19,46.3-51.24,59.21-67.94,4.55-6.45,6.83-11.76,6.83-15.18a5,5,0,0,0-5.31-5.31c-3.8,0-9.11,2.28-14.8,6.83-18.22,14.8-50.48,43.27-84.26,76.29a582.07,582.07,0,0,0-71.35,5.69c-14.8,2.28-26.19,12.15-26.19,18.22,0,2.28,2.28,3.8,7.59,3.8h62.62c-20.67,23.22-48,53.69-66.13,83.15-9.64,8.23-68.65,57.66-113.76,57.66-10.63,0-15.56-4.18-15.56-15.94a21.79,21.79,0,0,1,.38-4.55c47.06-.76,93-27.71,93-59.21,0-12.9-8.35-19.36-19.74-19.36-30,0-71.47,24.64-92.51,54.83-14.9,12.43-39.31,30.57-79.8,51.44-6.45,3.8-12.9,6.45-19.36,9.49l28.09-31.88c28.85-33,45.16-50.1,53.51-58.07,3.42-3.42,3.8-6.07,3.8-7.59,0-7.21-6.45-15.18-11-15.18-1.52,0-4.55.76-8.73,4.18l-17.84,15.56c-3.42-11.77-14-20.87-31.5-20.87-31.6,0-71.25,20.37-93.89,47.65-7.3,4.5-15,7.38-23.38,7.38a21.1,21.1,0,0,1-8.73-1.52c5.31-10.63,8.35-20.5,8.35-30.36,0-16.32-8.35-28.85-31.5-28.85-30.21,0-70.78,23.77-93.27,52.42-17.61,15.62-51.92,45.5-65.37,45.5-6.83,0-11-4.93-11-11.39,0-15.18,10.63-30.36,23.15-45.92,23.53-22,52-50.1,79.32-78.56h112.34c8.35,0,19.74-9.87,19.74-15.56,0-3-1.52-4.55-6.07-5.31-30.36-3.42-63.38-6.45-99.06-6.83,22.77-24.29,42.51-47.06,54.27-62.62,4.55-6.45,6.83-11.76,6.83-15.18a5,5,0,0,0-5.31-5.31c-3.8,0-9.11,2.28-14.8,6.83-18.22,14.8-50.86,43.27-84.26,76.29a588.11,588.11,0,0,0-71.73,5.69c-14.42,2.28-25.81,12.15-25.81,18.22,0,2.28,2.28,3.8,7.21,3.8h63c-20.5,22.77-47.82,52.76-65.66,82-11,9.87-41.37,35.3-68.7,49.34-3.42,1.9-4.55,4.18-4.55,6.83,0,5.31,5.31,11.77,11.76,11.77a11.43,11.43,0,0,0,4.55-1.14,229.43,229.43,0,0,0,38.33-25,69,69,0,0,0-1.14,12.15c0,18.22,9.87,28.46,24.29,28.46,17.05,0,41-16.58,61.87-33.8,0,.13,0,.27,0,.41,0,23.53,11.39,35.68,34.16,35.68,28.46,0,61.11-19,83.12-44.41,4.55,2.28,10.25,3.42,17.46,3.42a47.44,47.44,0,0,0,13.78-2.12A51.94,51.94,0,0,0,2039.6,389c0,18.22,8.73,29.6,26.19,29.6,22,0,45.92-14.8,66-31.12-12.15,14.42-25.43,28.47-39.47,42.13-25,10.63-48.58,19.74-65.66,28.09-73.25,36.06-165.48,88.05-165.48,130.56,0,18.22,13.28,23.91,23.91,23.91,45.92,0,136.25-78.56,217.85-165.1,23.53-9.87,47.44-19.74,64.14-28.85a572.72,572.72,0,0,0,54-33c0,.87-.08,1.74-.08,2.61,0,16.32,14.8,30.74,34.92,30.74,38.87,0,81.58-24.42,109.56-43.95a61.59,61.59,0,0,0-2.17,15.48c0,18.22,9.87,28.46,24.29,28.46,23.23,0,59.22-30.76,82.9-52-6.66,9.58-13,19-19.53,28.87-2.28,3.42-5.31,7.59-5.31,10.63,0,3.8,8.35,10.25,14,10.25,3,0,6.45-3.42,10.63-8,25.43-28.09,46.3-45.54,84.26-66.42-17.46,16.32-30,32.64-30,50.1,0,15.18,11.77,25.43,27.33,25.43,20.73,0,46.51-15.15,68-31,0,.47,0,.93,0,1.4,0,16.32,14.8,30.74,34.92,30.74,61.11,0,131.7-60.35,139.67-67.18l.14-.13c8.07-6.94,28-25.71,32.49-30.61,1.9,4.55,8.73,8.73,17.08,8.73-6.45,6.83-39.47,36.06-39.47,64.52,0,10.25,4.55,23.15,23.53,23.15,42.51,0,64.52-38.33,64.52-43.65C2892.75,369.28,2887.43,365.48,2883.64,365.48ZM1991,346.13c0,6.83,1.14,12.9,3.8,17.84-3.8,4.17-9.87,8.73-15.94,13.66-18.22,12.15-32.26,17.46-42.51,17.46-9.87,0-17.46-6.07-17.46-16.32,0-13.28,12.9-30.36,28.47-41.75,17.46-12.9,34.92-19.74,47.44-19.74a25.69,25.69,0,0,1,11.77,2.66C1997.48,323,1991,333.22,1991,346.13Zm-96,239.11c-3,0-5.31-.38-5.31-4.55,0-15.56,72.49-63.76,133.6-97.54,8.73-4.55,19-9.87,31.5-15.18C1986.08,533.62,1917,585.24,1895,585.24Zm184.46-193.94c-8,0-10.25-3.8-10.25-8.73,0-24.29,53.89-61.86,79.7-61.86,11,0,15.56,6.83,17.08,13.66C2134.1,362.83,2100.7,391.29,2079.45,391.29Zm238-74c5.31,0,7.21,3.42,7.21,6.83,0,12.15-36.82,33.78-63.38,33.78C2275.28,337,2304.89,317.28,2317.41,317.28Zm398.86,0c5.31,0,7.21,3.42,7.21,6.83,0,12.15-36.82,33.78-63.38,33.78C2674.14,337,2703.75,317.28,2716.27,317.28Z"/><g id="damson"><path id="n" class="cls-3" d="M1597.24,286.64q25.82-31.12,49.25-31.12,12,0,20.69,6t13.8,19.81q3.53,9.62,3.53,29.52v62.72q0,14,2.25,18.93a13.16,13.16,0,0,0,5.69,6.26Q1696.38,401,1707,401v5.77H1634.3V401h3q10.26,0,14.36-3.13a16.4,16.4,0,0,0,5.69-9.22q.64-2.41.64-15.08V313.43q0-20.05-5.21-29.12t-17.57-9.06q-19.09,0-38,20.85v77.48q0,14.92,1.76,18.45a14.82,14.82,0,0,0,6.18,6.82q3.93,2.17,16,2.17v5.77h-72.67V401h3.21q11.23,0,15.16-5.69t3.93-21.74V319q0-26.47-1.2-32.24t-3.69-7.86a10,10,0,0,0-6.66-2.09,30.83,30.83,0,0,0-10.75,2.41l-2.41-5.77,44.27-18h6.9Z"/><path id="o" class="cls-3" d="M1462,255.53q33.36,0,53.58,25.34a77.84,77.84,0,0,1,17.16,49.73q0,19.73-9.46,39.94T1497.23,401a68.91,68.91,0,0,1-37,10.27q-33.21,0-52.78-26.47a82,82,0,0,1-16.52-50q0-20.21,10-40.18t26.39-29.51A67.71,67.71,0,0,1,1462,255.53ZM1457,266A33.44,33.44,0,0,0,1440,271q-8.58,5.05-13.88,17.72t-5.29,32.56q0,32.08,12.75,55.34t33.61,23.26q15.56,0,25.67-12.83t10.11-44.11q0-39.14-16.84-61.6Q1474.68,266,1457,266Z"/><path id="s" class="cls-3" d="M1357.27,255.53v50H1352q-6.1-23.58-15.64-32.08T1312,265q-11.23,0-18.13,5.94t-6.9,13.15a23.87,23.87,0,0,0,5.13,15.4q5,6.58,20.21,14l23.42,11.39q32.56,15.88,32.56,41.87,0,20.05-15.16,32.32a52.57,52.57,0,0,1-33.93,12.27q-13.48,0-30.8-4.81a31.37,31.37,0,0,0-8.66-1.6q-3.69,0-5.77,4.17h-5.29V356.58H1274q4.49,22.46,17.16,33.85t28.39,11.39q11.07,0,18-6.5a20.61,20.61,0,0,0,7-15.64,24.89,24.89,0,0,0-7.78-18.61q-7.78-7.54-31-19.09t-30.48-20.85q-7.22-9.14-7.22-23.1,0-18.13,12.43-30.32t32.16-12.19q8.66,0,21,3.69,8.18,2.4,10.91,2.41a6.38,6.38,0,0,0,4-1.12q1.44-1.12,3.37-5Z"/><path id="m" class="cls-3" d="M1050.4,286.81q16-16,18.93-18.45a57.3,57.3,0,0,1,15.56-9.46,43.87,43.87,0,0,1,16.52-3.37q13.79,0,23.74,8t13.31,23.26q16.52-19.25,27.91-25.27a49.56,49.56,0,0,1,23.42-6,36.71,36.71,0,0,1,20.77,6q9.06,6,14.36,19.65,3.53,9.3,3.53,29.19v63.2q0,13.8,2.09,18.93a13.62,13.62,0,0,0,5.94,6q4.33,2.49,14.12,2.49v5.77h-72.51V401h3q9.46,0,14.76-3.69,3.69-2.56,5.29-8.18.64-2.73.64-15.56v-63.2q0-18-4.33-25.34-6.26-10.26-20.05-10.27a38.23,38.23,0,0,0-17.08,4.25q-8.58,4.25-20.77,15.8l-.32,1.76.32,6.9v70.1q0,15.08,1.68,18.77a13.63,13.63,0,0,0,6.34,6.18q4.65,2.49,15.88,2.49v5.77h-74.27V401q12.19,0,16.76-2.89a15,15,0,0,0,6.34-8.66q.8-2.72.8-15.88v-63.2q0-18-5.29-25.83-7.06-10.26-19.73-10.27a35.42,35.42,0,0,0-17.16,4.65q-13.32,7.06-20.53,15.88v78.76q0,14.44,2,18.77a13.78,13.78,0,0,0,5.94,6.5q3.93,2.17,16,2.17v5.77h-72.67V401q10.11,0,14.12-2.17a13.87,13.87,0,0,0,6.1-6.9q2.08-4.73,2.09-18.37V317.44q0-24.22-1.44-31.28-1.12-5.29-3.53-7.3a10,10,0,0,0-6.58-2,30.82,30.82,0,0,0-10.75,2.41l-2.41-5.77,44.27-18h6.9Z"/><path id="a" class="cls-3" d="M944.21,385.62q-22.62,17.49-28.39,20.21a43.43,43.43,0,0,1-18.45,4q-15.24,0-25.1-10.43T862.4,372a35,35,0,0,1,4.81-18.61q6.58-10.91,22.86-20.53t54.14-23.42v-5.77q0-22-7-30.16t-20.29-8.18q-10.11,0-16,5.45-6.1,5.46-6.1,12.51l.32,9.3q0,7.38-3.77,11.39a12.91,12.91,0,0,1-9.87,4,12.48,12.48,0,0,1-9.71-4.17Q868,299.64,868,292.42q0-13.79,14.12-25.34t39.62-11.55q19.57,0,32.08,6.58a30.25,30.25,0,0,1,14,15.56q2.89,6.9,2.89,28.23v49.89q0,21,.8,25.75t2.65,6.34a6.28,6.28,0,0,0,4.25,1.6,8.76,8.76,0,0,0,4.49-1.12q3.37-2.08,13-11.71v9q-18,24.06-34.33,24.06-7.86,0-12.51-5.45T944.21,385.62Zm0-10.43v-56q-24.22,9.62-31.28,13.64-12.67,7.06-18.13,14.76a28.52,28.52,0,0,0-5.45,16.84q0,11.55,6.9,19.17t15.88,7.62Q924.31,391.23,944.21,375.19Z"/><path id="d" class="cls-3" d="M800.48,390.27q-10.75,11.23-21,16.12a50.82,50.82,0,0,1-22.14,4.89q-24.06,0-42-20.13t-18-51.73q0-31.6,19.89-57.83t51.17-26.23q19.41,0,32.08,12.35V240.61q0-25.18-1.2-31t-3.77-7.86a9.85,9.85,0,0,0-6.42-2.09q-4.17,0-11.07,2.57l-2.09-5.61,43.79-18h7.22V348.56q0,25.83,1.2,31.52T832,388a9.24,9.24,0,0,0,6.18,2.25q4.33,0,11.55-2.73l1.76,5.61-43.63,18.13h-7.38Zm0-11.23V303.33a51.2,51.2,0,0,0-5.77-19.89,33.31,33.31,0,0,0-12.75-13.55,31,31,0,0,0-15.48-4.57q-14.12,0-25.18,12.67-14.6,16.69-14.6,48.77,0,32.4,14.12,49.65t31.44,17.24Q786.84,393.64,800.48,379Z"/></g></g></g></svg></span></h2>
          </div>

        <?php do_action('dh_main_content_top');


        $current_page = get_query_var('paged');
        $classes      = array('columns', 'card', 'post-card', 'card-' . $counter);

        $args = array(
          'post_type' => 'dnh_cpt_together',
          'post_parent' => 0,
          'orderby' => 'menu_order',
          'order'   => 'ASC',
          'posts_per_page' => 8,
          'paged'   => $current_page
        );

        // The Query
        $query = new WP_Query( $args );

        // The Loop
        if ( $query->have_posts() ) {

          while ( $query->have_posts() ) {
            $query->the_post(); ?>
            

            <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
              <a class="block-link xv" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                <?php get_template_part( 'templates/template-parts/modules/card-together'); ?>
            </a>
            </article><!-- #post-## -->

          <?php } ?>

        <?php } 

        // Restore original Post Data
        wp_reset_postdata();
        do_action('dh_main_content_bottom'); ?>


      </main>

      <?php if ($query->max_num_pages > 1) { ?>

      <div class="pagation-wrap row">
        <nav class="pagation-nav twelve columns">
        <?php echo paginate_links(array('total' => $query->max_num_pages)); ?>
        </nav>
      </div>

      <?php } ?>

      
      <?php do_action('dh_after_main_content'); ?>

    </section>
    <?php do_action('dh_after_main_content_area');

    get_footer(); 

  }

}
