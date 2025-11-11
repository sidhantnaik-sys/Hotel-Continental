<?php
/**
 * Template Name:  special occasions page
 */
get_header('hc_events'); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<section class="room-sections padding120">
    <?php if (have_rows('room_sections')): ?>
        <div class="room-sections-wrapper container content h1p ">
            <?php
            $count = 0;
            while (have_rows('room_sections')):
                the_row();
                $title = get_sub_field('section_title');
                $description = get_sub_field('section_description');
                $image = get_sub_field('section_image');

                // Alternate layout (even = left image, odd = right image)
                $layout_class = ($count % 2 === 0) ? 'image-right' : 'image-left';
                ?>

                <div class="room-section <?php echo $layout_class; ?>">

                    <div class="room-image">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
                    </div>

                    <div class="room-content px-3 p1">
                        <h2><?php echo ($title); ?></h2>
                        <p><?php echo ($description); ?></p>
                    </div>

                </div>

                <?php $count++; endwhile; ?>
        </div>
    <?php endif; ?>


    <div class="container-fluid cards py-5">
        <div class="container carousel-wrapper position-relative">
            <div class="carousel-header p-2">
                <h1><?php the_field('room_cards_heading'); ?></h1>

            </div>
            <div class="carousel-buttons">
                <button class="carousel-prev arrow-btn">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.svg"
                        alt="Previous Arrow">
                </button>
                <button class="carousel-next arrow-btn">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.svg"
                        alt="Next Arrow">
                </button>
            </div>





            <div class="swiper suite-swiper">
                <div class="swiper-wrapper">
                    <?php
                    // Fetch Special Occasion posts
                    $special_occasions = new WP_Query(array(
                        'post_type' => 'special_occasion', // ✅ New custom post type slug
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ));

                    if ($special_occasions->have_posts()):
                        while ($special_occasions->have_posts()):
                            $special_occasions->the_post();

                            // Fetch fields
                            $title = get_the_title();
                            $image_summer = get_field('image_summer');
                            $image_winter = get_field('image_winter');

                            // ✅ Choose image based on season
                            $image = ($season === 'summer') ? $image_summer : $image_winter;

                            $price = get_field('price');
                            $amenities = get_field('amenities');
                            $description = get_field('description');
                            $offer_link = get_field('offer_button_url'); // ACF link field
                            $link = '';

                            if ($offer_link) {
                                $link = is_array($offer_link) && isset($offer_link['url']) ? $offer_link['url'] : $offer_link;
                            } else {
                                $link = get_permalink();
                            }
                            ?>
                            <div class="swiper-slide suite-card" data-category="<?php echo esc_attr(strtolower($category)); ?>">
                                <a href="<?php echo esc_url($link); ?>">
                                    <div class="card custom-card">
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
                                                        <span class="card-text"><?php echo esc_html($description); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="explore-btn">
                                                    UTFORSK
                                                    <span class="arrow">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg"
                                                            alt="Arrow Icon" />
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php else: ?>
                        <p>No rooms found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</section>
<?php get_footer('hc_events'); ?>