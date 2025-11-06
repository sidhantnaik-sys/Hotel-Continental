<?php
/*
Template Name: hc menu
*/


get_header('theatercaffen');
?>
<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="bg-annen padding120">
    <section class="luxury-section container-fluid py-5 h1p ">
        <div class="container">
            <div class="row align-items-start">

                <!-- Left Content -->
                <div class="col-lg-6 luxury-content">
                    <!-- Title -->
                    <?php if (get_field('luxury_title')): ?>
                        <h2 class="luxury-title"><?php the_field('luxury_title'); ?></h2>
                    <?php endif; ?>

                    <!-- Description -->
                    <?php if (get_field('luxury_description')): ?>
                        <p class="luxury-description"><?php the_field('luxury_description'); ?></p>
                    <?php endif; ?>

                   

                    <!-- Button -->
                    <?php if (get_field('luxury_button_link')): ?>
                        <a href="<?php the_field('luxury_button_link'); ?>" class="luxury-btn">
                            <?php the_field('luxury_button_text'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Right Image -->
                <div class="col-lg-6 luxury-image">
                    <?php $image = get_field('luxury_image'); ?>
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                            class="img-fluid" />
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <section class="menu-section ">
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



</div>

<?php get_footer('theatercaffen'); ?>