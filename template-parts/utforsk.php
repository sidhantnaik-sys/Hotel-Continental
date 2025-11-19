<?php $season = get_current_season(); ?>

<section class="utk-offers-section room-padding">
  <div class="container utk-container pt-5">
    <h2 class="section-title text-center mb-5">Utforsk Tilbudene Våre</h2>

    <!-- ONLY CHANGE HERE: added 'offers-row' -->
    <div class="row g-4 pb-5 mobile-offers-swiper">


      <?php if (have_rows('offers')): ?>
        <?php while (have_rows('offers')): the_row(); ?>

          <?php
            $image_summer = get_sub_field('image_summer');
            $image_winter = get_sub_field('image_winter');
            $image = ($season === 'summer') ? $image_summer : $image_winter;

            $title = get_sub_field('title');
            $description = get_sub_field('description');
            $button_link = get_sub_field('button_link');
          ?>

          <div class="col-12 col-md-6 col-lg-3">
            <?php if ($button_link): ?>
              <a href="<?php echo esc_url($button_link); ?>" class="offer-card-link">
            <?php endif; ?>

              <div class="offer-card h1p">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">

                <div class="offer-overlay">

                  <!-- Static (Always Visible) -->
                  <div class="static-content">
                    <h4 class="offer-title"><?php echo esc_html($title); ?></h4>
                  </div>

                  <!-- Sliding Content -->
                  <div class="hover-content">
                    <h4 class="offer-title"><?php echo esc_html($title); ?></h4>

                    <?php if ($description): ?>
                      <p class="offer-desc"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>

                    <?php if ($button_link): ?>
                      <span class="explore-btn">
                        UTFORSK
                        <span class="arrow">
                          <?php include get_template_directory() . '/assets/images/arrow.svg'; ?>
                        </span>
                      </span>
                    <?php endif; ?>

                  </div>

                </div>
              </div>

            <?php if ($button_link): ?>
              </a>
            <?php endif; ?>

          </div>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
</section>
