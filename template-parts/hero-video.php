<?php $season = get_current_season(); ?>

<section class="hero-banner position-relative">
  <?php if ($video = get_field('hero_background_video')): ?>
    <video class="hero-bg position-absolute top-0 start-0 w-100 h-100" autoplay muted loop playsinline>
      <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  <?php endif; ?>


  <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

  <div class="container-fluid position-absolute overlay z-2">
    <div class="row  align-items-center justify-content-center text-center">
      <div class="center-content">
        <?php if ($title = get_field('hero_heading_text')): ?>
          <h1 class="hero-title mb-4"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>

        <?php
        $btn_text = get_field('hero_button_text');
        $btn_url = get_field('hero_button_url');
        ?>

        <?php if ($btn_text && $btn_url): ?>
          <a href="<?php echo esc_url($btn_url); ?>" class="hero-button">
            <?php echo esc_html($btn_text); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>