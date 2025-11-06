<?php
/**
 * Template Name: Room&Suites Page
 */
get_header(); ?>
<?php $season = get_current_season(); ?>



<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">

<?php get_template_part('template-parts/room-book-section'); ?>

<?php get_template_part('template-parts/room-cards');?>

</div>
<?php get_footer();?>