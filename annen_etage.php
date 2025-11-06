<?php
/*
Template Name: annen Home
*/


get_header('annen_etage');
?>
<?php get_template_part('theatercaffen/hero-image-theater'); ?>
<div class="bg-annen">
    <section class="menu-section ">
        <div class="container text-center">
            <?php if ($section_title = get_field('section_title')): ?>
                <h2 class="section-heading"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if (have_rows('menus')): ?>
                <div class="menu-cards ">
                    <?php while (have_rows('menus')):
                        the_row();
                        $menu_title = get_sub_field('menu_title');
                        $menu_image = get_sub_field('menu_image');
                        $menu_link = get_sub_field('menu_link');
                        ?>
                        <?php if ($menu_link): ?>
                            <a href="<?php echo esc_url($menu_link); ?>" class="menu-card-link">
                            <?php endif; ?>

                            <div class="menu-card">
                                <?php if ($menu_image): ?>
                                    <div class="image-wrapper">
                                        <img src="<?php echo esc_url($menu_image['url']); ?>"
                                            alt="<?php echo esc_attr($menu_title); ?>">
                                    </div>
                                    <?php if ($menu_title): ?>
                                        <div class="overlay-title h1p font"><?php echo esc_html($menu_title); ?></div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="view-button">SE MENY</div>
                            </div>

                            <?php if ($menu_link): ?>
                            </a>
                        <?php endif; ?>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>


    <div class="story-section paddng120">
        <div class="story-inner">

            <!-- Image (Carousel if multiple images) -->
            <div class="story-image">
                <div id="StoryCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-inner">
                        <?php if (have_rows('story_images')): ?>
                            <?php $i = 0; ?>
                            <?php while (have_rows('story_images')):
                                the_row(); ?>
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image): ?>
                                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                                        <img src="<?php echo esc_url($image['url']); ?>"
                                            alt="<?php echo esc_attr($image['alt']); ?>">
                                    </div>
                                    <?php $i++; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="story-content h1p textcolor">
                <?php if ($story_title = get_field('story_title')): ?>
                    <h2><?php echo esc_html($story_title); ?></h2>
                <?php endif; ?>

                <?php if ($story_description = get_field('story_description')): ?>
                    <p><?php echo ($story_description); ?></p>
                <?php endif; ?>

                <?php if ($book_url = get_field('book_url')): ?>
                    <a href="<?php echo esc_url($book_url); ?>" class="btn-book">BESTILL ET BORD</a>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <?php
    $month = date('n'); // 1 = Jan, 12 = Dec
    
    // Determine season
    $season = 'summer';

    ?>
    <?php

    $repeater_field = ($season === 'summer') ? 'chambre_image_right_summer' : 'chambre_image_right_winter';
    ?>


    <section class="ourmenu h1p textcolor paddng120">


        <div class="container p-0">
            <div class="row g-0">
                <div class="col-12 col-md-6 ourmenu-left ">
                    <div class="ourmenu-content textcolor h1p">
                        <h2><?php the_field('chambre_heading'); ?></h2>
                        <p><?php the_field('chambre_description'); ?></p>
                        <div class="link-row">
                            <a href="<?php the_field('chambre_link_1_url'); ?>"
                                class="Chambre-link1"><?php the_field('chambre_link_1_text'); ?></a>
                            <a href="<?php the_field('chambre_link_2_url'); ?>"
                                class="Chambre-link2"><?php the_field('chambre_link_2_text'); ?></a>
                        </div>

                        <a href="<?php the_field('chambre_button_url'); ?>" class="Chambre-btn">
                            <?php the_field('chambre_button_text'); ?>
                        </a>
                    </div>
                </div>


                <div id="ChambreCarousel" class="carousel slide carousel-fade col-12 col-md-6 Chambre-right"
                    data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <?php if (have_rows($repeater_field)): ?>
                            <?php $i = 0; ?>
                            <?php while (have_rows($repeater_field)):
                                the_row(); ?>
                                <?php $image = get_sub_field('chambre_image'); ?>
                                <?php if ($image): ?>
                                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                                        <img src="<?php echo esc_url($image['url']); ?>" class="d-block w-100"
                                            alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                    <?php $i++; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/800x400?text=No+Images+Found" class="d-block w-100"
                                    alt="No image" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <?php
    $month = date('n');
    $season = 'summer';
    $repeater_field = ($season === 'summer') ? 'chambre_annen_image_right_summer' : 'chambre_annen_image_right_winter';
    ?>

    <section class="chambre-annen h1p ">
        <div class="container-fluid p-0">
            <div class="row g-0 flex-md">


                <div id="ChambreAnnenCarousel" class="carousel slide carousel-fade col-12 col-md-6 chambre-annen-right"
                    data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <?php if (have_rows($repeater_field)): ?>
                            <?php $i = 0; ?>
                            <?php while (have_rows($repeater_field)):
                                the_row(); ?>
                                <?php $image = get_sub_field('chambre_annen_image'); ?>
                                <?php if ($image): ?>
                                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                                        <img src="<?php echo esc_url($image['url']); ?>" class="d-block w-100"
                                            alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                    <?php $i++; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/800x400?text=No+Images+Found" class="d-block w-100"
                                    alt="No image" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="col-12 col-md-6 chambre-annen-left">
                    <div class="chambre-annen-content">
                        <h2><?php the_field('chambre_annen_heading'); ?></h2>
                        <p><?php the_field('chambre_annen_description'); ?></p>



                        <a href="<?php the_field('chambre_annen_button_url'); ?>" class="chambre-annen-btn">
                            <?php the_field('chambre_annen_button_text'); ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <div class="container-fluid bgcolor1 cards py-5 padding120">
        <div class="container carousel-wrapper position-relative px-0 pt-5 ">

            <div class="container annen-cards">
                <div class="row g-4">
                    <?php
                    $annen_cards = new WP_Query(array(
                        'post_type' => 'annen_cards',
                        'posts_per_page' => 3, // ✅ show only 3
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ));

                    if ($annen_cards->have_posts()):
                        while ($annen_cards->have_posts()):
                            $annen_cards->the_post();

                            $title = get_the_title();
                            $image_summer = get_field('image_summer');
                            $image_winter = get_field('image_winter');
                            $image = ($season === 'summer') ? $image_summer : $image_winter;
                            $link = get_field('offer_button_url');
                            $description = get_field('description');
                            ?>

                            <div class="col-md-4">
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
                                                        <p class="card-text"><?php echo esc_html($description); ?></p>
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
                        wp_reset_postdata();
                    else: ?>
                        <p>No rooms found.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer('annen_etage'); ?>