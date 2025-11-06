<?php
/*
Template Name: Privacy Policy annen
*/
get_header('annen_etage');
?>

<?php $season = get_current_season(); ?>
<?php


$headline = get_field('headline_text');
?>

<section class="container-fluid content  d-flex align-items-center position-relative"
    style="height: 80vh; max-height:400px; background-color:#F3EBE0;">
    <div class="overlay-content text-center w-100">
      
        <h1 class="display-4 mb-4">Privacy Policy</h1>
      
    </div>
</section>



<section class="privacy-policy-page py-5 p1">
  <div class="privacy container content p-5">
    <?php if (have_rows('sections')): ?>
  <?php while (have_rows('sections')): the_row(); ?>
    <div class="policy-section py-3">
      <h3><?php the_sub_field('heading'); ?></h3>
      
      <?php if (get_sub_field('content')): ?>
        <div class="section-content">
        <p> <?php the_sub_field('content'); ?></p> 
        </div>
      <?php endif; ?>

      <?php if (have_rows('section_list_items')): ?>
        <ul class="section-list mx-3">
          <?php while (have_rows('section_list_items')): the_row(); ?>
            <li><?php the_sub_field('list_item'); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

  </div>
</section>

<?php get_footer('annen_etage'); ?>
