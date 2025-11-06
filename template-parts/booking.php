<section class="room-sections">
  <?php if (have_rows('room_sections')): ?>
    <div class="room-sections-wrapper container content h1p">
      <?php
      $count = 0;
      while (have_rows('room_sections')):
        the_row();
        $title = get_sub_field('section_title');
        $description = get_sub_field('section_description');
        $image = get_sub_field('section_image');

        // Alternate layout (even = left image, odd = right image)
        $layout_class = ($count % 2 === 0) ? 'image-right' : 'image-left';
        ?>

        <div class="room-section <?php echo $layout_class; ?>">

          <div class="room-image">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
          </div>

          <div class="room-content  p1">
            <h2><?php echo ($title); ?></h2>
            <p><?php echo ($description); ?></p>
          </div>

        </div>

        <?php $count++; endwhile; ?>
    </div>
  <?php endif; ?>

</section>