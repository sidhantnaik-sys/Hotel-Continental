<?php
/**
 * Template Name: single rest/bar Page
 */
get_header(); ?>
<?php $season = get_current_season(); ?>


<?php get_template_part('template-parts/room-hero-img'); ?>


<div class="room-padding">
<section class="room-detail">
  
    <!-- Title & Hero Section -->
    <?php get_template_part('template-parts/restaurant-detail'); ?>

    <!-- opening hours -->
    <?php get_template_part('template-parts/rest-opening'); ?>

    <!-- Summer -->
     <?php get_template_part('template-parts/rest-summer'); ?>





    <!-- Gallery Section -->
    <?php get_template_part('template-parts/gallery'); ?>

  
</section>
</div>
<?php get_footer(); ?>