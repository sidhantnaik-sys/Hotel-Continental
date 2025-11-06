<?php
/**
 * Template Name: single venue page
 */
get_header('hc_events'); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
    <section class="room-sections room-detail ">
        <?php if (have_rows('room_sections')): ?>
            <div class="room-sections-wrapper container content h1p a1 p1 paddingresp">
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
        <?php if (
            get_field('seating_plan_title') ||
            get_field('seating_plan_description') ||
            have_rows('seating_plan_points') ||
            get_field('seating_plan_image')
        ): ?>
            <div class="wedding-details container py-5">
                <!-- Seating Plan -->
                <div class="seating-plan mb-5 h1p p1">
                    <?php if (get_field('seating_plan_title')): ?>
                        <h5><?php the_field('seating_plan_title'); ?></h5>
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
                </div>
            </div>
        <?php endif; ?>


    </section>
</div>

<?php get_footer('hc_events'); ?>