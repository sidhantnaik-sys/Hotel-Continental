<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <!-- In header.php or enqueue -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Gilda+Display&family=Instrument+Sans&display=swap"
    rel="stylesheet">
  
  <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="f2444c9d-23e9-4624-9ac0-05e32ac419cf" data-blockingmode="auto" type="text/javascript"></script>

</head>

<body <?php body_class(); ?>>

  <header class="container-fluid site-header">
    <div class="header-container container d-flex justify-content-between p-0 ">

      <!-- Logo -->
      <?php
      $logo = get_field('site_logo', 'option');
      if ($logo): ?>
        <div class="logo" id="logo">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
          </a>
        </div>
      <?php endif; ?>

      <!-- Language Selector -->
      <!-- <div class="language-nav1">
        <ul class="language-list d-flex align-items-center">
          <li class="language-item"><a href="#" class="language-link">EN</a></li>
          <li class="language-item mx-2">/</li>
          <li class="language-item"><a href="#" class="language-link">NO</a></li>
        </ul>
      </div> -->
    </div>

    <!-- Main Header Content -->
    <div class="container " id="header" class="d-flex flex-column align-items-center">




      <!-- Navigation -->
      <nav class="main-nav">
        <?php
        wp_nav_menu([
          'theme_location' => 'primary-menu',
          'menu_class' => '',
          'container' => false,
        ]);
        ?>
      </nav>

      <!-- Hamburger Icon (Mobile only) -->
      <div class="hamburger-menu " aria-label="Toggle menu">
        <span class="line top"></span>
        <span class="line middle"></span>
        <span class="line bottom"></span>
      </div>


      <div class="mega-menu">
        <div class="mega-menu-content container">
          <div class="row w-100">

            <!-- Left Column -->
            <div class="col-md-4">
              <nav class="main-menu">
                <?php
                wp_nav_menu([
                  'theme_location' => 'mega-menu',
                  'menu_class' => 'mega-nav',
                  'container' => false
                ]);
                ?>
              </nav>
            </div>

            <!-- Middle Column -->
            <div class="col-md-3">
              <div class="submenu-panel">
                <div class="submenu-list"></div>
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-5 submenu-image p-0">

              <img src="" alt="">

            </div>

          </div>
        </div>
      </div>

    </div>


    </div>


    </div>

    <!-- Sticky Header Scroll JS -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const header = document.querySelector('.site-header');
        window.addEventListener('scroll', function () {
          if (window.scrollY > 50) {
            header.classList.add('scrolled');
          } else {
            header.classList.remove('scrolled');
          }
        });
      });







    </script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  </header>