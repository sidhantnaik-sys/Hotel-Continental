<?php $season = get_current_season(); ?>


<?php
$section_heading = get_field('section_heading');
$section_description = get_field('section_description');
$button_text = get_field('section_button_text');
$button_link = get_field('section_button_link');
$button_txt = get_field('button_txt');
?>



<div class="container-fluid suite-carousel ">
  <div class="container head ">
    <div class="row align-items-start ">
      <div class="col-md-6 left-heading ">
        <?php if ($section_heading): ?>
          <h1 class="section-heading"><?php echo esc_html($section_heading); ?></h1>
        <?php endif; ?>
      </div>
      <?php
      // Split content by paragraphs
      $paragraphs = preg_split('/<\/p>\s*/i', trim($section_description), -1, PREG_SPLIT_NO_EMPTY);

      // Extract first paragraph and remaining paragraphs
      $first_para = isset($paragraphs[0]) ? $paragraphs[0] . '</p>' : '';
      $remaining_para = '';
      if (count($paragraphs) > 1) {
        $remaining_para = implode('</p>', array_slice($paragraphs, 1)) . '</p>';
      }
      ?>

      <div class="col-md-6 right-description">
        <div class="section-description">

          <div class="short-text">
            <?php echo wp_kses_post($first_para); ?>
          </div>

          <?php if (!empty($remaining_para)): ?>
            <div class="full-text" style="display: none;">
              <?php echo wp_kses_post($remaining_para); ?>
            </div>

            <button class="view-all toggle-btn">LES MER</button>
          <?php endif; ?>

        </div>
      </div>


      <div class="filter d-flex justify-content-between align-items-center mb-4">
        <div class="custom-select-wrapper">
          <select class="form-select suite-filter" aria-label="Filter suites">
            <option value="all category" selected>Alle kategorier</option>
            <option value="continental">Continental</option>
            <option value="junior">Junior</option>
            <option value="royal">Royal</option>
          </select>
          <!-- ✅ Add a simple line below -->

          <span class="custom-arrow">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/drop-arrow.svg" alt="Dropdown Arrow" />
          </span>
        </div>

        <div class="bottom-line"></div>
      </div>


    </div>
  </div>
  <div class="container p-0">

    <?php
    $season = 'summer';
    $args = array('post_type' => 'room', 'posts_per_page' => -1);
    $room_query = new WP_Query($args);
    $total_cards = $room_query->post_count;
    ?>

    <div
      class="container-fluid carousel-wrapper position-relative <?php echo ($total_cards <= 2) ? 'hide-arrows' : ''; ?>">
      <button class="carousel-prev arrow-btn">
        <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-left.svg'); ?>
      </button>

      <!-- Swiper Slider -->
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

                    <div class="card-body p1">
                      <div class="static-content">
                        <h5 class="card-title"><?php echo esc_html($title); ?></h5>
                      </div>

                      <div class="hover-content">
                        <h5 class="card-title"><?php echo esc_html($title); ?></h5>
                        <div class="card-row">
                          <p class="card-text"><?php echo esc_html($description); ?></p>
                        </div>
                        <span class="explore-btn">
                           <?php echo strtoupper(esc_html($button_txt)); ?>
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
      <button class="carousel-next arrow-btn">
        <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-right.svg'); ?>
      </button>
    </div>



  </div>
</div>