<?php
// Fields
$hero_image = get_field('image_room'); // or a dedicated field like 'room_hero_image'
$book_url = get_field('book_now_button');
$description = get_field('full_description');
$package_btn = get_field('package_btn');
$title = get_field('room_title');
?>
<section class="room-detail content" id="room-detail2">
    <div class="container room-container">
        <!-- Title & Hero Section -->
        <div class="container room-header">
            <div class="container room-text py-5">
                <h2><?php echo esc_html($title);
                ?></h2>
                <div class="room-description pb-3">
                    <p><?php echo ($description); ?></p>
                </div>

                <?php if ($book_url): ?>
                    <a href="<?php echo esc_url($book_url); ?>" class="btn btn-book width"><?php echo($package_btn); ?></a>
                <?php endif; ?>
            </div>
            <div class="room-image ">
                <?php if ($hero_image): ?>
                    <img class="height640" src="<?php echo esc_url($hero_image['url']); ?>"
                        alt="<?php echo esc_attr($hero_image['alt']); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>