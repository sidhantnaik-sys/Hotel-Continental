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

    <header class="container-fluid continental-site-header1">

        <!-- Language Selector (Top Row) -->


        <!-- Main Header Content -->
        <div class="container" id="header" class="d-flex flex-column align-items-center">

            <div class="container suites px-0">
                <!-- Left: Language switch -->
                <div class="header-left">
                    <!-- <div class="language-nav2 container d-flex">
                        <ul class="language-list ">
                            <li class="language-item"><a href="/en" class="language-link">EN</a></li>
                            <li class="language-item">/</li>
                            <li class="language-item"><a href="/no" class="language-link">NO</a></li>
                        </ul>
                    </div> -->
                </div>

                <!-- Center: Logo -->
                <div class="header-logo">
                    <!-- Logo -->
                    <?php
                    $logo = get_field('continental_site_logo', 'option');
                    if ($logo): ?>
                        <div class="logo" id="logo">
                            <a href="<?php echo home_url(); ?>">
                                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Hamburger Menu -->
                <div class="header-right">
                    <!-- Hamburger Icon (Mobile only) -->
                    <div class="hamburger-menu " aria-label="Toggle menu">
                        <span class="line top"></span>
                        <span class="line middle"></span>
                        <span class="line bottom"></span>
                    </div>
                </div>
                <div class="mega-menu">
        <div class="mega-menu-content container">


          <nav class="main-menu">
           <?php
                wp_nav_menu(array(
                    'theme_location' => 'continental_menu',
                    'menu_class' => '',
                    'container' => false,
                ));
                ?>
          </nav>




          <div class="submenu-panel">
            <div class="submenu-list">

            </div>
            <div class="submenu-image">
              <img src="" alt="">
            </div>
          </div>


        </div>

      </div>
            </div>







            <!-- Mobile Navigation -->
            <nav class="main-nav">
                
            </nav>




        </div>

        <!-- Sticky Header Scroll JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const header = document.querySelector('.continental-site-header1');
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                });
            });

//             document.addEventListener("DOMContentLoaded", function () {
//   const hamburger = document.querySelector(".hamburger-menu");
//   const mobileNav = document.querySelector(".mobile-nav");

//   hamburger.addEventListener("click", function () {
//     mobileNav.classList.toggle("active");
//     hamburger.classList.toggle("open"); // optional for animation
//   });
// });

        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </header>