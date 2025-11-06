<?php
/**
 * Template Name: beats and crumbs Page
 */
get_header('theatercaffen'); ?>
<?php $season = get_current_season(); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>

<div class="room-padding">
  <?php get_template_part('template-parts/booking'); ?>

</div>  

<?php get_footer('theatercaffen'); ?>