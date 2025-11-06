<?php
/**
 * Template Name: barboman page
 */
get_header('barboman'); ?>
<?php $season = get_current_season(); ?>
<?php
// Get video & fallback image from ACF
$hero_video = get_field('hero_video');
$hero_fallback = get_field('hero_fallback_image');
$headline = get_field('headline_text');
$button_text = get_field('button_text');
$button_url = get_field('button_url');
$video_url = esc_url(is_array($hero_video) ? $hero_video['url'] : $hero_video);
$fallback_url = esc_url(is_array($hero_fallback) ? $hero_fallback['url'] : $hero_fallback);
?>

<?php if ($video_url || $fallback_url): ?>
    <section class="hero-barboman hero text-white d-flex align-items-center position-relative">
        <?php if ($video_url): ?>
            <video autoplay muted loop playsinline poster="<?php echo $fallback_url; ?>" class="hero-video">
                <source src="<?php echo $video_url; ?>" type="video/mp4">
            </video>
        <?php elseif ($fallback_url): ?>
            <div class="hero-image" style="background-image: url('<?php echo $fallback_url; ?>');"></div>
        <?php endif; ?>

        <div class="overlay-content text-center w-100">
            <?php if ($headline): ?>
                <h1 class="display-4 mb-4"><?php echo esc_html($headline); ?></h1>
            <?php endif; ?>

            <?php if ($button_text): ?>
                <a href="<?php echo esc_url($button_text['url']); ?>" class="btn btn-primary btn-lg">
                    <?php echo esc_html($button_text['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>


<div class="barboman-bg">




    <?php if (have_rows('cocktail_sections')): ?>
        <?php $count = 0; ?>
        <?php while (have_rows('cocktail_sections')):
            the_row();
            $section_id = get_sub_field('section_id');
            $title = get_sub_field('section_title');
            $subtitle = get_sub_field('section_subtitle');
            $price = get_sub_field('section_price');
            $image = get_sub_field('section_image');
            $drinks = get_sub_field('section_drinks');
            $layout_class = ($count % 2 === 0) ? '' : 'flex-row-reverse';
            ?>

            <section id="<?php echo esc_attr($section_id); ?>" class="cocktail-section">
                <div class="container cocktail-block">
                    <div class="row g-5 h1p p1 <?php echo $layout_class; ?>">



                        <!-- Drinks Info -->
                        <div class="col-md-6 cocktail-text">
                            <div class="cocktail-text">
                                <div class="section-heading">
                                    <div class="subtitle d-flex justify-content-between">
                                        <?php if ($subtitle): ?>
                                            <h4><?php echo esc_html($subtitle); ?></h4><?php endif; ?>
                                        <?php if ($price): ?>
                                            <h5><?php echo esc_html($price); ?></h5><?php endif; ?>
                                    </div>
                                </div>

                                <?php if ($drinks): ?>
                                    <div class="cocktail-list">
                                        <ul>
                                            <?php foreach ($drinks as $drink): ?>
                                                <li>
                                                    <h4><?php echo esc_html($drink['drink_name']); ?></h4>
                                                    <p><?php echo esc_html($drink['drink_description']); ?></p>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Image + Title -->
                        <div class="col-md-6 cocktail-image text-center">
                            <?php if ($title): ?>
                                <h2 class="cocktail-title"><?php echo esc_html($title); ?></h2>
                            <?php endif; ?>

                            <?php if ($image): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php $count++; ?>
        <?php endwhile; ?>
    <?php endif; ?>

</div>

<div class="container-portrait-barboman  py-5 h1p">
    <section class="portrait-gallery-barboman ">

        <div class="container-fluid text-center">
            <?php if ($title = get_field('portrait_title1')): ?>
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


            <?php if ($desc = get_field('portrait_desc1')): ?>
                <p class="portrait-desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>

        </div>
    </section>
</div>
<div class="barboman-bg">

    <section class="aboutus-barboman ">
        <div class="container text-center h1p p1 align-items-center">
            <?php if ($title = get_field('portrait_title')): ?>
                <h2 class="portrait-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($desc = get_field('portrait_desc')): ?>
                <p class="portrait-desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>

            <?php
            $btn1 = get_field('button_1'); // ACF Link field
            $btn2 = get_field('button_2'); // ACF Link field
            ?>

            <?php if ($btn1 || $btn2): ?>
                <div class="portrait-buttons">
                    <?php if ($btn1): ?>
                        <a href="<?php echo esc_url($btn1['url']); ?>" class="btn btn-primary" <?php echo $btn1['target'] ? 'target="' . esc_attr($btn1['target']) . '"' : ''; ?>>
                            <?php echo esc_html($btn1['title']); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($btn2): ?>
                        <a href="<?php echo esc_url($btn2['url']); ?>" class="btn btn-secondary" <?php echo $btn2['target'] ? 'target="' . esc_attr($btn2['target']) . '"' : ''; ?>>
                            <?php echo esc_html($btn2['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>



</div>
<?php get_footer('barboman'); ?>