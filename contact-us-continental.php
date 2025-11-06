<?php
/**
 * Template Name: contact us continental
 */
get_header('continental-suiten'); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<section class="about-us room-padding">
  <?php
  // Fields
  $hero_image = get_field('image_room'); // or a dedicated field like 'room_hero_image'
  $book_url = get_field('book_now_button');
  $description = get_field('full_description');
  $title = get_field('room_title');
  ?>
<section class="room-detail">
    <div class="container">
      <!-- Title & Hero Section -->
      <div class="container room-header">
        <div class="container room-text py-5">
          <h1><?php echo esc_html($title);
          ?></h1>
          <div class="room-description">
            <?php echo wpautop(esc_html($description)); ?>

            <?php if (have_rows('contact_details')): ?>
              <div class="contact-details darkbrown--color">
                <?php while (have_rows('contact_details')):
                  the_row(); ?>
                  <?php $title = get_sub_field('contact_title'); ?>
                  <?php if ($title): ?>
                    <p class="contact-title"><?php echo ($title); ?></p>
                  <?php endif; ?>

                  <?php if (have_rows('details')): ?>
                    <?php while (have_rows('details')):
                      the_row(); ?>
                      <?php $info_line = get_sub_field('value'); ?>
                      <?php if ($info_line): ?>
                        <p class="contact-info"><?php echo ($info_line); ?></p>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>





        </div>
        <div class="contact-image contact-img">
          <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
          <?php endif; ?>
        </div>

      </div>
  </section>


<!-- map -->


  <div class="garage-parking container py-5">
    <h2><?php the_field('location_title'); // Garage Parking ?></h2>

    
    <?php
    $map_embed = get_field('google_map_embed_code');

    ?>

    <div class="map-wrapper">
      <?php echo ($map_embed); ?>
    </div>
  </div>

</section>


<?php get_footer('continental-suiten'); ?>