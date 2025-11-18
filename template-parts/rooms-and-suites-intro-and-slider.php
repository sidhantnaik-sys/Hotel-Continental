<section class="suite-section">

    <div class="suite-content-container container">

        <!-- LEFT TITLE -->
        <div class="suite-text-block container">
            <h2><?php the_field('hrs_second_section_heading'); ?></h2>
        </div>

        <!-- RIGHT DESCRIPTION + BUTTON + ARROWS -->
        <div class="suite-info-block container">
            <div class="hrs-description">
                <p><?php the_field('detailed_description'); ?></p>
            </div>

            <div class="suite-actions">

                <?php
                $button = get_field('hrs_button_link');
                if ($button):
                    ?>
                    <a href="<?php echo esc_url($button['url']); ?>"
                        target="<?php echo esc_attr($button['target'] ?: '_self'); ?>" class="suite-button">
                        <?php echo esc_html($button['title']) ?>
                    </a>
                <?php endif; ?>

                <div class="suite-arrows">
                    <button class="suite-prev arrow-btn"> <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.svg"
                            alt="Previous Arrow"></button>
                    <button class="suite-next arrow-btn"><img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.svg"
                            alt="Next Arrow"></button>
                </div>

            </div>
        </div>

    </div>



</section>

<section class="swiper-section">
    <?php
    $slides = get_field('rooms_and_suites_slides');
    $min_required = 5;
    $slide_count = is_array($slides) ? count($slides) : 0;

    $carousel_images = [];

    if ($slide_count > 0) {
        // Push original slides
        foreach ($slides as $slide) {
            $carousel_images[] = $slide['slide_image'];
        }

        // If fewer than 5 slides, duplicate until we hit at least 5
        while (count($carousel_images) < $min_required) {
            foreach ($slides as $slide) {
                $carousel_images[] = $slide['slide_image'];
                if (count($carousel_images) >= $min_required) {
                    break;
                }
            }
        }
    }
    ?>


    <div class="swiper mySwiper">
        <div class="swiper-wrapper" id="swiperWrapper">
            <?php foreach ($carousel_images as $image): ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>