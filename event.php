<?php
/**
 * Template Name: Event Page
 */
get_header('hc_events'); ?>
<?php $season = get_current_season(); ?>
<?php
// Get video & fallback image from ACF
$hero_video = get_field('hero_video');
$hero_fallback = get_field('hero_fallback_image');
$headline = get_field('headline_text');
$button_text = get_field('button_text');
$button_url = get_field('button_url');
$video_url = esc_url(is_array($hero_video) ? $hero_video['url'] : $hero_video);
$fallback_url = esc_url(is_array($hero_fallback) ? $hero_fallback['url'] : $hero_fallback);
?>

<?php if ($video_url || $fallback_url): ?>
  <section class="hero-hc hero text-white d-flex align-items-center position-relative">
    <?php if ($video_url): ?>
      <video autoplay muted loop playsinline poster="<?php echo $fallback_url; ?>" class="hero-video">
        <source src="<?php echo $video_url; ?>" type="video/mp4">
      </video>
    <?php elseif ($fallback_url): ?>
      <div class="hero-image" style="background-image: url('<?php echo $fallback_url; ?>');"></div>
    <?php endif; ?>

    <div class="overlay-content text-center w-100">
      <?php if ($headline): ?>
        <h1 class="display-4 mb-4"><?php echo esc_html($headline); ?></h1>
      <?php endif; ?>

      <?php if ($button_text && $button_url): ?>
        <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary btn-lg">
          <?php echo esc_html($button_text); ?>
        </a>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>



<section class="utk-offers-section py-5 bg-hc-event room-padding">
  <div class="container utk-container py-5">
    <div class="row g-4 py-5">
      <?php
      // Get current month for summer/winter logic
      $month = date('n');
      $season = ($month >= 4 && $month <= 9) ? 'summer' : 'winter'; // Apr-Sep = summer, else winter
      
      // Query Events Custom Post Type
      $events_query = new WP_Query(array(
        'post_type' => 'events',
        'posts_per_page' => 8, // Show 8 events in 4-column grid
        'orderby' => 'menu_order',
        'order' => 'ASC',
      ));

      if ($events_query->have_posts()):
        while ($events_query->have_posts()):
          $events_query->the_post();

          // Get Data
          $title = get_the_title();
          $image_summer = get_field('image_summer');
          $image_winter = get_field('image_winter');
          $image = ($season === 'summer') ? $image_summer : $image_winter;
          $description = get_field('description');
          $link = get_field('offer_button_url');
          ?>
          <div class="col-12 col-md-6 col-lg-3">
            <?php if ($link): ?>
              <a href="<?php echo esc_url($link); ?>" class="offer-card-link">
              <?php endif; ?>

              <div class="offer-card h1p">
                <?php if ($image): ?>
                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
                <?php endif; ?>

                <div class="offer-overlay">
                  <!-- Static (Always Visible) -->
                  <div class="static-content">
                    <h4 class="offer-title"><?php echo esc_html($title); ?></h4>
                  </div>

                  <!-- Hover Content -->
                  <div class="hover-content">
                    <h4 class="offer-title"><?php echo esc_html($title); ?></h4>

                    <?php if ($description): ?>
                      <p class="offer-desc"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>

                    <?php if ($link): ?>
                      <span class="explore-btn">
                        UTFORSK
                        <span class="arrow">
                          <?php include get_template_directory() . '/assets/images/arrow.svg'; ?>
                        </span>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <?php if ($link): ?>
              </a>
            <?php endif; ?>

          </div>
          <?php
        endwhile;
        wp_reset_postdata();
      else:
        echo '<p>No events found.</p>';
      endif;
      ?>
    </div>
  </div>
</section>




<?php

$repeater_field = ($season === 'summer') ? 'chambre_image_right_summer' : 'chambre_image_right_winter';
?>


