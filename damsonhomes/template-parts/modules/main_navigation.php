<?php 

function dh_main_navigation(){ ?>
  <nav id="site-navigation" class="nav-area" role="navigation">
  <div class="container">
    <?php wp_nav_menu( 
      array( 
        'theme_location' => 'menu-1', 
        'menu_id'     => 'primary-menu',
        'menu_class'  => 'menu primary-menu',
        'container'   => false 
      )
    ); ?>
    
    <div id="hamburger_menu" class="hamburger-menu">
      <div class="bar"></div> 
    </div>

    <?php wp_nav_menu( 
      array(
        'theme_location' => 'menu-2',
        'menu_id'     => 'main-menu',
        'menu_class'  => 'menu dna-nav',
        'container'   => false 
      )
    ); ?>
  </div> <!-- .nav-area .page -->
</nav><!-- #site-navigation -->

<?php } 