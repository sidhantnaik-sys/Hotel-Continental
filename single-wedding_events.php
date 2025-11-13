<?php
/**
 * Template Name: single wedding events page
 */
get_header('hc_events'); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
    <section class="room-sections room-detail ">
        <?php if (have_rows('room_sections')): ?>
            <div class="room-sections-wrapper container content h1p  p1 paddingresp">
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
            <div class="container room-gallery paddingresp">
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



        <?php if (get_field('seating_plan_title') || get_field('seating_plan_description') || have_rows('seating_plan_points') || get_field('seating_plan_image')): ?>
        <div class="wedding-details container py-5">
            <!-- Seating Plan -->
            <?php if (get_field('seating_plan_title') || get_field('seating_plan_description') || have_rows('seating_plan_points') || get_field('seating_plan_image')): ?>
                <div class="seating-plan mb-5 h1p p1">
                    <?php if (get_field('seating_plan_title')): ?>
                        <h2><?php the_field('seating_plan_title'); ?></h2>
                    <?php endif; ?>

                    <?php if (get_field('seating_plan_description')): ?>
                        <p><?php the_field('seating_plan_description'); ?></p>
                    <?php endif; ?>

                    <?php if (have_rows('seating_plan_points')): ?>
                        <ul class="seating-plan-list">
                            <?php while (have_rows('seating_plan_points')):
                                the_row(); ?>
                                <li>
                                    <span class="list-icon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon.svg" alt="icon">
                                    </span>
                                    <p class="list-text"><?php the_sub_field('text'); ?></p>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php
                    $seating_video = get_field('seating_plan_image');
                    if ($seating_video): ?>
                        <div class="seating-video1 my-3 w-100">
                            <video controls class="img-fluid" autoplay muted loop playsinline>
                                <source src="<?php echo esc_url($seating_video['url']); ?>"
                                    type="<?php echo esc_attr($seating_video['mime_type']); ?>">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Order of Speeches -->
            <?php if (get_field('order_of_speeches_title') || get_field('order_of_speeches_description') || have_rows('order_of_speeches_points')): ?>
                <div class="order-speeches h1p p1">
                    <?php if (get_field('order_of_speeches_title')): ?>
                        <h2><?php the_field('order_of_speeches_title'); ?></h2>
                    <?php endif; ?>

                    <?php if (get_field('order_of_speeches_description')): ?>
                        <p><?php the_field('order_of_speeches_description'); ?></p>
                    <?php endif; ?>

                    <?php if (have_rows('order_of_speeches_points')): ?>
                        <ul class="list-unstyled">
                            <?php while (have_rows('order_of_speeches_points')):
                                the_row(); ?>
                                <li>
                                    <span class="list-icon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon.svg" alt="icon">
                                    </span>
                                    <p class="list-text"><?php the_sub_field('text'); ?></p>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php
        // Dress Code Section
        $dress_title = get_field('dress_code_title');
        $dress_desc = get_field('dress_code_description');
        $dress_items = get_field('dress_code_items');

        // Toastmaster Section
        $toast_title = get_field('toastmaster_title');
        $toast_desc = get_field('toastmaster_description');
        $pre_dinner = get_field('pre_dinner_checklist');
        $during_meal = get_field('during_meal_checklist');
        ?>

        <?php if ($dress_title || $dress_desc || $dress_items || $toast_title || $toast_desc || $pre_dinner || $during_meal): ?>
            <section class="wedding-info container mt-5 pb-5 h1p p1">
                <!-- Dress Code -->
                <?php if ($dress_title): ?>
                    <h2 class="section-title"><?php echo esc_html($dress_title); ?></h2>
                <?php endif; ?>

                <?php if ($dress_desc): ?>
                    <div class="section-description">
                        <?php echo wp_kses_post($dress_desc); ?>
                    </div>
                <?php endif; ?>

                <?php if ($dress_items): ?>
                    <ul class="dress-list">
                        <?php foreach ($dress_items as $item): ?>
                            <li class="checklist-item">
                                <i class="icon-check"></i>
                                <div class="checklist-content">
                                    <p class="checklist-title"><?php echo ($item['type_title']); ?></p>
                                    <p class="checklist-desc p-0"><?php echo ($item['type_desc']); ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <!-- Toastmaster Guide -->
                <?php if ($toast_title || $toast_desc || $pre_dinner || $during_meal): ?>
                    <div class="container h1p">
                        <?php if ($toast_title): ?>
                            <h2 class="section-title mt-5 h1p"><?php echo esc_html($toast_title); ?></h2>
                        <?php endif; ?>

                        <?php if ($toast_desc): ?>
                            <div class="section-description p1">
                                <?php echo wp_kses_post($toast_desc); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($pre_dinner): ?>
                            <p class="checklist-heading">Toastmasters sjekkliste før middagt</p>
                            <ul class="checklist1">
                                <?php foreach ($pre_dinner as $check): ?>
                                    <li><i class="icon-check"></i> <?php echo esc_html($check['check_item']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($during_meal): ?>
                            <p class="checklist-heading">Toastmasters sjekkliste under måltidet</p>
                            <ul class="checklist1">
                                <?php foreach ($during_meal as $meal): ?>
                                    <li><i class="icon-check"></i> <?php echo esc_html($meal['meal_item']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

    </section>

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
                    $current_id = get_the_ID(); 
                    
                    $wedding_events = new WP_Query(array(
                        'post_type' => 'wedding_events', 
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'post__not_in'   => array($current_id),
                    ));

                    if ($wedding_events->have_posts()):
                        while ($wedding_events->have_posts()):
                            $wedding_events->the_post();

                            // Fetch fields
                            $title = get_the_title();
                            $image_summer = get_field('image_summer');
                            $image_winter = get_field('image_winter');

                            // ✅ Choose image based on season
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

</div>
<?php get_footer('hc_events'); ?>