<?php
/**
 * Template Name: contact us page
 */
get_header(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<?php $season = get_current_season(); ?>
<section class="about-us room-padding">
  <?php
  // Fields
  $hero_image = get_field('image_room'); // or a dedicated field like 'room_hero_image'
  $book_url = get_field('book_now_button');
  $description = get_field('full_description');
  $title = get_field('room_title');
  ?>
  <section class="room-detail">
    <div class="container">
      <!-- Title & Hero Section -->
      <div class="container room-header">
        <div class="container room-text py-5">
          <h1><?php echo esc_html($title);
          ?></h1>
          <div class="room-description">
            <?php echo wpautop(esc_html($description)); ?>

            <?php if (have_rows('contact_details')): ?>
              <div class="contact-details darkbrown--color">
                <?php while (have_rows('contact_details')):
                  the_row(); ?>
                  <?php $title = get_sub_field('contact_title'); ?>
                  <?php if ($title): ?>
                    <p class="contact-title"><?php echo ($title); ?></p>
                  <?php endif; ?>

                  <?php if (have_rows('details')): ?>
                    <?php while (have_rows('details')):
                      the_row(); ?>
                      <?php $info_line = get_sub_field('value'); ?>
                      <?php if ($info_line): ?>
                        <p class="contact-info"><?php echo ($info_line); ?></p>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>





        </div>
        <div class="contact-image">
          <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
          <?php endif; ?>
        </div>

      </div>
  </section>

  <div class="garage-parking container pb-5">
    <h2><?php the_field('location_title'); // Garage Parking ?></h2>


    <?php
    $map_embed = get_field('google_map_embed_code');

    ?>

    <div class="map-wrapper">
      <?php echo ($map_embed); ?>
    </div>
  </div>


  <div class="container-fluid cards py-5">
    <div class="container carousel-wrapper position-relative">
      <div class="carousel-header p-2">
        <h1><?php the_field('room_cards_heading'); ?></h1>
      </div>

      <!-- Carousel Buttons -->
      <div class="carousel-buttons">
        <button class="carousel-prev arrow-btn">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.svg" alt="Previous Arrow">
        </button>
        <button class="carousel-next arrow-btn">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.svg" alt="Next Arrow">
        </button>
      </div>

      <!-- Swiper Container -->
      <div class="swiper suite-swiper">
        <div class="swiper-wrapper">
          <?php
          $contact_cards = new WP_Query(array(
            'post_type' => 'contact_cards',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
          ));

          if ($contact_cards->have_posts()):
            while ($contact_cards->have_posts()):
              $contact_cards->the_post();

              $title = get_the_title();
              $image_summer = get_field('image_summer');
              $image_winter = get_field('image_winter');
              $image = ($season === 'summer') ? $image_summer : $image_winter;
              $link = get_permalink();
              $description_card = get_field('desc');
              ?>

              <!-- Swiper Slide -->
              <div class="swiper-slide suite-card">
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
                        <?php if ($description_card): ?>
                          <div class="card-row">
                            <span class="card-text"><?php echo esc_html($description_card); ?></span>
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
            wp_reset_postdata();
          else: ?>
            <p>No contact cards found.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>






</section>


<?php get_footer(); ?>