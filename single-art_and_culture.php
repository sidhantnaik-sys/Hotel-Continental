<?php
/**
 * Template Name: single about us art Page
 */
get_header(); ?>
<?php $season = get_current_season(); ?>


<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">
  <?php
  // Fields
  $hero_image = get_field('image_green');
  $description = get_field('full_description');
  $title = get_field('book_title');


  $detail_image2 = get_field('detail_img2');
  $detail_title2 = get_field('detail_title2');
  $detail_desc2 = get_field('detail_desc2');
  $description3 = get_field('description3');
  $hero_image3 = get_field('hero_image3');
  $title3 = get_field('title3');

   $detail_image4 = get_field('detail_img4');
  $detail_title4 = get_field('detail_title4');
  $detail_desc4 = get_field('detail_desc4');

  ?>
  <section class="room-detail h1p pt-5 truffle-h1 p1">
    <div class="container">
      <!-- Title & Hero Section -->
      <div class="container room-header">
        <div class="container room-text py-5">
          <h2><?php echo esc_html($title);
          ?></h2>
          <div class="book-description py-3">
            <?php echo wpautop(($description)); ?>
          </div>


        </div>
        <div class="room-image">
          <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
          <?php endif; ?>
        </div>
      </div>
    </div>



    <?php if (have_rows('our_collection')): ?>
      <section class="container our-collection-section h1p">
        <h3><?php echo the_field('title_our_collection'); ?></h3>

        <div class="collection-grid px-5 py-4">
          <?php
          $artworks = get_field('our_collection');
          $total = count($artworks);
          $half = ceil($total / 2);
          $left = array_slice($artworks, 0, $half);
          $right = array_slice($artworks, $half);
          ?>

          <!-- Left Column -->
          <div class="collection-column">
            <ul>
              <?php foreach ($left as $row): ?>
                <li>
                  <?php if (!empty($row['icon'])): ?>
                    <img src="<?php echo esc_url($row['icon']['url']); ?>" alt="" class="icon" />
                  <?php endif; ?>
                  <?php echo ($row['artwork_title']); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <!-- Right Column -->
          <div class="collection-column">
            <ul>
              <?php foreach ($right as $row): ?>
                <li>
                  <?php if (!empty($row['icon'])): ?>
                    <img src="<?php echo esc_url($row['icon']['url']); ?>" alt="" class="icon" />
                  <?php endif; ?>
                  <?php echo ($row['artwork_title']); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </section>
    <?php endif; ?>

  </section>

  <?php if ($detail_image2 || $hero_image3): ?>
    <section class="about-us h1p">
      <section class="restaurant-detail py-3">
        <div class="container restaurant-detail-wrapper d-flex pt-2">

          <!-- Left: Image -->
          <div class="detail-image-left">
            <?php if ($detail_image2): ?>
              <img src="<?php echo esc_url($detail_image2['url']); ?>" alt="<?php echo esc_attr($detail_image2['alt']); ?>">
            <?php endif; ?>
          </div>

          <!-- Right: Content -->
          <div class="restaurant-content-right p-5 truffle-h1">
            <h3><?php echo ($detail_title2); ?></h3>

            <div class="restaurant-description">
              <?php echo wpautop(esc_html($detail_desc2)); ?>
            </div>



          </div>
        </div>
      </section>


      <section class="room-detail pt-3">
        <div class="container py-5">
          <!-- Title & Hero Section -->
          <div class="container room-header h1p truffle-h1">
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

      <section class="restaurant-detail py-3">
        <div class="container restaurant-detail-wrapper d-flex pt-2 pb-4">

          <!-- Left: Image -->
          <div class="detail-image-left">
            <?php if ($detail_image4): ?>
              <img src="<?php echo esc_url($detail_image4['url']); ?>" alt="<?php echo esc_attr($detail_image4['alt']); ?>">
            <?php endif; ?>
          </div>

          <!-- Right: Content -->
          <div class="restaurant-content-right p-5 truffle-h1">
            <h3><?php echo ($detail_title4); ?></h3>

            <div class="restaurant-description">
              <?php echo wpautop(esc_html($detail_desc4)); ?>
            </div>



          </div>
        </div>
      </section>
    </section>
  <?php endif; ?>

</div>
<?php get_footer(); ?>