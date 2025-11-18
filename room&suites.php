<?php
/**
 * Template Name: Room&Suites Page
 */
get_header(); ?>
<?php $season = get_current_season(); ?>

<?php get_template_part('template-parts/rooms-and-suites-hero-section'); ?>

<?php get_template_part('template-parts/rooms-and-suites-intro-and-slider'); ?>





<div class="room-padding">


    <?php get_template_part('template-parts/room-cards2'); ?>

</div>

<div class="room-padding-two">
    <?php get_template_part('template-parts/room-book-section2'); ?>

</div>
<?php get_footer(); ?>