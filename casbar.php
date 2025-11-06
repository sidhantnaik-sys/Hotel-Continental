<?php
/**
 * Template Name: casbar Page
 */
get_header('casbar'); ?>
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
  <section class="hero-casbar hero text-white d-flex align-items-center position-relative">
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

<div class="casbar-bg">
  <section class="menu-section-casbar ">
    <div class="container text-center">
      <?php if ($section_title = get_field('section_title')): ?>
        <h2 class="section-heading"><?php echo esc_html($section_title); ?></h2>
      <?php endif; ?>

      <?php if (have_rows('menus')): ?>
        <div class="menu-cards">
          <?php while (have_rows('menus')):
            the_row();
            $menu_title = get_sub_field('menu_title');
            $menu_image = get_sub_field('menu_image');
            $menu_link = get_sub_field('menu_link');
            ?>

            <?php if ($menu_link): ?>
              <a href="<?php echo esc_url($menu_link); ?>" class="menu-card-link">
              <?php endif; ?>

              <div class="menu-card">
                <?php if ($menu_image): ?>
                  <div class="image-wrapper">
                    <img src="<?php echo esc_url($menu_image['url']); ?>" alt="<?php echo esc_attr($menu_title); ?>">
                  </div>
                <?php endif; ?>

                <?php if ($menu_title): ?>
                  <div class="overlay-title h1p font"><?php echo esc_html($menu_title); ?></div>
                <?php endif; ?>

                <?php if ($menu_link): ?>
                  <span class="view-button">VIEW MENU</span>
                <?php endif; ?>
              </div>

              <?php if ($menu_link): ?>
              </a>
            <?php endif; ?>

          <?php endwhile; ?>
        </div>

      <?php endif; ?>
    </div>
  </section>

  <div class="story-section-casbar container-fluid">

    <div class="row align-items-center story-inner">

      <!-- Image (Carousel if multiple images) -->
      <div class="col-md-6 story-image">
        <div id="StoryCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
          <div class="carousel-inner">
            <?php if (have_rows('story_images')): ?>
              <?php $i = 0; ?>
              <?php while (have_rows('story_images')):
                the_row(); ?>
                <?php $image = get_sub_field('image'); ?>
                <?php if ($image): ?>
                  <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                      class="img-fluid">
                  </div>
                  <?php $i++; ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="col-md-6  h1p">
        <div class="story-content">
          <?php if ($story_title = get_field('story_title')): ?>
            <h2><?php echo esc_html($story_title); ?></h2>
          <?php endif; ?>

          <?php if ($story_description = get_field('story_description')): ?>
            <p><?php echo ($story_description); ?></p>
          <?php endif; ?>

          <?php if ($book_url = get_field('book_url')): ?>
            <a href="<?php echo esc_url($book_url); ?>" class="btn-book">CONTACT US</a>
          <?php endif; ?>
        </div>
      </div>

    </div>

  </div>

  <div class="padding120 ptt">

    <section class="bottled-selections-casbar h1p pt-5" id="ourmenucasbar">
      <div class="container">
        <div class="row ">
          <!-- Left Section -->
          <div class="col-lg-6 ">
            <div class="bottle-content">
              <?php if (get_field('section_title1')): ?>
                <h2 class="section-title mb-4"><?php the_field('section_title1'); ?></h2>
              <?php endif; ?>
              <?php if (get_field('section-descpt')): ?>
                <p class="menu-title"><?php the_field('section-descpt'); ?></p>
              <?php endif; ?>

              <?php if (have_rows('wine_categories')): ?>
                <!-- Unique Tabs ID -->
                <ul class="nav nav-tabs" id="bottledWineTabs" role="tablist">
                  <?php
                  $i = 0;
                  while (have_rows('wine_categories')):
                    the_row();
                    $category_title = get_sub_field('category_title');
                    ?>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link <?php echo $i === 0 ? 'active' : ''; ?>" id="bottled-tab-<?php echo $i; ?>"
                        data-bs-toggle="tab" data-bs-target="#bottled-content-<?php echo $i; ?>" type="button" role="tab"
                        aria-controls="bottled-content-<?php echo $i; ?>"
                        aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                        <?php echo esc_html($category_title); ?>
                      </button>
                    </li>
                    <?php $i++; endwhile; ?>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content mt-3" id="bottledWineTabsContent">
                  <?php
                  $i = 0;
                  while (have_rows('wine_categories')):
                    the_row();
                    ?>
                    <div class="tab-pane fade <?php echo $i === 0 ? 'show active' : ''; ?>"
                      id="bottled-content-<?php echo $i; ?>" role="tabpanel"
                      aria-labelledby="bottled-tab-<?php echo $i; ?>">

                      <?php if (have_rows('wines')): ?>
                        <ul class="wine-list">
                          <?php while (have_rows('wines')):
                            the_row(); ?>
                            <!-- <li>

                          <span class="wine-name"><?php the_sub_field('wine_name'); ?></span>
                          <span class="clist_line"><?php the_sub_field('wine_desc'); ?></span>
                          <?php
                          $wine_price = get_sub_field('wine_price');
                          if ($wine_price): ?>
                            <span class="wine-price">NOK <?php echo esc_html($wine_price); ?>,-</span>
                          <?php endif; ?>

                        </li> -->
                            <li class="dish-item d-flex justify-content-between align-items-start">
                              <div class="dish-info">
                                <strong class="list_heading"><?php the_sub_field('wine_name'); ?></strong><br>
                                <span class="list_line"><?php the_sub_field('wine_desc'); ?></span>
                              </div>

                              <?php if (get_sub_field('wine_price')): ?>
                                <span class="dish-price"><?php the_sub_field('wine_price'); ?></span>
                              <?php endif; ?>
                            </li>
                          <?php endwhile; ?>
                        </ul>
                      <?php endif; ?>

                    </div>
                    <?php $i++; endwhile; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Right Image -->
          <div class="col-lg-6 text-center">
            <?php
            $image = get_field('side_image');
            if ($image): ?>
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                class="img-fluid">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>


    <section class="our-menu-section-casbar container-fluid py-5" id="barmenucasbar">
      <div class="container">
        <div class="row align-items-start h1p textcolor">
          <!-- Left Image -->
          <div class="col-lg-6 menu-image">
            <?php $menu_img = get_field('menu_image'); ?>
            <?php if ($menu_img): ?>
              <img src="<?php echo esc_url($menu_img['url']); ?>" alt="<?php echo esc_attr($menu_img['alt']); ?>"
                class="img-fluid">
            <?php endif; ?>
          </div>


          <!-- Right Content -->
          <div class="col-lg-6 menu-content ">
            <!-- Title -->
            <?php if (get_field('menu_title')): ?>
              <h2 class="menu-title"><?php the_field('menu_title'); ?></h2>
            <?php endif; ?>


            <?php if (have_rows('menu_tabs')): ?>
              <!-- Tabs Navigation -->
              <ul class="nav nav-tabs" id="menuTabs" role="tablist">
                <?php $i = 0;
                while (have_rows('menu_tabs')):
                  the_row(); ?>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link <?php echo $i === 0 ? 'active' : ''; ?>" id="tab-<?php echo $i; ?>"
                      data-bs-toggle="tab" data-bs-target="#tab-content-<?php echo $i; ?>" type="button" role="tab">
                      <?php the_sub_field('tab_title'); ?>
                    </button>
                  </li>
                  <?php $i++; endwhile; ?>
              </ul>

              <!-- Tabs Content -->
              <div class="tab-content mt-3" id="menuTabsContent">
                <?php $i = 0;
                reset_rows();
                while (have_rows('menu_tabs')):
                  the_row(); ?>
                  <div class="tab-pane fade <?php echo $i === 0 ? 'show active' : ''; ?>" id="tab-content-<?php echo $i; ?>"
                    role="tabpanel">
                    <?php if (have_rows('tab_dishes')): ?>
                      <ul class="dish-list">
                        <?php while (have_rows('tab_dishes')):
                          the_row(); ?>
                          <li class="dish-item d-flex justify-content-between align-items-start">
                            <div class="dish-info">
                              <strong class="list_heading"><?php the_sub_field('dish_title'); ?></strong><br>
                              <span class="list_line"><?php the_sub_field('dish_description'); ?></span>
                            </div>

                            <?php if (get_sub_field('dish_price')): ?>
                              <span class="dish-price"><?php the_sub_field('dish_price'); ?></span>
                            <?php endif; ?>
                          </li>
                        <?php endwhile; ?>
                      </ul>
                    <?php endif; ?>

                  </div>
                  <?php $i++; endwhile; ?>
              </div>
            <?php endif; ?>
          </div>



        </div>

      </div>
    </section>

  </div>


  <div class="container-portrait-casbar py-5 h1p">
    <section class="portrait-gallery-casbar">

      <div class="container-fluid text-center">
        <?php if ($title = get_field('portrait_title')): ?>
          <h2 class="portrait-title"><?php echo esc_html($title); ?></h2>
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


        <?php if ($desc = get_field('portrait_desc')): ?>
          <p class="portrait-desc"><?php echo esc_html($desc); ?></p>
        <?php endif; ?>

      </div>
    </section>
  </div>



  <section class="opening-hours-section">
    <div class="container-fluid">
      <div class="row align-items-center h-100">

        <!-- Left Content -->
        <div class="col-md-6 opening-text">
          <h2><?php the_field('opening_title'); ?></h2>
          <p><?php the_field('opening_description'); ?></p>

          <?php if (have_rows('opening_hours')): ?>
            <div class="opening-timings">
              <h6>Our Timings</h6>
              <ul class="list-unstyled">
                <?php while (have_rows('opening_hours')):
                  the_row(); ?>
                  <li class="d-flex justify-content-between">
                    <span><?php the_sub_field('day'); ?></span>
                    <span><?php the_sub_field('time'); ?></span>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>

        <!-- Right Image -->
        <div class="col-md-6 opening-image text-center">
          <?php
          $opening_img = get_field('opening_image');
          if ($opening_img): ?>
            <img class="img-fluid" src="<?php echo esc_url($opening_img['url']); ?>"
              alt="<?php echo esc_attr($opening_img['alt']); ?>" />
          <?php endif; ?>
        </div>

      </div>
    </div>
  </section>






</div>
<?php get_footer('casbar'); ?>