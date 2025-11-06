<?php $season = get_current_season(); ?>


<section class="hotel-staycation content h1p">
  <div class="container-fluid p-0">
    <div class="row g-0">
      <div class="col-12 col-md-6 staycation-left">
        <div class="staycation-content">
          <h2><?php the_field('stay_heading'); ?></h2>
          <p><?php the_field('stay_description'); ?></p>
          <p class="subtext"><?php the_field('stay_subtext'); ?></p>
          <a href="<?php the_field('stay_button_url'); ?>" class="staycation-btn">
            <?php the_field('stay_button_text'); ?>
          </a>
        </div>
      </div>
      <?php
      // $month = date('n');
      // $season = ($month >= 1 && $month <= 2) ? 'summer' : 'winter';
      
      // Set the correct repeater field based on the season
      $repeater_field = ($season === 'summer') ? 'stay_image_right_summer' : 'stay_image_right_winter';
      ?>

      <div id="staycationCarousel" class="carousel slide carousel-fade col-12 col-md-6 staycation-right" data-bs-ride="carousel"
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


    </div>
  </div>
</section>