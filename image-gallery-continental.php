<?php
/**
 * Template Name: Gallery page continental
 */
get_header('continental-suiten'); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<?php
$title = get_field('gallery_title');
$description = get_field('gallery_description');
$button_text = get_field('gallery_button_text');
$button_link = get_field('gallery_button_link');
$images = get_field('gallery_images');
?>

<section class="image-gallery-section room-padding">
  <div class="container text-center gallery-text">
    <?php if ($title): ?>
      <h2><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($description): ?>
      <div class="description">
        <p><?php echo wp_kses_post($description); ?></p>
      </div>
    <?php endif; ?>

    <?php if ($button_text && $button_link): ?>
      <a href="<?php echo esc_url($button_link); ?>" class="download-btn"><?php echo esc_html($button_text); ?></a>
    <?php endif; ?>
  </div>

  <?php
  $images = get_field('gallery_images');
  if ($images):
    $chunks = array_chunk($images, 3); // 2 small + 1 big = 3 images per layout block
    $flip = true;
    ?>
    <div class="patterned-gallery container">
      <?php foreach ($chunks as $set):
        $small1 = $set[0] ?? null;
        $small2 = $set[1] ?? null;
        $big = $set[2] ?? null;
        ?>
        <div class="gallery-block <?php echo $flip ? 'flipped' : ''; ?>">
          <div class="small-column">
            <?php if ($small1): ?>
              <div class="image-wrap">
                <a href="<?php echo esc_url($small1['url']); ?>" class="lightbox-link">
                  <img src="<?php echo esc_url($small1['url']); ?>" alt="">
                </a>
              </div>
            <?php endif; ?>
            <?php if ($small2): ?>
              <div class="image-wrap">
                <a href="<?php echo esc_url($small2['url']); ?>" class="lightbox-link">
                  <img src="<?php echo esc_url($small2['url']); ?>" alt="">
                </a>
              </div>
            <?php endif; ?>
          </div>
          <div class="big-column">
            <?php if ($big): ?>
              <a href="<?php echo esc_url($big['url']); ?>" class="lightbox-link">
                <img src="<?php echo esc_url($big['url']); ?>" alt="">
              </a>
            <?php endif; ?>
          </div>
        </div>
        <?php $flip = !$flip; endforeach; ?>
    </div>
  <?php endif; ?>

</section>

<?php get_footer('continental-suiten'); ?>