<?php
$summer_title = get_field('summer_title');
$summer_image = get_field('summer_image');
$summer_desc  = get_field('summer_desc');
?>

<section class="restaurant-detail">
  <div class="container restaurant-detail-wrapper d-flex">
    <?php
    $has_details = $summer_title || $summer_desc || have_rows('amenities');
    ?>

    <!-- Left: Content -->
    <?php if ($has_details): ?>
      <div class="restaurant-content-left py-5">

        <?php if ($summer_title): ?>
          <h1><?php echo esc_html($summer_title); ?></h1>
        <?php endif; ?>

        <?php if ($summer_desc): ?>
          <div class="restaurant-description">
            <?php echo wpautop($summer_desc); ?>
          </div>
        <?php endif; ?>

        <?php if (have_rows('amenities')): ?>
          <section class="restaurant-amenities">
            <div class="amenities-grid">
              <?php while (have_rows('amenities')): the_row();
                $text = get_sub_field('a_text');
                $icon = get_sub_field('icon'); 
                $fallback_icon = get_template_directory_uri() . '/assets/images/icon2.svg'; 
                $icon_url = !empty($icon['url']) ? $icon['url'] : $fallback_icon;
              ?>
                <div class="amenity-item p1">
                  <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($text); ?>" loading="lazy">
                  <?php if (!empty($text)): ?>
                    <p class="amenity-text"><?php echo ($text); ?></p>
                  <?php endif; ?>
                </div>
              <?php endwhile; ?>
            </div>
          </section>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <!-- Right: Image -->
    <?php if ($summer_image): ?>
      <div class="restaurant-image-right">
        <img class="height640" src="<?php echo esc_url($summer_image['url']); ?>" alt="<?php echo esc_attr($summer_image['alt']); ?>" loading="lazy">
      </div>
    <?php endif; ?>

  </div>
</section>
