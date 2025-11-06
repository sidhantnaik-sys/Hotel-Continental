<?php
/**
 * Template Name: single room Page
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

  ?>

  <section class="room-detail">
    <div class="container room-container h1p p1">
      <!-- Title & Hero Section -->
      <div class="container room-header">
        <div class="container room-text py-5">
          <h2><?php the_title(); ?></h2>
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