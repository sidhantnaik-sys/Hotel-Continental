<?php
/**
 * Template Name: Shoping page
 */
get_header(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">
    <?php
    // Fields
    $hero_image = get_field('image_green');
    $book_url = get_field('book_now_button');
    $description = get_field('full_description');
    $title = get_field('book_title');
    ?>
    <section class="room-detail">
        <div class="container">
            <!-- Title & Hero Section -->
            <div class="container room-header">
                <div class="container room-text py-5 h1p truffle-h1">
                    <h2><?php echo esc_html($title);
                    ?></h2>
                    <div class="book-description py-3">
                        <?php echo wpautop(($description)); ?>
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
        </div>
    </section>

    

    <section class="about-us">
        <?php if (get_field('eco_title') || get_field('eco_content')): ?>
            <div class="sustainability container pb-5">

                <!-- Eco Certification -->
                <section class="section-block h1p p1 truffle-h1">
                    <h3><?php the_field('eco_title'); ?></h3>
                    <div class="section-content">
                        <?php the_field('eco_content'); ?>
                    </div>
                </section>
            </div>
        <?php endif; ?>



        <?php if (have_rows('sections')): ?>
            <section class="privacy-policy-page container py-5 p1 ">
                <div class="privacy  content px-5">
                    <?php while (have_rows('sections')):
                        the_row(); ?>
                        <div class="policy-section py-3">
                            <h3><?php the_sub_field('heading'); ?></h3>

                            <?php if (get_sub_field('content')): ?>
    <div class="section-content">
        <?php echo wp_kses_post(get_sub_field('content')); ?>
    </div>
<?php endif; ?>

                            <?php if (have_rows('section_list_items')): ?>
                                <ul class="section-list mx-3">
                                    <?php while (have_rows('section_list_items')):
                                        the_row(); ?>
                                        <li><?php the_sub_field('list_item'); ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>
    </section>

    <div class="wedding-details">
        <?php
        $seating_video = get_field('lead_video');
        if ($seating_video): ?>
            <div class="seating-video1 my-3 w-100">
                <video controls class="img-fluid" autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($seating_video['url']); ?>"
                        type="<?php echo esc_attr($seating_video['mime_type']); ?>">
                    Your browser does not support the video tag.
                </video>
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


</div>

<?php get_footer(); ?>