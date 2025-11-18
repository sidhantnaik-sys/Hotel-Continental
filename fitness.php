<?php
/**
 * Template Name: Fitness Page
 */
get_header(); ?>
<?php $season = get_current_season(); ?>


<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
  <?php
  // Fields
  $hero_image = get_field('image_summer'); // or a dedicated field like 'room_hero_image'
  $book_url = get_field('book_now_button');
  $description = get_field('full_description');
  $phone = get_field('phone_no');
  $email = get_field('email');
  $amenities = get_field('amenities');
  $gallery = get_field('gallery');
  $link_text = get_field('link_text');
  $website_link = get_field('website_link');
  $title = get_field('title');

  ?>

  <section class="room-detail">
    <div class="container room-container h1p p1">
      <!-- Title & Hero Section -->
      <div class="container room-header">
        <div class="container room-text py-5">
          <h2><?php echo($title) ?></h2>
          <div class="room-description">
            <?php echo wpautop($description); ?>
          </div>


          <?php if ($book_url): ?>
            <a href="<?php echo esc_url($book_url); ?>" class="btn btn-book">BOK NÅ</a>
          <?php endif; ?>
        </div>
        <div class="room-image">
          <?php if ($hero_image): ?>
            <img class="height640" src="<?php echo esc_url($hero_image['url']); ?>"
              alt="<?php echo esc_attr($hero_image['alt']); ?>">
          <?php endif; ?>
        </div>
      </div>

      <!-- Amenities Section -->
      <?php if (have_rows('amenities')): ?>
        <section class="container room-amenities">

          <h3 class="section-title mb-4">Amenities</h3>
          <div class="amenities-grid">
            <div class="amenities-grid">
              <?php
              // Local SVG icons
              $icon_urls = array(
                'icon1' => get_template_directory_uri() . '/assets/images/icon1.svg',
                'icon2' => get_template_directory_uri() . '/assets/images/icon2.svg',
              );
              ?>

              <?php while (have_rows('amenities')):
                the_row();
                $text = get_sub_field('a_text');
                $icon = get_sub_field('icon'); // Can be SVG key or Font Awesome icon class
            
                // Normalize ACF value (handles both array or string)
                $icon_key = is_array($icon) ? ($icon['value'] ?? '') : ($icon ?? '');

                // Check for local SVG
                $icon_url = isset($icon_urls[$icon_key]) ? $icon_urls[$icon_key] : '';
                ?>
                <div class="amenity-item a1">
                  <?php if ($icon_url): ?>
                    <!-- Local SVG icon -->
                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($text); ?>">
                  <?php elseif ($icon_key && str_starts_with($icon_key, 'fa-')): ?>
                    <!-- Font Awesome icon -->
                    <i class="fa <?php echo esc_attr($icon_key); ?>"></i>
                  <?php endif; ?>

                  <?php if ($text): ?>
                    <span class="amenity-text"><?php echo ($text); ?></span>
                  <?php endif; ?>
                </div>
              <?php endwhile; ?>
            </div>


        </section>
      <?php endif; ?>

      <?php
      $seating_video = get_field('room_video');
      if ($seating_video): ?>
        <div class="seating-video1 my-3 w-100">
          <video controls class="img-fluid" autoplay muted loop playsinline>
            <source src="<?php echo esc_url($seating_video['url']); ?>"
              type="<?php echo esc_attr($seating_video['mime_type']); ?>">
            Your browser does not support the video tag.
          </video>
        </div>
      <?php endif; ?>


      <!-- Gallery Section -->
      <?php if ($gallery): ?>
        <div class="container room-gallery">
          <h3>Bildegalleri</h3>
          <div class="gallery-grid">
            <?php foreach ($gallery as $img): ?>
              <div class="image-wrapper">
                <a href="<?php echo esc_url($img['url']); ?>" class="popup-link">
                  <img src="<?php echo esc_url($img['sizes']['medium_large']); ?>"
                    alt="<?php echo esc_attr($img['alt']); ?>">
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>


      <?php
    $room_cards_heading = get_field('room_cards_heading');
    $selected_pages = get_field('select_pages', 'option');


    if ($room_cards_heading || $selected_pages): ?>
      <div class="container-fluid cards py-5">
        <div class="container carousel-wrapper position-relative">

          <?php if ($room_cards_heading): ?>
            <div class="carousel-header p-3">
              <h1><?php echo esc_html($room_cards_heading); ?></h1>
            </div>
          <?php endif; ?>

          <?php if ($selected_pages): ?>
            <div class="carousel-buttons">
              <button class="carousel-prev arrow-btn">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.svg" alt="Previous Arrow">
              </button>
              <button class="carousel-next arrow-btn">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.svg" alt="Next Arrow">
              </button>
            </div>

            <div class="swiper suite-swiper">
              <div class="swiper-wrapper">
                <?php
                foreach ($selected_pages as $page):
                  // Skip the current page
                  if ($page->ID == get_the_ID()) {
                    continue;
                  }

                  $title = get_the_title($page->ID);
                  $link = get_permalink($page->ID);
                  $desc = get_field('desc', $page->ID);
                  $image_summer = get_field('image_summer', $page->ID);
                  $image_winter = get_field('image_winter', $page->ID);
                  $image = ($season === 'summer') ? $image_summer : $image_winter;
                  ?>
                  <div class="swiper-slide suite-card" data-category="<?php echo esc_attr(strtolower($category)); ?>">
                    <a href="<?php echo esc_url($link); ?>">
                      <div class="card custom-card">
                        <?php if ($image): ?>
                          <img src="<?php echo esc_url($image['url']); ?>" class="card-img-top"
                            alt="<?php echo esc_attr($image['alt']); ?>">
                        <?php endif; ?>

                        <div class="card-body">
                          <div class="static-content">
                            <h5 class="card-title" style="color: #fff;"><?php echo esc_html($title); ?></h5>
                          </div>

                          <div class="hover-content">
                            <h5 class="card-title" style="color: #fff;"><?php echo esc_html($title); ?></h5>
                            <!-- <div class="card-row">
                              <p class="card-text"><?php echo ($description); ?></p>
                            </div> -->
                            <span class="explore-btn">
                              UTFORSK
                              <span class="arrow">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg"
                                  alt="Arrow Icon" />
                              </span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php else: ?>
            <p>No pages selected for this carousel.</p>
          <?php endif; ?>

        </div>
      </div>
    <?php endif; ?>



    
      <script>
        jQuery(document).ready(function ($) {
          $('.gallery-grid').magnificPopup({
            delegate: 'a.popup-link',
            type: 'image',
            gallery: {
              enabled: true
            }
          });
        });
      </script>

    </div>
  </section>
</div>
<?php get_footer(); ?>