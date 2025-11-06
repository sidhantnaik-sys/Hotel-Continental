<?php
/**
 * Template Name: theatre Page
 */
get_header(); ?>

<section class="offers-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5">Utforsk Tilbudene Våre</h2>
    <div class="row g-4">

      <?php if (have_rows('offers')): ?>
        <?php while (have_rows('offers')):
          the_row();
          $image = get_sub_field('image');
          $title = get_sub_field('title');
          ?>
          <div class="col-md-3 col-sm-6">
            <div class="offer-card">
              <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
              <div class="offer-overlay">
                <p><?php echo esc_html($title); ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>