<section class="about-section h1p aboutus-hc">
  <div class="container-fluid about-cont p-0">
    <div class="row g-0 h-100">
      <!-- Left Content -->
      <div class="col-12 col-md-6 about-content">
        <div class="about-inner align-items-center hc-text-color h1p p1">
          <h2><?php the_field('chambre_heading'); ?></h2>
          <p class="text-align-center"><?php the_field('chambre_description'); ?></p>

          <div class="link-row">
            <a href="<?php the_field('chambre_link_1_url'); ?>" class="about-link-primary">
              <?php the_field('chambre_link_1_text'); ?>
            </a>
            <a href="<?php the_field('chambre_link_2_url'); ?>" class="about-link-secondary">
              <?php the_field('chambre_link_2_text'); ?>
            </a>
          </div>

          <a href="<?php the_field('chambre_button_url'); ?>" class="about-btn">
            <?php the_field('chambre_button_text'); ?>
          </a>
        </div>
      </div>

      <!-- Right Carousel -->
      <div id="aboutCarousel" class="carousel slide col-12 col-md-6 about-carousel h-100" data-bs-ride="carousel"
        data-bs-interval="3000">
        <div class="carousel-inner">
          <?php if (have_rows($repeater_field)): ?>
            <?php $i = 0; ?>
            <?php while (have_rows($repeater_field)):
              the_row(); ?>
              <?php $image = get_sub_field('chambre_image'); ?>
              <?php if ($image): ?>
                <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                  <img src="<?php echo esc_url($image['url']); ?>" class="d-block w-100"
                    alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
                <?php $i++; ?>
              <?php endif; ?>
            <?php endwhile; ?>
          <?php else: ?>
            <div class="carousel-item active">
              <img src="https://via.placeholder.com/800x400?text=No+Images+Found" class="d-block w-100" alt="No image" />
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
$bg_image = get_field('background_image');
$bg_style = $bg_image ? 'style="background-image: url(' . esc_url($bg_image['url']) . ');"' : '';
?>
<div class="container-portrait  bg-hc-event padding100 h1p">
  <section class="wedding-gallery" <?php echo $bg_style; ?>>

    <div class="container-fluid text-center p-0">
      <?php if ($title = get_field('portrait_title')): ?>
        <h2 class="portrait-title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($desc = get_field('portrait_desc')): ?>
        <p class="portrait-desc"><?php echo esc_html($desc); ?></p>
      <?php endif; ?>

      <?php
      $btn1_text = get_field('portrait_button_1_text');
      $btn1_url = get_field('portrait_button_1_url');
      $btn2_text = get_field('portrait_button_2_text');
      $btn2_url = get_field('portrait_button_2_url');
      ?>

      <?php if ($btn1_text || $btn2_text): ?>
        <div class="portrait-buttons ">
          <?php if ($btn1_text && $btn1_url): ?>
            <a href="<?php echo esc_url($btn1_url); ?>" class="btn btn-primary">
              <?php echo esc_html($btn1_text); ?>
            </a>
          <?php endif; ?>

          <?php if ($btn2_text && $btn2_url): ?>
            <a href="<?php echo esc_url($btn2_url); ?>" class="btn btn-secondary">
              <?php echo esc_html($btn2_text); ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>





      <?php if (have_rows('portraits')): ?>
        <?php
        // First, collect all portrait data with random angles
        $portraits = [];
        while (have_rows('portraits')) {
          the_row();
          $img = get_sub_field('image');
          $label = get_sub_field('label');
          // $angle = rand(-7, 7);
          $portraits[] = [
            'img' => $img,
            'label' => $label
            // 'angle' => $angle
          ];
        }
        ?>

        <?php
        if (have_rows('portraits')):
          $portraits = [];
          while (have_rows('portraits')) {
            the_row();
            $img = get_sub_field('image');
            $portraits[] = ['img' => $img];
          }
          ?>
          <div class="portrait-carousel">
            <div class="carousel-inner">
              <div class="carousel-track">
                <?php foreach (array_merge($portraits, $portraits) as $portrait): ?>
                  <div class="portrait-card">
                    <div class="portrait-image-wrapper">
                      <img src="<?php echo esc_url($portrait['img']['url']); ?>" alt="Portrait">
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

      <?php endif; ?>




    </div>
  </section>
