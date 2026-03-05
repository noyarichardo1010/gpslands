<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    <?php bloginfo('name'); ?><?php wp_title('|'); ?>
  </title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="wrap-gps-header">
  <nav class="navbar navbar-expand-lg navbar-dark gps-navbar">
    <div class="container">

    
      <!-- LOGO -->
      <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>">

      <?php
      $logo_default = get_template_directory_uri() . '/images/logo.png';
      $logo_product = get_template_directory_uri() . '/images/logo3.png';

      $is_brand_or_single_product = $is_brand_or_single_product =
      is_tax('brand-products') ||
      is_singular('our-products') ||
      is_tax('industry') ||
      is_tax('tags-gps') ||
      is_singular('sertifikasi')||
      is_singular('post'); 
      ?>

      <img 
        src="<?php echo esc_url($is_brand_or_single_product ? $logo_product : $logo_default); ?>"
        alt="<?php bloginfo('name'); ?>"
        class="gps-logo"
      >
      </a>

      <!-- Mobile LANGUAGE -->
      <div class="gps-lang mobile-only">
          <a href="#" data-lang="id" class="lang-btn">ID</a>
          <a href="#" data-lang="en" class="lang-btn">EN</a>
      </div>

      <!-- TOGGLE MOBILE -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#gpsNavbar">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <i class="fas fa-bars"></i>
      </button>



      <!-- MENU -->
      <div class="collapse navbar-collapse justify-content-end" id="gpsNavbar">

        <?php
          wp_nav_menu([
            'theme_location' => 'primary_menu',
            'container'      => false,
            'menu_class'     => 'navbar-nav mb-2 mb-lg-0',
            'fallback_cb'    => false,
            'depth'          => 3,
            'walker'         => new Bootstrap_Navwalker(),
          ]);                  
        ?>

        <!-- LANGUAGE -->
        <div class="gps-lang ms-lg-4">
          <a href="#" data-lang="id" class="lang-btn">ID</a>
          <a href="#" data-lang="en" class="lang-btn">EN</a>
        </div>


      </div>

    </div>
  </nav>
</header>
