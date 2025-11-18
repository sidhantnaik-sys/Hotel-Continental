<?php $season = get_current_season(); ?>


<section class="offers-section2">
  <div class="container-fluid offers-section-container py-5">
    <div class="row align-items-center">
      <!-- Left Content -->
      <div class="col-md-4">
        <div class="offers-text h1p">
          <h2 class="section-heading">
            <?php the_field('offers_section_heading'); ?>
          </h2>
          <!-- <?php
          $full_desc = get_field('offers_section_description');
          $trimmed_desc = wp_trim_words($full_desc, 40); // Adjust word limit as needed
          
          ?>

          <?php if ($full_desc): ?>
            <p class="section-description short"><?php echo esc_html($trimmed_desc); ?></p>
            <p class="section-description full d-none"><?php echo esc_html($full_desc); ?></p>
          <?php endif; ?>

          <button class="view-all view-toggle-btn" type="button">VIEW ALL</button> -->

          <?php
          $full_desc = get_field('offers_section_description');

          if ($full_desc) {
            $trimmed_desc = wp_trim_words($full_desc, 32, '');
            $all_words = explode(' ', wp_strip_all_tags($full_desc));
            $trimmed_words = explode(' ', wp_strip_all_tags($trimmed_desc));
            $remaining_words = array_slice($all_words, count($trimmed_words));
            $remaining_text = implode(' ', $remaining_words);
          }
          ?>

          <?php if ($full_desc): ?>
            <div class="section-description">
              <p class="short-text">
                <?php echo ($full_desc); ?>
              </p>

              <?php
              $link = get_field('button_link2');
              if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'] ? $link['title'] : 'LES MER';
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="view-all1 toggle-btn" href="<?php echo esc_url($link_url); ?>"
                  target="<?php echo esc_attr($link_target); ?>">
                  <?php echo esc_html($link_title); ?>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>






          <div class="offers-nav">
            <button class="offers-prev">
              <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-left.svg'); ?>
            </button>
            <button class="offers-next">
              <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-right.svg'); ?>
            </button>
          </div>

        </div>
      </div>
      <?php
      // $month = date('n');
      // $season = ($month >= 4 && $month <= 5) ? 'summer' : 'winter'; // Apr–Sep = summer
      ?>
      <!-- Right Slider -->
      <?php
      $button_text = get_field('button_txt_offer');
      ?>

      <div class="col-md-8">
        <div class="swiper offers-swiper">
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
                $offer_link = get_field('offer_button_url'); // ACF link field
                $link = '';
                $button_txt = get_field('button_txt_offer');

                if ($offer_link) {
                  $link = is_array($offer_link) && isset($offer_link['url']) ? $offer_link['url'] : $offer_link;
                } else {
                  $link = get_permalink();
                }
                ?>
                <a href="<?php echo esc_url($link); ?>"
                  class="swiper-slide offer-card d-block text-decoration-none text-white">
                  <div class="image-wrapper">
                    <?php if ($image): ?>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                        class="img-fluid">
                    <?php endif; ?>
                  </div>

                  <div class="offer-info h1p">
                    <div class="static-content">
                      <h4><?php echo esc_html($title); ?></h4>
                      <span class="btn">
                        <?php echo esc_html($button_text); ?>
                        <span class="arrow pt-0">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="Arrow Icon" />
                        </span>
                      </span>
                      <?php if ($category): ?>
                        <p class="category"><?php echo esc_html($category); ?></p>
                      <?php endif; ?>
                    </div>

                    <div class="hover-content">
                      <h4><?php echo esc_html($title); ?></h4>
                      <p><?php echo esc_html($description); ?></p>

                      <span class="btn">
                        <?php echo esc_html($button_text); ?>
                        <span class="arrow">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="Arrow Icon" />
                        </span>
                      </span>
                    </div>
                  </div>
                </a>
                <?php
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>