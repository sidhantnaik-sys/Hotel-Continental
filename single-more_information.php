<?php
/**
 * Template Name: Single-more_information
 */
get_header('theatercaffen'); ?>
<?php $season = get_current_season(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">

  <?php get_template_part('template-parts/booking'); ?>

  <?php
  $opening_image = get_field('opening_image');
  $detail_title = get_field('detail_title');
  $detail_desc = get_field('detail_description');
  ?>

  <?php if ($opening_image && $detail_title && $detail_desc): ?>
    <section class="restaurant-detail">
      <div class="container restaurant-detail-wrapper d-flex pt-0">

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
            <?php echo wpautop(($detail_desc)); ?>
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
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
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




  <section class="room-sections">
    <?php if (have_rows('room_sections_2')): ?>
      <div class="room-sections-wrapper container content h1p">
        <?php
        $count = 0;
        while (have_rows('room_sections_2')):
          the_row();
          $title = get_sub_field('section_title_2');
          $description = get_sub_field('section_description_2');
          $image = get_sub_field('section_image_2');

          // Alternate layout (even = left image, odd = right image)
          $layout_class = ($count % 2 === 0) ? 'image-right' : 'image-left';
          ?>

          <div class="room-section <?php echo $layout_class; ?>">

            <div class="room-image">
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
            </div>

            <div class="room-content px-3 p1">
              <h2><?php echo ($title); ?></h2>
              <p><?php echo ($description); ?></p>
            </div>

          </div>

          <?php $count++; endwhile; ?>
      </div>
    <?php endif; ?>

  </section>

</div>

<?php get_footer('theatercaffen'); ?>