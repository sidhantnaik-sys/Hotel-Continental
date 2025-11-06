<?php
/*
Template Name: about us annen
*/


get_header('annen_etage');
?>
<?php get_template_part('template-parts/room-hero-img'); ?>

<section class="join-our-team container-fluid paddng120">
    <div class="container">
        <div class="row  h1p">
            <!-- Left Side: Content -->
            <div class="col-lg-6 join-team-content p1">
                <?php if (get_field('join_team_title')): ?>
                    <h2 class="section-title"><?php the_field('join_team_title'); ?></h2>
                <?php endif; ?>

                <?php if (get_field('join_team_desc')): ?>
                    <p class="description"><?php the_field('join_team_desc'); ?></p>
                <?php endif; ?>

                <?php if (have_rows('join_team_positions')): ?>
                    <div class="positions">
                        <h4>Nåværende åpne stillinger</h4>
                        <ul>
                            <?php while (have_rows('join_team_positions')):
                                the_row(); ?>
                                <li>
                                    <?php the_sub_field('position_title'); ?>:
                                    <a href="mailto:<?php the_sub_field('position_email'); ?>">
                                        <?php the_sub_field('position_email'); ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Side: Image -->
            <div class="col-lg-6 join-team-image">
                <?php $image = get_field('join_team_image'); ?>
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>



<?php get_footer('annen_etage'); ?>