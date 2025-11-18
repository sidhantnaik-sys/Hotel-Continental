<?php
/**
 * Template Name: packages page
 */
get_header(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">
  <?php
  // Fields
  $hero_image = get_field('image_room'); // or a dedicated field like 'room_hero_image'
  $book_url = get_field('book_now_button');
  $description = get_field('full_description');
  $title = get_field('room_title');
  $link_text = get_field('link_text');
  $website_url = get_field('website_link');
  $website_text = get_field('website_text');
  $phone = get_field('phone_no');
  $email = get_field('email');
  ?>
  <section class="room-detail">
    <div class="container">
      <!-- Title & Hero Section -->
      <div class="container room-header">
        <div class="container room-text">
          <h1><?php echo esc_html($title);
          ?></h1>
          <div class="room-description">
            <?php echo wpautop($description); ?>
          </div>


        </div>
        <div class="room-image">
          <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <div class="container-fluid cards py-5">
    <div class="container carousel-wrapper position-relative">
      <div class="carousel-header py-2">
        <h1><?php the_field('room_cards_heading'); ?></h1>

      </div>
      <div class="carousel-buttons">
        <button class="carousel-prev arrow-btn">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.svg" alt="Previous Arrow">
        </button>
        <button class="carousel-next arrow-btn">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.svg" alt="Next Arrow">
        </button>
      </div>

      <!-- Swiper Slider -->
      <?php
      $season = 'summer'; // or dynamically detect it
      $args = array('post_type' => 'room', 'posts_per_page' => -1);
      $room_query = new WP_Query($args);
      ?>

      <div class="swiper suite-swiper">
        <div class="swiper-wrapper">
          <?php
          $packages = new WP_Query(array(
            'post_type' => 'packages',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
          ));

          if ($packages->have_posts()):
            while ($packages->have_posts()):
              $packages->the_post();

              $title = get_the_title();
              $description = get_field('description');
              $category = get_field('category');
              $image_summer = get_field('image_summer');
              $image_winter = get_field('image_winter');
              $image = ($season === 'summer') ? $image_summer : $image_winter;
              $offer_link = get_field('offer_button_url');
              $link = $offer_link ? esc_url($offer_link) : get_permalink();
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
                        <h5 class="card-title"><?php echo esc_html($title); ?></h5>
                      </div>

                      <div class="hover-content">
                        <h5 class="card-title"><?php echo esc_html($title); ?></h5>
                        <div class="card-row">
                          <p class="card-text"><?php echo esc_html($description); ?></p>
                        </div>
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
            <?php endwhile;
            wp_reset_postdata(); ?>
          <?php else: ?>
            <p>No rooms found.</p>
          <?php endif; ?>
        </div>
      </div>



      <!-- Next Button -->

    </div>
  </div>

</div>


<?php get_footer(); ?>