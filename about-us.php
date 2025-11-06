<?php
/**
 * Template Name: about us page
 */
get_header(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
  <section class="about-us content p1">
    <?php get_template_part('template-parts/about-us-booksection'); ?>

    <?php
    $detail_title = get_field('detail_title');
    $detail_desc = get_field('detail_desc');
    $detail_title = get_field('detail_title');
    $detail_image2 = get_field('detail_img2');
    $detail_title2 = get_field('detail_title2');
    $detail_desc2 = get_field('detail_desc2');
    $description3 = get_field('description3');
    $hero_image3 = get_field('hero_image3');
    $title3 = get_field('title3');
    ?>

    <div class="detail container p-3 h1p">
      <h3><?php echo ($detail_title); ?></h3>

      <div class="detail-description">
        <p> <?php echo wpautop(esc_html($detail_desc)); ?></p>


        <?php if (have_rows('details')): ?>
          <section class="details h1p">

            <div class="details">
              <?php while (have_rows('details')):
                the_row();
                $text = get_sub_field('a_text');
                $icon = get_sub_field('icon');
                ?>
                <div class="detail-item">
                  <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                  <p class="amenity-text"><?php echo esc_html($text); ?></p>
                </div>
              <?php endwhile; ?>
            </div>
          </section>
        <?php endif; ?>
      </div>
    </div>

    <section class="restaurant-detail py-3 h1p">
      <div class="container restaurant-detail-wrapper d-flex">

        <!-- Left: Image -->
        <div class="detail-image-left ">
          <?php if ($detail_image2): ?>
            <img src="<?php echo esc_url($detail_image2['url']); ?>" alt="<?php echo esc_attr($detail_image2['alt']); ?>">
          <?php endif; ?>
        </div>

        <!-- Right: Content -->
        <div class="restaurant-content-right p-5">
          <h3><?php echo ($detail_title2); ?></h3>

          <div class="restaurant-description">
            <?php echo wpautop(esc_html($detail_desc2)); ?>
          </div>



        </div>
      </div>
    </section>


    <section class="room-detail h1p">
      <div class="container">
        <!-- Title & Hero Section -->
        <div class="container room-header">
          <div class="container room-text py-5">
            <h3><?php echo esc_html($title3);
            ?></h3>
            <div class="room-description">
              <?php echo wpautop(esc_html($description3)); ?>
            </div>


          </div>
          <div class="room-image">
            <?php if ($hero_image3): ?>
              <img src="<?php echo esc_url($hero_image3['url']); ?>" alt="<?php echo esc_attr($hero_image3['alt']); ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <div class="direction container py-5 h1p">
      <h3><?php the_field('directions_title'); ?></h3>

      <?php if (have_rows('directions_list')): ?>
        <div class="direction-list">
          <?php while (have_rows('directions_list')):
            the_row();
            $text = get_sub_field('direction_text');
            $icon = get_sub_field('icon'); ?>

            <div class="direction-item">
              <?php if ($icon): ?>
                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
              <?php endif; ?>
              <p class="direction-text"><?php echo esc_html($text); ?></p>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="garage-parking container py-5 h1p">
      <h3><?php the_field('parking_title');  ?></h3>

      <div class="parking-description mb-4">
        <p><?php the_field('parking_description'); ?></p>
      </div>
      <?php
      $map_embed = get_field('google_map_embed_code');

      ?>

      <div class="map-wrapper">
        <?php echo ($map_embed); ?>
      </div>
    </div>

  </section>

</div>
  <?php get_footer(); ?>