<div class="container-fluid cards " >
<div class="container carousel-wrapper position-relative">
  <div class="carousel-header p-2 content">
    <h3><?php the_field('room_cards_heading'); ?></h3>
    
  </div>


    <!-- Swiper Slider -->
    <?php
    $season = 'summer'; // or dynamically detect it
    $args = array('post_type' => 'room', 'posts_per_page' => -1);
    $room_query = new WP_Query($args);
    ?>

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
            <?php if ($room_query->have_posts()): ?>
                <?php while ($room_query->have_posts()):
                    $room_query->the_post();
                    $title = get_the_title();
                    $description = get_field('description');
                    $category = get_field('category');
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