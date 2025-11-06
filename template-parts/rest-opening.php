<?php
$opening_image = get_field('opening_image');
$detail_title = get_field('detail_title');
$detail_desc = get_field('detail_description');
?>
<?php if ($opening_image || $detail_title || $detail_desc || have_rows('opening_hours')): ?>
  <section class="restaurant-detail">
    <div class="container restaurant-detail-wrapper d-flex">

      <!-- Left: Image -->
      <div class="restaurant-image-left">
        <?php if ($opening_image): ?>
          <img src="<?php echo esc_url($opening_image['url']); ?>" alt="<?php echo esc_attr($opening_image['alt']); ?>">
        <?php endif; ?>
      </div>

      <!-- Right: Content -->
      <div class="restaurant-content-right p-5">
        <h1><?php echo ($detail_title); ?></h1>

        <div class="restaurant-description">
          <?php echo wpautop(esc_html($detail_desc)); ?>
        </div>

        <?php if (have_rows('opening_hours')): ?>
          <section class="restaurant-amenities">

            <div class="amenities-grid">
              <?php while (have_rows('opening_hours')):
                the_row();
                $text = get_sub_field('a_text');
                $icon = get_sub_field('icon');
                ?>
                <div class="amenity-item p1">
                  <img class="mt-1" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                  <p class="amenity-text"><?php echo esc_html($text); ?></p>
                </div>
              <?php endwhile; ?>
            </div>
          </section>
        <?php endif; ?>

      </div>
    </div>
  </section>
<?php endif; ?>