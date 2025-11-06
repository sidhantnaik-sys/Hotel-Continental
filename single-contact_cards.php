<?php
/**
 * Template Name: single contact Page
 */
get_header(); ?>
<?php $season = get_current_season(); ?>


<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">

<?php
// Fields
$hero_image = get_field('image_room'); // or a dedicated field like 'room_hero_image'
$book_url = get_field('book_now_button');
$description = get_field('full_description');
$title = get_field('room_title');
?>
<?php if ($hero_image || $description || $title): ?>
  <section class="room-detail h1p">
    <div class="container">
      <div class="container room-header">
        <div class="container room-text py-5 truffle-h1">
          <h2><?php echo esc_html($title); ?></h2>
          <div class="room-description">
            <?php echo wpautop($description); ?>
          </div>

          <?php if ($book_url): ?>
            <a href="<?php echo esc_url($book_url); ?>" class="btn btn-book">Book Now</a>
          <?php endif; ?>
        </div>
        <div class="room-image">
          <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>







<?php
$green_title = get_field('green_title');
$green_intro = get_field('green_intro');
$has_green_list = have_rows('green_list');

if ($green_title || $green_intro || $has_green_list):
  ?>
  <section class="about-us">
    <div class="sustainability container py-5 px-4 h1p truffle-h1 p1">
      <section class="section-block">
        <?php if ($green_title): ?>
          <h3><?php echo esc_html($green_title); ?></h3>
        <?php endif; ?>

        <div class="section-content">
          <?php if ($green_intro): ?>
           <p> <?php echo wp_kses_post($green_intro); ?></p>
          <?php endif; ?>

          <?php if ($has_green_list): ?>
            <div class="green-list">
              <?php while (have_rows('green_list')):
                the_row();
                $icon = get_sub_field('icon');
                $main = get_sub_field('point_text'); ?>

                <div class="green-item">
                  <?php if ($icon): ?>
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                  <?php endif; ?>

                  <div class="green-content">
                    <p class="main-text"><?php echo ($main); ?></p>

                    <?php if (have_rows('subpoints')): ?>
                      <ul class="subpoint-list">
                        <?php while (have_rows('subpoints')):
                          the_row();
                          $sub = get_sub_field('subpoint_text'); ?>
                          <li><?php echo ($sub); ?></li>
                        <?php endwhile; ?>
                      </ul>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
      </section>
    </div>
  </section>
<?php endif; ?>


<?php
$key_title = get_field('key_title');
$key_para = get_field('key_para');
if ($key_title || $key_para):
  ?>
  <section class="members">
  <div class="container key-members h1p truffle-h1 p1">
    <h2> <?php echo ($key_title); ?></h2>
    <p><?php echo ($key_para); ?></p>
    </div>

    <?php if (have_rows('staff_members')): ?>
      <div class="staff-members-grid container py-5">
        <?php while (have_rows('staff_members')):
          the_row();
          $photo = get_sub_field('image');
          $name = get_sub_field('name');
          $designation = get_sub_field('position');
          $contact_label = get_sub_field('contact_label');
          $phone = get_sub_field('phone');
          $email = get_sub_field('email');
          ?>
          <div class="staff-card">
            <?php if ($photo): ?>
              <div class="staff-image">
                <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>">
              </div>
            <?php endif; ?>

            <div class="staff-info">
              <div class="static-content">
                <h5 class="staff-name"><?php echo esc_html($name); ?></h5>
                <p class="staff-role"><?php echo esc_html($designation); ?></p>
              </div>

              <div class="hover-content ">
                <p class="contact-label"><?php echo esc_html($contact_label); ?></p>
                <div class="contacts">
                <?php if ($phone): ?>
                  <?php echo ($phone); ?>
                <?php endif; ?>
                <?php if ($email): ?>
                  <?php echo ($email); ?>
                <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>


  
  </section>
<?php endif; ?>

</div>
<?php get_footer(); ?>