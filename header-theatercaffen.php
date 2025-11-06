<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header class="container-fluid theater-site-header">

    <!-- Language Selector (Top Row) -->
    <div class="language-nav1 container d-flex">

      <ul class="language-list ">
        <!-- <li class="language-item"><a href="/en" class="language-link">EN</a></li>
        <li class="language-item">/</li>
        <li class="language-item"><a href="/no" class="language-link">NO</a></li> -->
      </ul>
    </div>

    <!-- Main Header Content -->
    <div class="container" id="header" class="d-flex flex-column align-items-center">

      <!-- Logo -->
      <?php
      $logo = get_field('theater_site_logo', 'option');
      if ($logo): ?>
        <div class="logo" id="logo">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
          </a>
        </div>
      <?php endif; ?>

      <!-- Navigation -->
      <nav class="main-nav">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'theater_menu',
          'menu_class' => 'theater-nav',
          'container' => 'nav',
        ));
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
                wp_nav_menu(array(
                  'theme_location' => 'mega-menu-theatercafeen',
                  'menu_class' => 'theater-nav',
                  'container' => 'nav',
                ));
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

    <!-- Sticky Header Scroll JS -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const header = document.querySelector('.theater-site-header');
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