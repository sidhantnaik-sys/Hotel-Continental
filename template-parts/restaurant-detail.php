<?php 
$hero_image = get_field('hero_image'); 
$description = get_field('full_description');
?>

<div class="container room-container room-header pt-5">
    <div class="container room-text py-5 h1p p1">
        <h2><?php the_title(); ?></h2>
        <div class="room-description">
            <?php echo wpautop($description); ?>
        </div>



    </div>
    <div class="room-image">
        <?php if ($hero_image): ?>
            <img class="height600" src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
        <?php endif; ?>
    </div>
</div>