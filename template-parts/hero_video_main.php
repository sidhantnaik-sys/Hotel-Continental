<?php
// Get video & fallback image from ACF
$hero_video = get_field('hero_video');
$hero_fallback = get_field('hero_fallback_image');
$headline = get_field('headline_text');
$button_text = get_field('button_text');
$button_url = get_field('button_url');
$video_url = esc_url(is_array($hero_video) ? $hero_video['url'] : $hero_video);
$fallback_url = esc_url(is_array($hero_fallback) ? $hero_fallback['url'] : $hero_fallback);
?>

<?php if ($video_url || $fallback_url): ?>
  <section class="hero-continental hero text-white d-flex align-items-center position-relative">
    <?php if ($video_url): ?>
      <video autoplay muted loop playsinline poster="<?php echo $fallback_url; ?>" class="hero-video">
        <source src="<?php echo $video_url; ?>" type="video/mp4">
      </video>
    <?php elseif ($fallback_url): ?>
      <div class="hero-image" style="background-image: url('<?php echo $fallback_url; ?>');"></div>
    <?php endif; ?>

    <div class="overlay-content text-center w-100">
      <?php if ($headline): ?>
        <h1 class="display-4 mb-4"><?php echo esc_html($headline); ?></h1>
      <?php endif; ?>

      <?php if ($button_text && $button_url): ?>
        <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary btn-lg">
          <?php echo esc_html($button_text); ?>
        </a>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>