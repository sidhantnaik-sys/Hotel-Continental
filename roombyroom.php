<?php
/*
Template Name: room by room
*/


get_header("continental-suiten");
?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<section class="room-sections room-padding">
  <?php if (have_rows('room_sections')): ?>
    <div class="room-sections-wrapper container content h1p a1">
      <?php
      $count = 0;
      while (have_rows('room_sections')):
        the_row();
        $title = get_sub_field('section_title');
        $description = get_sub_field('section_description');
        $image = get_sub_field('section_image');

        
        $slug = sanitize_title($title);
        $section_id = '' . ($slug ?: $count + 1);

     
        $layout_class = ($count % 2 === 0) ? 'image-right' : 'image-left';
        ?>

        <div id="<?php echo esc_attr($section_id); ?>" class="room-section <?php echo $layout_class; ?>">

          <div class="room-image">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
          </div>

          <div class="room-content px-0 p1">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo ($description); ?></p>
          </div>

        </div>

        <?php $count++; endwhile; ?>
    </div>

  <?php endif; ?>

</section>


<?php
get_footer('continental-suiten');
?>