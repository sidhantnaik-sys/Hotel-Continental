 <?php
// Fields


$amenities = get_field('amenities');
$gallery = get_field('gallery');


?>
 
 <?php if ($gallery): ?>
      <div class="container room-gallery">
        <h2>Bildegalleri</h2>
        <div class="gallery-grid">
          <?php foreach ($gallery as $img): ?>
            <div class="image-wrapper">
              <a href="<?php echo esc_url($img['url']); ?>" class="popup-link">
                <img src="<?php echo esc_url($img['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    <script>
      jQuery(document).ready(function ($) {
        $('.gallery-grid').magnificPopup({
          delegate: 'a.popup-link', // child items selector
          type: 'image',
          gallery: {
            enabled: true // enable gallery mode
          }
        });
      });
    </script>