<?php
/*
Template Name: annen menu
*/


get_header('annen_etage');
?>
<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="bg-annen padding120" id="full-menu">
    <section class="luxury-section container-fluid py-5 h1p ">
        <div class="container hovera">
            <div class="row align-items-center">

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

                    <div class="row menu-tables">
                        <!-- Menu Prices -->
                        <div class="col-6">
                            <h5>Menu</h5>
                            <ul>
                                <?php if (have_rows('luxury_menu')): ?>
                                    <?php while (have_rows('luxury_menu')):
                                        the_row(); ?>
                                        <li>
                                            <?php the_sub_field('course_name'); ?>
                                            <span>NOK <?php the_sub_field('price'); ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- Wine Menu Prices -->
                        <div class="col-6">
                            <h5>Wine Menu</h5>
                            <ul>
                                <?php if (have_rows('luxury_wine_menu')): ?>
                                    <?php while (have_rows('luxury_wine_menu')):
                                        the_row(); ?>
                                        <li>
                                            <?php the_sub_field('wine_course_name'); ?>
                                            <span>NOK <?php the_sub_field('wine_price'); ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

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

    <section class="our-menu-section container-fluid py-5" id="barmenu">
        <div class="container" >
            <div class="row align-items-start h1p textcolor">

                <!-- Left Image -->
                <div class="col-lg-6 menu-image">
                    <?php $menu_img = get_field('menu_image'); ?>
                    <?php if ($menu_img): ?>
                        <img src="<?php echo esc_url($menu_img['url']); ?>" alt="<?php echo esc_attr($menu_img['alt']); ?>"
                            class="img-fluid">
                    <?php endif; ?>
                </div>

                <!-- Right Content -->
                <div class="col-lg-6 menu-content ">
                    <!-- Title -->
                    <?php if (get_field('menu_title')): ?>
                        <h2 class="menu-title"><?php the_field('menu_title'); ?></h2>
                    <?php endif; ?>

                    <?php if (have_rows('menu_tabs')): ?>
                        <!-- Tabs Navigation -->
                        <div class="tabs-scroll-wrapper">
                            <ul class="nav nav-tabs" id="menuTabs" role="tablist">
                                <?php $i = 0;
                                while (have_rows('menu_tabs')):
                                    the_row(); ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo $i === 0 ? 'active' : ''; ?>"
                                            id="tab-<?php echo $i; ?>" data-bs-toggle="tab"
                                            data-bs-target="#tab-content-<?php echo $i; ?>" type="button" role="tab">
                                            <?php the_sub_field('tab_title'); ?>
                                        </button>
                                    </li>
                                    <?php $i++; endwhile; ?>
                            </ul>
                            </div>

                            <!-- Tabs Content -->
                            <div class="tab-content mt-3" id="menuTabsContent">
                                <?php $i = 0;
                                reset_rows();
                                while (have_rows('menu_tabs')):
                                    the_row(); ?>
                                    <div class="tab-pane fade <?php echo $i === 0 ? 'show active' : ''; ?>"
                                        id="tab-content-<?php echo $i; ?>" role="tabpanel">
                                        <?php if (have_rows('tab_dishes')): ?>
                                            <ul class="dish-list">
                                                <?php while (have_rows('tab_dishes')):
                                                    the_row(); ?>
                                                    <li class="dish-item d-flex justify-content-between align-items-start">
                                                        <div class="dish-info">
                                                            <strong
                                                                class="list_heading"><?php the_sub_field('dish_title'); ?></strong><br>
                                                            <span class="list_line"><?php the_sub_field('dish_description'); ?></span>
                                                        </div>

                                                        <?php if (get_sub_field('dish_price')): ?>
                                                            <span class="dish-price"><?php the_sub_field('dish_price'); ?></span>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php endif; ?>

                                    </div>
                                    <?php $i++; endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
    </section>


    <section class="bottled-selections h1p pt-5" id="wine-menu">
        <div class="container" >
            <div class="row ">
                <!-- Left Section -->
                <div class="bottle-content col-lg-6 ">
                    <?php if (get_field('section_title')): ?>
                        <h2 class="section-title mb-4"><?php the_field('section_title'); ?></h2>
                    <?php endif; ?>

                    <?php if (have_rows('wine_categories')): ?>
                        <!-- Unique Tabs ID -->
                         <div class="tabs-scroll-wrapper">
                        <ul class="nav nav-tabs" id="bottledWineTabs" role="tablist">
                            <?php
                            $i = 0;
                            while (have_rows('wine_categories')):
                                the_row();
                                $category_title = get_sub_field('category_title');
                                ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo $i === 0 ? 'active' : ''; ?>"
                                        id="bottled-tab-<?php echo $i; ?>" data-bs-toggle="tab"
                                        data-bs-target="#bottled-content-<?php echo $i; ?>" type="button" role="tab"
                                        aria-controls="bottled-content-<?php echo $i; ?>"
                                        aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                                        <?php echo esc_html($category_title); ?>
                                    </button>
                                </li>
                                <?php $i++; endwhile; ?>
                        </ul>
                        </div>

                        <!-- Tab Contents -->
                        <div class="tab-content mt-3" id="bottledWineTabsContent">
                            <?php
                            $i = 0;
                            while (have_rows('wine_categories')):
                                the_row();
                                ?>
                                <div class="tab-pane fade <?php echo $i === 0 ? 'show active' : ''; ?>"
                                    id="bottled-content-<?php echo $i; ?>" role="tabpanel"
                                    aria-labelledby="bottled-tab-<?php echo $i; ?>">

                                    <?php if (have_rows('wines')): ?>
                                        <ul class="wine-list">
                                            <?php while (have_rows('wines')):
                                                the_row(); ?>
                                                <li>

                                                    <span class="wine-name"><?php the_sub_field('wine_name'); ?></span>
                                                    <?php
                                                    $wine_price = get_sub_field('wine_price');
                                                    if ($wine_price): ?>
                                                        <span class="wine-price">NOK <?php echo esc_html($wine_price); ?>,-</span>
                                                    <?php endif; ?>

                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>

                                </div>
                                <?php $i++; endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Image -->
                <div class="col-lg-6 text-center">
                    <?php
                    $image = get_field('side_image');
                    if ($image): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                            class="img-fluid">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer('annen_etage'); ?>