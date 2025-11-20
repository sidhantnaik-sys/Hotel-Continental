<?php
/**
 * Template Name: Restaurent Page
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
  $website_link = get_field('website_link');

  ?>
  <section class="room-detail content">

    <!-- Title & Hero Section -->
    <div class="container room-container room-header pt-5">
      <div class="container room-text py-5">
        <h1><?php echo esc_html($title);
        ?></h1>
        <div class="room-description">
          <p class="descp"><?php echo wpautop($description); ?></p>

          <!-- <?php
          if ($link_text && $website_link): ?>
            <p>
              <?php echo esc_html($link_text); ?>
              <a class="web-link"  href="<?php echo esc_url($website_link['url']); ?>"
                target="<?php echo esc_attr($website_link['target'] ?: '_self'); ?>">
                <?php echo esc_html($website_link['title']); ?>
              </a>
            </p>
          <?php endif; ?> -->
        </div>

        <?php if ($book_url): ?>
          <a href="<?php echo esc_url($book_url); ?>" class="btn btn-book">BOOK NÅ</a>
        <?php endif; ?>
      </div>
      <div class="room-image">
        <?php if ($hero_image): ?>
          <img class="height640" src="<?php echo esc_url($hero_image['url']); ?>"
            alt="<?php echo esc_attr($hero_image['alt']); ?>">
        <?php endif; ?>
      </div>
    </div>

  </section>



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
          $restaurants = new WP_Query(array(
            'post_type' => 'restaurants', // changed from 'packages' to 'restaurants'
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
          ));

          if ($restaurants->have_posts()):
            while ($restaurants->have_posts()):
              $restaurants->the_post();

              $title = get_the_title();
              $description = get_field('description'); // make sure ACF field exists
              $category = get_field('category');       // optional, if using taxonomy or custom field
              $image_summer = get_field('image_summer');
              $image_winter = get_field('image_winter');
              $image = ($season === 'summer') ? $image_summer : $image_winter;
              $link = get_permalink();
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
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="Arrow Icon" />
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