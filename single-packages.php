<?php
/**
 * Template Name: single package Page
 */
get_header(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
<?php
// Fields
$hero_image = get_field('hero_image'); // or a dedicated field like 'room_hero_image'
$book_url = get_field('book_now_button');
$description = get_field('full_description');
$title = get_field('title');
$link_text = get_field('link_text');
$website_url = get_field('website_url');
$website_text = get_field('website_text');
$detail_title = get_field('detail_title');
$detail_desc = get_field('detail_description');
$gallery = get_field('gallery');

$opening_image = get_field('opening_image');
$note_txt = get_field('note_text');

$booking_text = get_field('booking_text');
$phone_number = get_field('phone_no');
$email_link = get_field('email1'); // ACF link field
?>

<section class="room-detail">

  <!-- Title & Hero Section -->
  <?php get_template_part('template-parts/restaurant-detail'); ?>



  <!-- opening hours -->
  <section class="restaurant-detail h1p">
    <div class="container restaurant-detail-wrapper d-flex">

      <!-- Left: Image -->
      <div class="restaurant-image-left">
        <?php if ($opening_image): ?>
          <img src="<?php echo esc_url($opening_image['url']); ?>" alt="<?php echo esc_attr($opening_image['alt']); ?>">
        <?php endif; ?>
      </div>

      <!-- Right: Content -->
      <div class="restaurant-content-right p-3 h1p">
        <h1><?php echo ($detail_title); ?></h1>

        <div class="restaurant-description">
          <?php echo wpautop(esc_html($detail_desc)); ?>


          <?php if (have_rows('opening_hours')): ?>
            <section class="restaurant-amenities">

              <div class="amenities-grid">
                <?php while (have_rows('opening_hours')):
                  the_row();
                  $text = get_sub_field('a_text');
                  $icon = get_sub_field('icon');
                  ?>
                  <div class="amenity-item">
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                    <p class="amenity-text"><?php echo esc_html($text); ?></p>
                  </div>
                <?php endwhile; ?>
              </div>
                
                <div class="descpp">
                  <br>
                  <?php echo ($booking_text); ?>
                 
                </div>
              
          </div>
        </div>
      </div>

    </section>
  <?php endif; ?>





  <!-- Gallery Section -->
  <?php get_template_part('template-parts/gallery'); ?>

  </div>
</section>

</div>
<?php get_footer(); ?>