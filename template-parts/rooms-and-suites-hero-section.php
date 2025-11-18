<section class="hero-section">
    <?php
    $media_type = get_field('hrs_media_type');
    $bg_image = get_field('hrs_background_image');
    $bg_video = get_field('hrs_background_video');
    $heading = get_field('hrs_heading');
    $subheading = get_field('hrs_subheading');
    ?>

    <div class="hero-media">
        <?php if ($media_type === 'video' && $bg_video): ?>
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url($bg_video['url']); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php elseif ($media_type === 'image' && $bg_image): ?>
            <img class="hero-image" src="<?php echo esc_url($bg_image['url']); ?>" alt="Hero Background" />
        <?php endif; ?>
    </div>

    <div class="hero-overlay">
        <div class="hero-text-container container">
            <div class="hero-text">
                <h2><?php echo esc_html($heading); ?></h2>
                <p><?php echo esc_html($subheading); ?></p>
            </div>
            <div class="spacer-block"></div>

        </div>
    </div>
</section>