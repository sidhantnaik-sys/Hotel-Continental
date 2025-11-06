<?php
/*
Template Name: privacy continental
*/


get_header("continental-suiten");
?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<section class="room-sections room-padding">
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

          <div class="room-content px-3 p1">
            <h2><?php echo ($title); ?></h2>
            <p><?php echo ($description); ?></p>
          </div>

        </div>

        <?php $count++; endwhile; ?>
    </div>
  <?php endif; ?>

</section>


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
      <?php while (have_rows('amenities')):
        the_row();
        $text = get_sub_field('a_text');
        $icon = get_sub_field('icon');
        ?>
        <div class="amenity-item a1">
          <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
          <span class="amenity-text"><?php echo ($text); ?></span>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  </section>
<?php endif; ?>

<?php
get_footer('continental-suiten');
?>