<?php $season = get_current_season(); ?>


<section class="luxury-highlight">
  <div class="container-fluid luxury-container p-0">
    <div class="row g-0 h-100">

      <?php

      $luxury_summer = get_field('luxury_image_summer');
      $luxury_winter = get_field('luxury_image_winter');


      $luxury_img = ($season === 'summer') ? $luxury_summer : $luxury_winter;


      $button_text = get_field('button_text');
      ?>


      <div class="col-md-6 luxury-left position-relative">
        <?php
        // $luxury_img = get_field('luxury_image');
        $button_text = get_field('button_text');
        $button_link = get_field('button_link'); // ACF link field
        ?>

        <?php if ($luxury_img): ?>
          <img src="<?php echo esc_url($luxury_img['url']); ?>" alt="<?php echo esc_attr($luxury_img['alt']); ?>"
            class="img-fluid w-100 h-100 object-fit-cover">
        <?php endif; ?>

        <?php if ($button_link): ?>
          <a href="<?php echo esc_url($button_link['url']); ?>" class="luxury-btn"
            target="<?php echo esc_attr($button_link['target'] ?: '_self'); ?>">
            <?php echo esc_html($button_link['title']); ?>
          </a>
        <?php endif; ?>

      </div>

      <!-- Right: Text and framed content -->
      <div class="col-md-6 luxury-right d-flex align-items-center justify-content-center text-center ">
        <div class="content-wrapper luxury-content">

          <?php if ($heading1 = get_field('luxury_heading_1')): ?>
            <h2 class="luxury-heading heading-top"><?php echo esc_html($heading1); ?></h2>
          <?php endif; ?>

          <?php
          $badge_link = get_field('badge_link_url'); // ACF URL field
          ?>

          <div class="rotating-badge">
            <a href="<?php echo esc_url($badge_link); ?>" <?php if ($badge_link)
                 echo 'target="_blank"'; ?>>
              <!-- Inline Center Logo -->
              <div class="center-logo">
                <?php include get_template_directory() . '/assets/images/Group 45.svg'; ?>
              </div>

              <!-- Inline Rotating Circle Text -->
              <div class="circle-text">
                <?php include get_template_directory() . '/assets/images/text.svg'; ?>
              </div>
            </a>
          </div>




          <?php if ($heading2 = get_field('luxury_heading_2')): ?>
            <h2 class="luxury-heading heading-bottom"><?php echo esc_html($heading2); ?></h2>
          <?php endif; ?>

        </div>
      </div>


    </div>
  </div>
</section>