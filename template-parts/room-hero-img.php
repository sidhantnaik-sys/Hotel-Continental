<?php $season = get_current_season(); ?>
<?php

// Get seasonal hero images from current room
$hero_image_summer = get_field('hero_summer_image'); // ACF field on room post
$hero_image_winter = get_field('hero_winter_image');

$summer_url = esc_url(is_array($hero_image_summer) ? $hero_image_summer['url'] : $hero_image_summer);
$winter_url = esc_url(is_array($hero_image_winter) ? $hero_image_winter['url'] : $hero_image_winter);

// Choose seasonal background
$hero_bg = ($season === 'summer') ? $summer_url : $winter_url;

// Optional headline text from current room
$headline = get_field('headline_text');
?>

<?php if ($hero_bg): ?>
  <section class="container-fluid hero-room text-white d-flex align-items-center position-relative"
    style="height: 80vh; background: url('<?php echo $hero_bg; ?>') center center/cover no-repeat;">
    <div class="overlay-content text-center w-100">
      <?php if ($headline): ?>
        <h3 class=" mb-4"><?php echo esc_html($headline); ?></h3>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>