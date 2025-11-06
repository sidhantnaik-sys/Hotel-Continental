<?php $season = get_current_season(); ?>



<?php
$hero_image_summer = get_field('hero_summer_image');
$hero_image_winter = get_field('hero_winter_image');

$summer_url = esc_url(is_array($hero_image_summer) ? $hero_image_summer['url'] : $hero_image_summer);
$winter_url = esc_url(is_array($hero_image_winter) ? $hero_image_winter['url'] : $hero_image_winter);

$headline = get_field('headline_text');
$button_text = get_field('hero_button_text1');
$button_link = get_field('hero_button_link1');


$hero_bg = ($season === 'summer') ? $summer_url : $winter_url;
?>

<section class="container-fluid hero text-white d-flex align-items-center position-relative"
  style="height: 100vh; background: url('<?php echo $hero_bg; ?>') center center/cover no-repeat;">
  <div class="overlay-content text-center w-100">
    <div class="overlay-content">
      <?php if ($headline): ?>
        <h1 class="display-4 mb-4"><?php echo esc_html($headline); ?></h1>
      <?php endif; ?>

      <?php if ($button_text && $button_link): ?>
        <a href="<?php echo esc_url($button_link); ?>" class="btn btn-primary btn-lg">
          <?php echo esc_html($button_text); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>

  <?php
  $badge_link = get_field('badge_link_url'); // ACF field for link
  ?>

  <div class="rotating-badge1">
    <a href="<?php echo esc_url($badge_link); ?>" <?php if ($badge_link)
         echo 'target="_blank"'; ?>>
      <!-- Static Center Logo -->
      <div class="center-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Group 45.svg" alt="Center Logo" />
      </div>

      <!-- Rotating Circle Text -->
      <div class="circle-text">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/text.svg" alt="Text Logo" />
      </div>
    </a>
  </div>



  <!-- Your hero content here -->
</section>