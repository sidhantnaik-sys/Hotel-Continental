<?php
/*
Template Name: theatercaffen Home
*/


get_header('theatercaffen');
?>

<?php get_template_part('theatercaffen/hero-image-theater'); ?>

<div class="black-bg">
    <section class="menu-section " id="meny">
        <div class="container text-center">
            <?php if ($section_title = get_field('section_title')): ?>
                <h2 class="section-heading"><?php echo ($section_title); ?></h2>
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

                                    <?php if ($menu_title): ?>
                                        <div class="overlay-title h1p"><?php echo esc_html($menu_title); ?></div>
                                    <?php endif; ?>
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

<div class="story-section">
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
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                                <?php $i++; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="story-content h1p">
            <?php if ($story_title = get_field('story_title')): ?>
                <h2><?php echo esc_html($story_title); ?></h2>
            <?php endif; ?>

            <?php if ($story_description = get_field('story_description')): ?>
                <p><?php echo ($story_description); ?></p>
            <?php endif; ?>

            <?php
            $book_link = get_field('book_url'); // ACF "Link" field
            if ($book_link):
                $link_url = $book_link['url'];
                $link_title = $book_link['title'];
                $link_target = $book_link['target'] ? $book_link['target'] : '_self';
                ?>
                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="btn-book">
                    <?php echo esc_html($link_title); ?>
                </a>
            <?php endif; ?>

        </div>

    </div>
</div>



<?php
$bg_image = get_field('background_image');
$bg_style = $bg_image ? 'style="background-image: url(' . esc_url($bg_image['url']) . ');"' : '';
?>
<div class="container-portrait py-5 h1p">
    <section class="portrait-gallery" <?php echo $bg_style; ?>>

        <div class="container-fluid text-center">
            <?php if ($title = get_field('portrait_title')): ?>
                <h2 class="portrait-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>



            <?php if (have_rows('portraits')): ?>
                <?php
                // First, collect all portrait data with random angles
                $portraits = [];
                while (have_rows('portraits')) {
                    the_row();
                    $img = get_sub_field('image');
                    $label = get_sub_field('label');
                    // $angle = rand(-7, 7);
                    $portraits[] = [
                        'img' => $img,
                        'label' => $label
                        // 'angle' => $angle
                    ];
                }
                ?>

                <?php
                if (have_rows('portraits')):
                    $portraits = [];
                    while (have_rows('portraits')) {
                        the_row();
                        $img = get_sub_field('image');
                        $portraits[] = ['img' => $img];
                    }
                    ?>
                    <div class="portrait-carousel">
                        <div class="carousel-inner">
                            <div class="carousel-track">
                                <?php foreach (array_merge($portraits, $portraits) as $portrait): ?>
                                    <div class="portrait-card">
                                        <div class="portrait-image-wrapper">
                                            <img src="<?php echo esc_url($portrait['img']['url']); ?>" alt="Portrait">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>


            <?php if ($desc = get_field('portrait_desc')): ?>
                <p class="portrait-desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>

        </div>
    </section>
</div>

<?php
$month = date('n'); // 1 = Jan, 12 = Dec

// Determine season
$season = 'summer';

?>
<?php

$repeater_field = ($season === 'summer') ? 'chambre_image_right_summer' : 'chambre_image_right_winter';
?>


<section class="Chambre h1p">


    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-12 col-md-6 Chambre-left">
                <div class="Chambre-content">
                    <h2><?php the_field('chambre_heading'); ?></h2>
                    <p><?php the_field('chambre_description'); ?></p>
                    <div class="link-row">
                        <a href="<?php the_field('chambre_link_1_url'); ?>" target="_blank" rel="noopener"
                            class="Chambre-link1">
                            <?php the_field('chambre_link_1_text'); ?>
                        </a>
                        <a href="<?php the_field('chambre_link_2_url'); ?>" target="_blank" rel="noopener"
                            class="Chambre-link2">
                            <?php the_field('chambre_link_2_text'); ?>
                        </a>
                    </div>


                    <a href="<?php the_field('chambre_button_url'); ?>" class="Chambre-btn">
                        <?php the_field('chambre_button_text'); ?>
                    </a>
                </div>
            </div>


            <div id="ChambreCarousel" class="carousel slide col-12 col-md-6 Chambre-right" data-bs-ride="carousel"
                data-bs-interval="3000">
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

<?php $season = get_current_season(); ?>

<section class="offers-section-4 ">
    <div class="container">


        <div class="row g-3 ">

            <?php if (have_rows('feature_card')): ?>
                <?php while (have_rows('feature_card')):
                    the_row();
                    $image_summer = get_sub_field('image_summer');
                    $image_winter = get_sub_field('image_winter');
                    $image = ($season === 'summer') ? $image_summer : $image_winter;

                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $button_link = get_sub_field('button_link');
                    ?>


                    <div class="col-12 col-md-6 col-lg-3">
                        <?php if ($button_link): ?>
                            <a href="<?php echo esc_url($button_link); ?>" class="offer-card-link">
                            <?php endif; ?>

                            <div class="offer-card">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">

                                <div class="offer-overlay">
                                    <!-- Static (Always Visible) -->
                                    <div class="static-content">
                                        <h4 class="offer-title"><?php echo esc_html($title); ?></h4>
                                    </div>

                                    <!-- Sliding Content -->
                                    <div class="hover-content">
                                        <h4 class="offer-title"><?php echo esc_html($title); ?></h4>

                                        <?php if ($description): ?>
                                            <p class="offer-desc"><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>

                                        <?php if ($button_link): ?>
                                            <span class="explore-btn">
                                                UTFORSK
                                                <span class="arrow">
                                                    <?php include get_template_directory() . '/assets/images/arrow.svg'; ?>
                                                </span>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ($button_link): ?>
                            </a>
                        <?php endif; ?>


                    </div>
                <?php endwhile; ?>
            <?php endif; ?>


        </div>
    </div>
</section>

</div>
<?php get_footer('theatercaffen'); ?>