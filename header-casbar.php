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



</head>

<body <?php body_class(); ?>>

  <header class="container-fluid site-header-casbar">

    <div class="header-container-casbar container d-flex justify-content-between ">

      <!-- Logo -->
      <?php
      $logo = get_field('logo_casbar', 'option');
      if ($logo): ?>
        <div class="logo" id="logo">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
          </a>
        </div>
      <?php endif; ?>

      <!-- Language Selector -->
       <!-- <div class="language-nav1"> -->
        <!-- <ul class="language-list d-flex align-items-center">
          <li class="language-item"><a href="/en" class="language-link">EN</a></li>
          <li class="language-item mx-2">/</li>
          <li class="language-item"><a href="/no" class="language-link">NO</a></li>
        </ul> -->
      <!-- </div>  -->
    </div>

    <!-- Main Header Content -->
    <!-- <div class="container" id="header" class="d-flex flex-column align-items-center">

      

    <!-- Sticky Header Scroll JS -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const header = document.querySelector('.site-header-casbar');
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