</div>

<?php get_template_part('template-parts/hero-video'); ?>


<?php
$month = date('n');
$season = 'summer';
$repeater_field = ($season === 'summer') ? 'chambre_annen_image_right_summer' : 'chambre_annen_image_right_winter';
?>

<section class="chambre-annen h1p">
  <div class="container-fluid p-0">
    <div class="row g-0 flex-md-row-reverse">


      <div id="ChambreAnnenCarousel" class="carousel slide carousel-fade col-12 col-md-6 chambre-annen-right"
        data-bs-ride="carousel" data-bs-interval="3000">

        <div class="carousel-inner h-100">
          <?php if (have_rows($repeater_field)): ?>
            <?php $i = 0; ?>
            <?php while (have_rows($repeater_field)):
              the_row(); ?>
              <?php $image = get_sub_field('chambre_annen_image'); ?>
              <?php if ($image): ?>
                <div class="carousel-item  <?php echo $i === 0 ? 'active' : ''; ?>">
                  <img src="<?php echo esc_url($image['url']); ?>" class="d-block w-100"
                    alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
                <?php $i++; ?>
              <?php endif; ?>
            <?php endwhile; ?>
          <?php else: ?>
            <div class="carousel-item active">
              <img src="https://via.placeholder.com/800x400?text=No+Images+Found" class="d-block w-100" alt="No image" />
            </div>
          <?php endif; ?>
        </div>
      </div>


      <div class="col-12 col-md-6 chambre-annen-left bg-host">
        <div class="chambre-annen-content p1 bg-host">
          <h3 class="chambre-head"><?php the_field('chambre_annen_heading'); ?></h3>
          <p class="chambre-p"><?php the_field('chambre_annen_description'); ?></p>



          <a href="<?php the_field('chambre_annen_button_url'); ?>" class="host-btn">
            <?php the_field('chambre_annen_button_text'); ?>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>


<div class="container-fluid cards py-5 bg-hc-event ">
  <div class="container pt-5 carousel-wrapper position-relative bg-hc-event padding80">
    <div class="row g-4 pt-5">
      <?php
      $hc_event_cards = new WP_Query(array(
        'post_type' => 'hc_event_cards',
        'posts_per_page' => 3,
        'orderby' => 'menu_order',
        'order' => 'ASC',
      ));

      if ($hc_event_cards->have_posts()):
        while ($hc_event_cards->have_posts()):
          $hc_event_cards->the_post();

          $title = get_the_title();
          $image_summer = get_field('image_summer');
          $image_winter = get_field('image_winter');
          $image = ($season === 'summer') ? $image_summer : $image_winter;
          $description = get_field('description');
          $link = get_field('offer_button_url');
          ?>
          <div class="col-12 col-md-4">
            <a href="<?php echo esc_url($link); ?>">
              <div class="card custom-card h-100">
                <?php if ($image): ?>
                  <img src="<?php echo esc_url($image['url']); ?>" class="card-img-top"
                    alt="<?php echo esc_attr($image['alt']); ?>">
                <?php endif; ?>

                <div class="card-body">
                  <div class="static-content">
                    <h5 class="card-title"><?php echo esc_html($title); ?></h5>
                  </div>

                  <div class="hover-content">
                    <h5 class="card-title"><?php echo esc_html($title); ?></h5>
                    <?php if ($description): ?>
                      <div class="card-row">
                        <p class="card-text"><?php echo esc_html($description); ?></p>
                      </div>
                    <?php endif; ?>
                    <span class="explore-btn">
                      UTFORSKE
                      <span class="arrow">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="Arrow Icon" />
                      </span>
                    </span>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php
        endwhile;
        wp_reset_postdata();
      else:
        echo '<p>No rooms found.</p>';
      endif;
      ?>
    </div>
  </div>
</div>



<?php get_footer('hc_events'); ?>