<?php
/*
Template Name: single room by room
*/


get_header("continental-suiten");
?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">

  <?php get_template_part('template-parts/booking'); ?>


  <!-- Amenities Section -->
  <?php if (have_rows('amenities')): ?>
    <section class=" room-amenities">
      <div class="container">

        <?php if (get_field('amenities_title')): ?>
          <h2 class="section-title mb-4">
            <?php the_field('amenities_title'); ?>
          </h2>
        <?php endif; ?>

        <div class="amenities-grid">
          <?php
          // Local SVG icons
          $icon_urls = array(
            'icon1' => get_template_directory_uri() . '/assets/images/icon1.svg',
            'icon2' => get_template_directory_uri() . '/assets/images/icon2.svg',
          );
          ?>
          <?php while (have_rows('amenities')):
            the_row();
            $text = get_sub_field('a_text');
            $icon = get_sub_field('icon'); // Can be SVG key or Font Awesome icon class
        
            // Normalize ACF value (handles both array or string)
            $icon_key = is_array($icon) ? ($icon['value'] ?? '') : ($icon ?? '');

            // Check for local SVG
            $icon_url = isset($icon_urls[$icon_key]) ? $icon_urls[$icon_key] : '';
            ?>
            <div class="amenity-item a1">
              <?php if ($icon_url): ?>
                <!-- Local SVG icon -->
                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($text); ?>">
              <?php elseif ($icon_key && str_starts_with($icon_key, 'fa-')): ?>
                <!-- Font Awesome icon -->
                <i class="fa <?php echo esc_attr($icon_key); ?>"></i>
              <?php endif; ?>

              <?php if ($text): ?>
                <span class="amenity-text"><?php echo ($text); ?></span>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>

        </div>
      </div>
    </section>
  <?php endif; ?>
</div>

<?php
get_footer('continental-suiten');
?>