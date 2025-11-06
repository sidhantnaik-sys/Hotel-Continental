<?php $season = get_current_season(); ?>


<section class="luxury-comfort pt-1 text-white h1p room-padding">
  <div class="luxury-comfort-container container">
    <?php if (get_field('section_title')): ?>
      <h2 class="text-center mb-5"><?php echo esc_html(get_field('section_title')); ?></h2>
    <?php endif; ?>

    <div class="card-wrapper h1p">

      <!-- LEFT -->
      <?php
      $left_img = get_field('left_image');
      $left_link = get_field('left_link');
      ?>
      <a href="<?php echo esc_url($left_link); ?>" class="card-item left" <?php if ($left_link): ?>target="_blank" <?php endif; ?>>
        <?php if ($left_img): ?>
          <img src="<?php echo esc_url($left_img['url']); ?>" alt="<?php echo esc_attr($left_img['alt']); ?>"
            class="card-img">
        <?php endif; ?>
        <div class="card-content">
          <h5><?php the_field('left_title'); ?></h5>
          <p><?php the_field('left_description'); ?></p>
        </div>
      </a>

      <!-- CENTER -->
      <?php
      $center_img = get_field('center_image');
      $center_link = get_field('center_link');
      ?>
      <a href="<?php echo esc_url($center_link); ?>" class="card-item center" <?php if ($center_link): ?>target="_blank"
        <?php endif; ?>>
        <?php if ($center_img): ?>
          <img src="<?php echo esc_url($center_img['url']); ?>" alt="<?php echo esc_attr($center_img['alt']); ?>"
            class="card-img">
        <?php endif; ?>
        <div class="card-content">
          <h5><?php the_field('center_title'); ?></h5>
          <p><?php the_field('center_description'); ?></p>
        </div>
      </a>

      <!-- RIGHT -->
      <?php
      $right_img = get_field('right_image');
      $right_link = get_field('right_link');
      ?>
      <a href="<?php echo esc_url($right_link); ?>" class="card-item right" <?php if ($right_link): ?>target="_blank"
        <?php endif; ?>>
        <?php if ($right_img): ?>
          <img src="<?php echo esc_url($right_img['url']); ?>" alt="<?php echo esc_attr($right_img['alt']); ?>"
            class="card-img">
        <?php endif; ?>
        <div class="card-content">
          <h5><?php the_field('right_title'); ?></h5>
          <p><?php the_field('right_description'); ?></p>
        </div>
      </a>

    </div>


  </div>
</section>