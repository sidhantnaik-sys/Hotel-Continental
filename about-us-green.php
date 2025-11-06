<?php
/**
 * Template Name: about us green page
 */
get_header(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
    <?php
    // Fields
    $hero_image = get_field('image_green'); // or a dedicated field like 'room_hero_image'
    $book_url = get_field('book_now_button');
    $description = get_field('full_description');
    $title = get_field('book_title');
    ?>
    <section class="room-detail">
        <div class="container">
            <!-- Title & Hero Section -->
            <div class="container room-header h1p truffle-h1">
                <div class="container room-text py-5">
                    <h2><?php echo esc_html($title);
                    ?></h2>
                    <div class="book-description py-3">
                        <?php echo wpautop(($description)); ?>
                    </div>

                    <?php if ($book_url): ?>
                        <a href="<?php echo esc_url($book_url); ?>" class="btn btn-book">BOK NÅ</a>
                    <?php endif; ?>
                </div>
                <div class="room-image">
                    <?php if ($hero_image): ?>
                        <img src="<?php echo esc_url($hero_image['url']); ?>"
                            alt="<?php echo esc_attr($hero_image['alt']); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us">
        <div class="sustainability container py-5">

            <!-- Eco Certification -->
            <section class="section-block h1p truffle-h1 p1">
                <h3><?php the_field('eco_title'); ?></h3>
                <div class="section-content ">
                    <?php the_field('eco_content'); ?>
                </div>
            </section>

            <!-- Reduce Food Waste -->
            <section class="section-block h1p truffle-h1 p1">
                <h3><?php the_field('food_waste_title'); ?></h3>
                <div class="section-content">
                    <?php the_field('food_waste_content'); ?>
                </div>
            </section>

            <!-- Green Initiatives -->
            <section class="section-block h1p truffle-h1 p1">
                <h3><?php the_field('green_title'); ?></h3>
                <div class="section-content">
                    <?php the_field('green_intro'); ?>

                    <?php if (have_rows('green_list')): ?>
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
                                        <p class="main-text"><?php echo esc_html($main); ?></p>

                                        <?php if (have_rows('subpoints')): ?>
                                            <ul class="subpoint-list">
                                                <?php while (have_rows('subpoints')):
                                                    the_row();
                                                    $sub = get_sub_field('subpoint_text'); ?>
                                                    <li><?php echo esc_html($sub); ?></li>
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

            <!-- Guest Encouragement -->
            <section class="section-block h1p truffle-h1 p1">
                <h3><?php the_field('guest_title'); ?></h3>
                <div class="section-content">
                    <?php the_field('guest_content'); ?>
                </div>
            </section>

        </div>

    </section>
</div>

<?php get_footer(); ?>