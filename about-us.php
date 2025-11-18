<?php
/**
 * Template Name: about us page
 */
get_header(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
  <section class="about-us content p1">
    <?php get_template_part('template-parts/about-us-booksection'); ?>

    <?php
    $detail_title = get_field('detail_title');
    $detail_desc = get_field('detail_desc');
    $detail_title = get_field('detail_title');
    $detail_image2 = get_field('detail_img2');
    $detail_title2 = get_field('detail_title2');
    $detail_desc2 = get_field('detail_desc2');
    $description3 = get_field('description3');
    $hero_image3 = get_field('hero_image3');
    $title3 = get_field('title3');
    ?>

    <?php if ($detail_title || $detail_desc || have_rows('details')): ?>
      <div class="detail container p-3 h1p">
        <?php if ($detail_title): ?>
          <h3><?php echo ($detail_title); ?></h3>
        <?php endif; ?>

        <div class="detail-description">
          <?php if ($detail_desc): ?>
            <p><?php echo wpautop(($detail_desc)); ?></p>
          <?php endif; ?>

          <?php if (have_rows('details')): ?>
            <section class="details h1p">
              <div class="details">
                <?php while (have_rows('details')):
                  the_row();
                  $text = get_sub_field('a_text');
                  $icon = get_sub_field('icon');
                  ?>
                  <div class="detail-item">
                    <?php if (!empty($icon)): ?>
                      <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                    <?php endif; ?>
                    <?php if ($text): ?>
                      <p class="amenity-text"><?php echo ($text); ?></p>
                    <?php endif; ?>
                  </div>
                <?php endwhile; ?>
              </div>
            </section>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>


    <?php if ($detail_image2 || $detail_title2 || $detail_desc2): ?>
      <section class="restaurant-detail py-3 h1p">
        <div class="container restaurant-detail-wrapper d-flex">

          <!-- Left: Image -->
          <?php if ($detail_image2): ?>
            <div class="detail-image-left">
              <img src="<?php echo esc_url($detail_image2['url']); ?>" alt="<?php echo esc_attr($detail_image2['alt']); ?>">
            </div>
          <?php endif; ?>

          <!-- Right: Content -->
          <?php if ($detail_title2 || $detail_desc2): ?>
            <div class="restaurant-content-right p-5">
              <?php if ($detail_title2): ?>
                <h3><?php echo ($detail_title2); ?></h3>
              <?php endif; ?>

              <?php if ($detail_desc2): ?>
                <div class="restaurant-description">
                  <?php echo wpautop(($detail_desc2)); ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        </div>
      </section>
    <?php endif; ?>


    <?php if ($title3 || $description3 || $hero_image3): ?>
      <section class="room-detail h1p">
        <div class="container">
          <div class="container room-header">
            <div class="container room-text py-5">
              <?php if ($title3): ?>
                <h3><?php echo ($title3); ?></h3>
              <?php endif; ?>

              <?php if ($description3): ?>
                <div class="room-description">
                  <?php echo wpautop(($description3)); ?>
                </div>
              <?php endif; ?>
            </div>

            <?php if ($hero_image3): ?>
              <div class="room-image">
                <img src="<?php echo esc_url($hero_image3['url']); ?>" alt="<?php echo esc_attr($hero_image3['alt']); ?>">
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if (get_field('parking_title') || get_field('parking_description') || get_field('google_map_embed_code')): ?>
      <div class="garage-parking container py-5 h1p">
        <?php if (get_field('parking_title')): ?>
          <h3><?php the_field('parking_title'); ?></h3>
        <?php endif; ?>

        <?php if (get_field('parking_description')): ?>
          <div class="parking-description mb-4">
            <p><?php the_field('parking_description'); ?></p>
          </div>
        <?php endif; ?>

        
      </div>
    <?php endif; ?>


    <?php if (get_field('directions_title') || have_rows('directions_list')): ?>
      <div class="direction container py-5 h1p">
        <?php if (get_field('directions_title')): ?>
          <h3><?php the_field('directions_title'); ?></h3>
        <?php endif; ?>

        <?php if (have_rows('directions_list')): ?>
          <div class="direction-list">
            <?php while (have_rows('directions_list')):
              the_row();
              $text = get_sub_field('direction_text');
              $icon = get_sub_field('icon');
              ?>
              <div class="direction-item">
                <?php if ($icon): ?>
                  <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                <?php endif; ?>

                <?php if ($text): ?>
                  <p class="direction-text"><?php echo ($text); ?></p>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="garage-parking container  h1p">
    <?php $map_embed = get_field('google_map_embed_code'); ?>
        <?php if ($map_embed): ?>
          <div class="map-wrapper">
            <?php echo $map_embed; ?>
          </div>
        <?php endif; ?>
     </div>   

    <?php
    $room_cards_heading = get_field('room_cards_heading');
    $selected_pages = get_field('select_pages', 'option');


    if ($room_cards_heading || $selected_pages): ?>
      <div class="container-fluid cards py-5">
        <div class="container carousel-wrapper position-relative">

          <?php if ($room_cards_heading): ?>
            <div class="carousel-header p-3">
              <h1><?php echo ($room_cards_heading); ?></h1>
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
                            <h5 class="card-title" style="color: #fff;"><?php echo ($title); ?></h5>
                          </div>

                          <div class="hover-content">
                            <h5 class="card-title" style="color: #fff;"><?php echo ($title); ?></h5>
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




</div>
<?php get_footer(); ?>