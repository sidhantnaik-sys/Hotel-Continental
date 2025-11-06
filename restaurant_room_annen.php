<?php
/*
Template Name: annen restaurant room
*/


get_header('annen_etage');
?>
<?php get_template_part('template-parts/room-hero-img'); ?>

<?php
// Fields
$hero_image = get_field('image_green');
$description = get_field('full_description');
$title = get_field('book_title');
?>
<section class="room-detail bgcolor paddngrest">
    <div class="container">
        <!-- Title & Hero Section -->
        <div class="container room-header h1p">
            <div class="container room-text py-5">
                <h1><?php echo esc_html($title);
                ?></h1>
                <div class="book-description py-3">
                    <?php echo wpautop(($description)); ?>
                </div>


            </div>
            <div class="room-image">
                <?php if ($hero_image): ?>
                    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer('annen_etage'); ?>