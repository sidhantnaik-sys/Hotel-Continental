<?php
/**
 * Template Name: single offer page
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

                    <div class="room-section text-start <?php echo $layout_class; ?>">

                        <div class="room-image">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
                        </div>

                        <div class="room-content px-3 p1">
                            <h2><?php echo ($title); ?></h2>
                            <div class="desc">
                                <?php echo ($description); ?>
                            </div>
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




        <?php if (get_field('seating_plan_title')): ?>
            <div class="wedding-details container py-1">
                <!-- Seating Plan -->
                <?php if (get_field('seating_plan_title') || get_field('seating_plan_description') || have_rows('seating_plan_points') || get_field('seating_plan_image')): ?>
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
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('sections')): ?>
            <section class="privacy-policy-page container py-5 p1 ">
                <div class="privacy  content px-5">
                    <?php while (have_rows('sections')):
                        the_row(); ?>
                        <div class="policy-section py-3">
                            <h3><?php the_sub_field('heading'); ?></h3>

                            <?php if (get_sub_field('content')): ?>
                                <div class="section-content">
                                    <p><?php the_sub_field('content'); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (have_rows('section_list_items')): ?>
                                <ul class="section-list mx-3">
                                    <?php while (have_rows('section_list_items')):
                                        the_row(); ?>
                                        <li><?php the_sub_field('list_item'); ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>


    </section>
</div>
<?php if (get_field('section_title') || have_rows('menus')): ?>
    <section class="menu-section-offer" id="meny">
        <div class="container text-center">

            <?php if ($section_title = get_field('section_title')): ?>
                <h2 class="section-heading"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if (have_rows('menus')): ?>
                <div class="menu-cards">
                    <?php while (have_rows('menus')):
                        the_row();
                        $menu_title = get_sub_field('menu_title');
                        $menu_image = get_sub_field('menu_image');
                        $menu_link = get_sub_field('menu_link');
                        ?>

                        <?php if ($menu_link): ?>
                            <a href="<?php echo esc_url($menu_link); ?>" class="menu-card">
                            <?php else: ?>
                                <div class="menu-card">
                                <?php endif; ?>

                                <?php if ($menu_image): ?>
                                    <div class="image-wrapper">
                                        <img src="<?php echo esc_url($menu_image['url']); ?>"
                                            alt="<?php echo esc_attr($menu_title); ?>">
                                    </div>
                                <?php endif; ?>

                                <?php if ($menu_title): ?>
                                    <div class="overlay-title h1p"><?php echo esc_html($menu_title); ?></div>
                                <?php endif; ?>

                                <div class="view-button">SE MENY</div>

                                <?php if ($menu_link): ?>
                            </a>
                        <?php else: ?>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        </div>
    </section>
<?php endif; ?>

<?php get_footer('hc_events'); ?>