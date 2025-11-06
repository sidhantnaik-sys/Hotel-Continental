<?php
/*
Template Name: english annen
*/


get_header('annen_etage');
?>
<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="bg-annen">
<section class="luxury-section container-fluid py-5 h1p paddngrest">
    <div class="container pt-5">
        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-6 luxury-content">
                <!-- Title -->
                <?php if (get_field('luxury_title')): ?>
                    <h2 class="luxury-title"><?php the_field('luxury_title'); ?></h2>
                <?php endif; ?>

                <!-- Description -->
                <?php if (get_field('luxury_description')): ?>
                    <p class="luxury-description"><?php the_field('luxury_description'); ?></p>
                <?php endif; ?>

                <div class="row menu-tables">
                    <!-- Menu Prices -->
                    <div class="col-6">
                        <h5>Menu</h5>
                        <ul>
                            <?php if (have_rows('luxury_menu')): ?>
                                <?php while (have_rows('luxury_menu')):
                                    the_row(); ?>
                                    <li>
                                        <?php the_sub_field('course_name'); ?>
                                        <span>NOK <?php the_sub_field('price'); ?></span>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Wine Menu Prices -->
                    <div class="col-6">
                        <h5>Wine Menu</h5>
                        <ul>
                            <?php if (have_rows('luxury_wine_menu')): ?>
                                <?php while (have_rows('luxury_wine_menu')):
                                    the_row(); ?>
                                    <li>
                                        <?php the_sub_field('wine_course_name'); ?>
                                        <span>NOK <?php the_sub_field('wine_price'); ?></span>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Button -->
                <?php if (get_field('luxury_button_link')): ?>
                    <a href="<?php the_field('luxury_button_link'); ?>" class="luxury-btn">
                        <?php the_field('luxury_button_text'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Right Image -->
            <div class="col-lg-6 luxury-image">
                <?php $image = get_field('luxury_image'); ?>
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                        class="img-fluid" />
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<section class="join-our-team container-fluid paddngrest">
    <div class="container">
        <div class="row h1p flex-row-reverse">

            <!-- Left Side: Content -->
            <div class="col-lg-6 join-team-content p1 px-4">
                <?php if (get_field('join_team_title')): ?>
                    <h2 class="section-title"><?php the_field('join_team_title'); ?></h2>
                <?php endif; ?>

                <?php if (get_field('join_team_desc')): ?>
                    <p class="description"><?php the_field('join_team_desc'); ?></p>
                <?php endif; ?>

                <?php if (have_rows('join_team_positions')): ?>
                    <div class="positions">
                        <h4><?php the_field('second_title')?></h4>
                        <ul>
                            <?php while (have_rows('join_team_positions')):
                                the_row(); ?>
                                <li>
                                    <?php the_sub_field('position_title'); ?>
                                    
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Side: Image -->
            <div class="col-lg-6 join-team-image">
                <?php $image = get_field('join_team_image'); ?>
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="contact-us-section paddngrest">
  <div class="container pb-5">
    <div class="row  h1p">
      <!-- Left Content -->
      <div class="col-md-6 contact-content">
        <?php if (get_field('contact_title')): ?>
          <h2 class="section-title"><?php the_field('contact_title'); ?></h2>
        <?php endif; ?>

        <?php if (get_field('contact_desc')): ?>
          <p><?php the_field('contact_desc'); ?></p>
        <?php endif; ?>

        <ul class="contact-info">
          <?php if (get_field('contact_phone')): ?>
            <li>
              <i class="fas fa-phone-alt fa-flip-horizontal"></i>
              <a href="tel:<?php the_field('contact_phone'); ?>">
                <?php the_field('contact_phone'); ?>
              </a>
            </li>
          <?php endif; ?>

          <?php if (get_field('contact_email')): ?>
            <li>
              <i class="fas fa-envelope"></i>
              <a href="mailto:<?php the_field('contact_email'); ?>">
                <?php the_field('contact_email'); ?>
              </a>
            </li>
          <?php endif; ?>

          <?php if (get_field('contact_address')): ?>
            <li>
              <i class="fas fa-map-marker-alt"></i>
              <p><?php the_field('contact_address'); ?></p>
            </li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Right Image -->
      <div class="col-md-6 contact-image">
        <?php if ($image = get_field('contact_image')): ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
</div>

<?php get_footer('annen_etage'); ?>