<?php
/**
 * Template Name: Om oss
 */
get_header('theatercaffen'); ?>
<?php $season = get_current_season(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>


<div class="room-padding">

  <?php get_template_part('template-parts/booking'); ?>


  <div class="container-fluid cards py-5">
    <div class="container carousel-wrapper position-relative">
      <div class="carousel-header p-3">
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





      <div class="swiper suite-swiper">
        <div class="swiper-wrapper">
          <?php

          $more_information = new WP_Query(array(
            'post_type' => 'more_information',
            'posts_per_page' => 4,
            'orderby' => 'menu_order',
            'order' => 'ASC',
          ));

          if ($more_information->have_posts()):

            while ($more_information->have_posts()):
              $more_information->the_post();


              $title = get_the_title();
              $image_summer = get_field('image_summer');
              $image_winter = get_field('image_winter');
              $image = ($season === 'summer') ? $image_summer : $image_winter;
              $price = get_field('price');
              $amenities = get_field('amenities');
              $link = get_permalink();
              $description = get_field('description');
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
                        <?php if ($description): ?>
                          <div class="card-row">
                            <span class="card-text"><?php echo esc_html($description); ?></span>
                          </div>
                        <?php endif; ?>
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
    </div>
  </div>
</div>

<?php get_footer('theatercaffen'); ?>