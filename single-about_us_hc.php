<?php
/**
 * Template Name: single about us hc page
 */
get_header('hc_events'); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<?php $season = get_current_season(); ?>
<section class=" room-padding">
    <?php
    // Fields
    $hero_image = get_field('image_room1');
    $book_url = get_field('book_now_button1');
    $description = get_field('full_description1');
    $title = get_field('room_title1');

    // Only show if at least one field has content
    if ($hero_image || $title || $description):
        ?>
        <section class="room-detail">
            <div class="container">
                <!-- Title & Hero Section -->
                <div class="container room-header">
                    <div class="container room-text py-5">
                        <?php if ($title): ?>
                            <h1><?php echo esc_html($title); ?></h1>
                        <?php endif; ?>

                        <?php if ($description): ?>
                            <div class="room-description">
                                <?php echo wpautop(($description)); ?>

                                <?php if (have_rows('contact_details1')): ?>
                                    <div class="contact-details darkbrown--color">
                                        <?php while (have_rows('contact_details1')):
                                            the_row(); ?>
                                            <?php $contact_title = get_sub_field('contact_title'); ?>
                                            <?php if ($contact_title): ?>
                                                <p class="contact-title"><?php echo ($contact_title); ?></p>
                                            <?php endif; ?>

                                            <?php if (have_rows('details')): ?>
                                                <?php while (have_rows('details')):
                                                    the_row(); ?>
                                                    <?php $info_line = get_sub_field('value'); ?>
                                                    <?php if ($info_line): ?>
                                                        <p class="contact-info"><?php echo ($info_line); ?></p>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($hero_image): ?>
                        <div class="contact-image">
                            <img src="<?php echo esc_url($hero_image['url']); ?>"
                                alt="<?php echo esc_attr($hero_image['alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $key_title = get_field('key_title');
    $key_para = get_field('key_para');
    $key_position = get_field('position');
    if ($key_title || $key_para || $key_position):
        ?>
        <section class="members">
            <div class="container key-members h1p truffle-h1 p1 py-0">
                <h2> <?php echo ($key_title); ?></h2>
                <?php if ($key_para): ?>
                    <p><?php echo ($key_para); ?></p>
                <?php endif; ?>

            </div>

            <?php if (have_rows('staff_members')): ?>
                <div class="staff-members-grid container py-5">
                    <?php while (have_rows('staff_members')):
                        the_row();
                        $photo = get_sub_field('image');
                        $name = get_sub_field('name');
                        $designation = get_sub_field('position');
                        $contact_label = get_sub_field('contact_label');
                        $phone = get_sub_field('phone');
                        $email = get_sub_field('email');
                        ?>
                        <div class="staff-card">
                            <?php if ($photo): ?>
                                <div class="staff-image">
                                    <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="staff-info">
                                <div class="static-content">
                                    <h5 class="staff-name"><?php echo esc_html($name); ?></h5>
                                    <p class="staff-role"><?php echo esc_html($designation); ?></p>
                                </div>

                                <div class="hover-content ">
                                    <p class="contact-label"><?php echo esc_html($contact_label); ?></p>
                                    <div class="contacts">
                                        <?php if ($phone): ?>
                                            <?php echo ($phone); ?>
                                        <?php endif; ?>
                                        <?php if ($email): ?>
                                            <?php echo ($email); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>



        </section>
    <?php endif; ?>
</section>


<section class="room-sections padding120">
    <?php
    // Check if room_sections exist and contain meaningful content
    if (have_rows('room_sections')):
        $has_content = false;

        // First pass — check for content
        while (have_rows('room_sections')):
            the_row();
            $title = get_sub_field('section_title');
            $description = get_sub_field('section_description');
            $image = get_sub_field('section_image');

            if (!empty($title) || !empty($description) || !empty($image)) {
                $has_content = true;
            }
        endwhile;

        reset_rows(); // Reset repeater pointer
    
        if ($has_content):
            ?>
            <div class="room-sections-wrapper container content h1p a1">
                <?php
                $count = 0;
                while (have_rows('room_sections')):
                    the_row();
                    $title = get_sub_field('section_title');
                    $description = get_sub_field('section_description');
                    $image = get_sub_field('section_image');

                    $layout_class = ($count % 2 === 0) ? 'image-right' : 'image-left';

                    if (!empty($title) || !empty($description) || !empty($image)):
                        ?>
                        <div class="room-section <?php echo esc_attr($layout_class); ?>">

                            <?php if (!empty($image)): ?>
                                <div class="room-image">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title ?: 'Room Image'); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="room-content px-3 p1">
                                <?php if ($title): ?>
                                    <h2><?php echo esc_html($title); ?></h2>
                                <?php endif; ?>

                                <?php if ($description): ?>
                                    <p><?php echo ($description); ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                        <?php
                    endif; // inner check
                    $count++;
                endwhile;
                ?>
            </div>
            <?php
        endif; // $has_content check
    endif; // have_rows check
    ?>





    <div class="room-padding">
        <?php
        $title = get_field('gallery_title');
        $description = get_field('gallery_description');
        $button_text = get_field('gallery_button_text');
        $button_link = get_field('gallery_button_link');
        $images = get_field('gallery_images');

        if ($title || $description || $button_text || $button_link || $images):
            ?>

            <section class="image-gallery-section h1p truffle-h1 p1 ">
                <div class="container text-center gallery-text pb-5">
                    <?php if ($title): ?>
                        <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <div class="description">
                            <p><?php echo wp_kses_post($description); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($button_text): ?>
                        <a href="<?php echo site_url('?download_gallery_section=1'); ?>" class="download-btn" id="hc-gallery">
                            <?php echo esc_html($button_text); ?>
                        </a>

                    <?php endif; ?>

                </div>

                <?php
                $images = get_field('gallery_images');
                if ($images):
                    $chunks = array_chunk($images, 3);
                    $flip = true;
                    ?>
                    <div class="patterned-gallery container">
                        <?php foreach ($chunks as $set):
                            $small1 = $set[0] ?? null;
                            $small2 = $set[1] ?? null;
                            $big = $set[2] ?? null;
                            ?>
                            <div class="gallery-block <?php echo $flip ? 'flipped' : ''; ?>">
                                <div class="small-column">
                                    <?php if ($small1): ?>
                                        <div class="image-wrap">
                                            <a href="<?php echo esc_url($small1['url']); ?>" class="lightbox-link">
                                                <img src="<?php echo esc_url($small1['url']); ?>" alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($small2): ?>
                                        <div class="image-wrap">
                                            <a href="<?php echo esc_url($small2['url']); ?>" class="lightbox-link">
                                                <img src="<?php echo esc_url($small2['url']); ?>" alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="big-column">
                                    <?php if ($big): ?>
                                        <a href="<?php echo esc_url($big['url']); ?>" class="lightbox-link">
                                            <img src="<?php echo esc_url($big['url']); ?>" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $flip = !$flip; endforeach; ?>
                    </div>
                <?php endif; ?>

            </section>
        <?php endif; ?>
    </div>


</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>


<?php get_footer('hc_events'); ?>