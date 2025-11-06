<?php
/*
Template Name: continental Home
*/


get_header("continental-suiten");
?>

<!-- <?php get_template_part('template-parts/room-hero-img'); ?> -->


<?php get_template_part('template-parts/hero_video_main'); ?>



<section class="signature-section container-fluid py-5 px-0 content h1p">
  <div class="row h-100 align-items-center gx-0">

    <!-- Left Image -->
    <div class="col-md-4 d-flex flex-column justify-content-end px-0">
      <?php
      $left_img = get_field('con_left_image');
      if ($left_img): ?>
        <img src="<?php echo esc_url($left_img['url']); ?>" alt="<?php echo esc_attr($left_img['alt']); ?>"
          class="img-fluid w-100 h-100 object-fit-cover">
      <?php endif; ?>
    </div>

    <!-- Middle Text -->
    <div class="col-md-4 wid d-flex flex-column justify-content-center align-items-center text-center ">
      <?php if ($heading = get_field('con_heading')): ?>
        <h2 class="mb-4"><?php echo esc_html($heading); ?></h2>
      <?php endif; ?>

      <?php if ($p1 = get_field('con_paragraph_1')): ?>
        <p><?php echo wp_kses_post($p1); ?></p>
      <?php endif; ?>

      <?php if ($p2 = get_field('con_paragraph_2')): ?>
        <p><?php echo wp_kses_post($p2); ?></p>
      <?php endif; ?>

      <?php if ($highlight = get_field('con_highlight_text')): ?>
        <p class="highlight-text"><?php echo esc_html($highlight); ?></p>
      <?php endif; ?>

      <?php
      $btn_text = get_field('button_text');
      $btn_link = get_field('button_url');
      if ($btn_text && $btn_link): ?>
        <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-dark">
          <?php echo esc_html($btn_text); ?>
        </a>
      <?php endif; ?>
    </div>

    <!-- Right Image -->
    <div class="col-md-4 px-0">
      <?php
      $right_img = get_field('con_right_image');
      if ($right_img): ?>
        <img src="<?php echo esc_url($right_img['url']); ?>" alt="<?php echo esc_attr($right_img['alt']); ?>"
          class="img-fluid w-100 h-100 object-fit-cover">
      <?php endif; ?>
    </div>

  </div>
</section>
<?php $season = get_current_season(); ?>
<section class="hotel-staycation content h1p">
  <div class="container-fluid p-0">
    <div class="row g-0">

      <?php
      $repeater_field = ($season === 'summer') ? 'stay_image_right_summer' : 'stay_image_right_winter';
      ?>
      <div id="staycationCarousel" class="carousel slide col-12 col-md-6 staycation-right" data-bs-ride="carousel"
        data-bs-interval="3000">
        <div class="carousel-inner">
          <?php if (have_rows($repeater_field)): ?>
            <?php $i = 0; ?>
            <?php while (have_rows($repeater_field)):
              the_row(); ?>
              <?php $image = get_sub_field('stay_image'); ?>
              <?php if ($image): ?>
                <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                  <img src="<?php echo esc_url($image['url']); ?>" class="d-block w-100"
                    alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
                <?php $i++; ?>
              <?php endif; ?>
            <?php endwhile; ?>
          <?php else: ?>
            <div class="carousel-item active">
              <img src="https://via.placeholder.com/800x400?text=No+Images+Found" class="d-block w-100" alt="No image" />
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-12 col-md-6 staycation-left infinite">
        <div class="staycation-content">
          <h2><?php the_field('stay_heading'); ?></h2>
          <p><?php the_field('stay_description'); ?></p>
          <p class="subtext"><?php the_field('stay_subtext'); ?></p>
          <a href="<?php the_field('stay_button_url'); ?>" class="staycation-btn">
            <?php the_field('stay_button_text'); ?>
          </a>
        </div>
      </div>


    </div>
  </div>
</section>


<section class="premium-rooms container-fluid px-0 py-5">

  <!-- Premium Rooms Header -->
  <div class="carousel-header container content h1p px-5 room-padding">
    <h2><?php the_field('room_cards_heading'); ?></h2>
    <div class="carousel-buttons">
      <button class="premium-prev arrow-btn">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.svg" alt="Previous Arrow">
      </button>
      <button class="premium-next arrow-btn">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.svg" alt="Next Arrow">
      </button>
    </div>
  </div>

  <div class="swiper premiumSwiper">
    <div class="swiper-wrapper">


      <?php if (have_rows('premium_rooms')): ?>
        <?php while (have_rows('premium_rooms')):
          the_row();
          $room_image = get_sub_field('room_image');
          $room_title = get_sub_field('room_title');
          $room_desc = get_sub_field('room_description');
          $room_link = get_sub_field('room_link');
          ?>
          <div class="swiper-slide">
            <div class="room-card">
              <img src="<?php echo esc_url($room_image['url']); ?>" alt="<?php echo esc_attr($room_title); ?>"
                class="img-fluid w-100">
              <div class="room-overlay content h1p p1">
                <h5><?php echo esc_html($room_title); ?></h5>
                <p><?php echo esc_html($room_desc); ?></p>
                <a href="<?php echo esc_url($room_link); ?>" class="btn btn-link">SE ALLE ROM</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

    </div>


  </div>
</section>

<div class="room-padding">
  <div class="container-fluid cards py-5 ">
    <div class="container carousel-wrapper position-relative">






      <div class="container">
        <div class="row">
          <?php
          $continental_rooms = new WP_Query(array(
            'post_type' => 'continental_rooms',
            'posts_per_page' => 3,
            'orderby' => 'menu_order',
            'order' => 'ASC',
          ));

          if ($continental_rooms->have_posts()):

            while ($continental_rooms->have_posts()):
              $continental_rooms->the_post();

              $title = get_the_title();
              $image_summer = get_field('image_summer');
              $image_winter = get_field('image_winter');
              $image = ($season === 'summer') ? $image_summer : $image_winter;
              $price = get_field('price');
              $amenities = get_field('amenities');
              $link = get_permalink();
              $description = get_field('description');
              ?>

              <div class="col-md-4 pb-3"> <!-- 3 cards side by side -->
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
                            <p class="card-text"><?php echo esc_html($description); ?></p>
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


      <!-- Next Button -->

    </div>
  </div>
</div>
<?php
get_footer('continental-suiten');
?>