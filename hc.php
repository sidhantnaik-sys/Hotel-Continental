<?php
/**
 * Template Name:  hc Page
 */
get_header('hc_events'); ?>
<?php $season = get_current_season(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<?php get_template_part('template-parts/hero_video_main'); ?>

<div class="padding120 bg-hc-events">
    <section class="room-sections room-detail bg-hc-events">
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

        <?php
        $gallery = get_field('gallery');
        ?>
        <?php if ($gallery): ?>
            <div class="container room-gallery">
                <h2>Bildegalleri</h2>
                <div class="gallery-grid">
                    <?php foreach ($gallery as $img): ?>
                        <div class="image-wrapper">
                            <a href="<?php echo esc_url($img['url']); ?>" class="popup-link">
                                <img src="<?php echo esc_url($img['sizes']['medium_large']); ?>"
                                    alt="<?php echo esc_attr($img['alt']); ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>


    <div class="container-fluid cards py-5 h1p bg-hc-events">
        <div class="container carousel-wrapper position-relative">
            <div class="carousel-header p-2">
                <h2><?php the_field('room_cards_heading'); ?></h2>
                
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
                    $party_events = new WP_Query(array(
                        'post_type' => 'party_events',
                        'posts_per_page' => 4,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ));

                    if ($party_events->have_posts()):
                        while ($party_events->have_posts()):
                            $party_events->the_post();

                            // ✅ Fetch fields
                            $title = get_the_title();
                            $image_summer = get_field('image_summer');
                            $image_winter = get_field('image_winter');

                            // ✅ Choose image based on season (use your $season variable)
                            $image = ($season === 'summer') ? $image_summer : $image_winter;

                            $price = get_field('price');
                            $amenities = get_field('amenities');
                            $description = get_field('description');
                            $link = get_permalink();
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

    <div class="container-fluid bg-hc-event py-5">
        <section class="hero-banner container position-relative bg-hc-event">
            <?php if ($video = get_field('hero_background_video')): ?>
                <video class="hero-bg position-absolute top-0 start-0 w-100 h-100 pb-5" autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>


            <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

            <div class="container-fluid position-absolute z-2 overlay">
                <div class="row  align-items-center justify-content-center text-center">
                    <div class="center-content">
                        <?php if ($title = get_field('hero_heading_text')): ?>
                            <h1 class="hero-title mb-4"><?php echo esc_html($title); ?></h1>
                        <?php endif; ?>

                        <?php
                        $btn_text = get_field('hero_button_text');
                        $btn_url = get_field('hero_button_url');
                        ?>

                        <?php if ($btn_text && $btn_url): ?>
                            <a href="<?php echo esc_url($btn_url); ?>" class="hero-button">
                                <?php echo esc_html($btn_text); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php get_footer('hc_events'); ?>