<?php
/**
 * Template Name: meeting room details page
 */
get_header('hc_events'); ?>

<?php get_template_part('template-parts/room-hero-img'); ?>
<div class="room-padding">
    <div class="meeting-room-container container py-5 h1p a1 p1">

        <!-- Floor Plans -->
        <?php if (have_rows('floor_plans')): ?>
            <section class="floor-plans mb-5">
                <h2 class="section-title mb-4">Plantegning</h2>

                <?php while (have_rows('floor_plans')):
                    the_row();
                    $floor_name = get_sub_field('floor_name');
                    $floor_pdf = get_sub_field('floor_pdf');
                    $floor_image = get_sub_field('floor_image');
                    ?>
                    <div class="floor-plan mb-4">

                        <?php if ($floor_name): ?>
                            <?php if ($floor_pdf): ?>
                                <a href="<?php echo esc_url($floor_pdf['url']); ?>" target="_blank"
                                    class="floor-link text-decoration-none">
                                    <h4 class="floor-title mb-2"><?php echo esc_html($floor_name); ?></h4>
                                </a>
                            <?php else: ?>
                                <h4 class="floor-title mb-2"><?php echo esc_html($floor_name); ?></h4>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($floor_image): ?>
                            <?php if ($floor_pdf): ?>
                                <a href="<?php echo esc_url($floor_pdf['url']); ?>" target="_blank">
                                    <img src="<?php echo esc_url($floor_image['url']); ?>"
                                        alt="<?php echo esc_attr($floor_image['alt']); ?>" class="img-fluid border rounded">
                                </a>
                            <?php else: ?>
                                <img src="<?php echo esc_url($floor_image['url']); ?>"
                                    alt="<?php echo esc_attr($floor_image['alt']); ?>" class="img-fluid border rounded">
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                <?php endwhile; ?>
            </section>
        <?php endif; ?>



        <!-- Capacity Table -->
        <?php if (have_rows('capacity_table')): ?>
            <section class="capacity-table">
                <h2 class="section-title mb-4">Kapasitet</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Lokale</th>
                                <th>Kino</th>
                                <th>Klasserom</th>
                                <th>U-bord</th>
                                <th>Langbord</th>
                                <th>Ovale bord</th>
                                <th>Mottakelse</th>
                                <th>Belysning</th>
                                <th>m2</th>
                                <th>Gulv</th>
                                <th>Takhøyde</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while (have_rows('capacity_table')):
                                the_row(); ?>
                                <tr>
                                    <td><?php the_sub_field('venue'); ?></td>
                                    <td><?php the_sub_field('theatre'); ?></td>
                                    <td><?php the_sub_field('classroom'); ?></td>
                                    <td><?php the_sub_field('u-shape'); ?></td>
                                    <td><?php the_sub_field('classroom'); ?></td>
                                    <td><?php the_sub_field('ovale'); ?></td>
                                    <td><?php the_sub_field('reception'); ?></td>
                                    <td><?php the_sub_field('lighting'); ?></td>
                                    <td><?php the_sub_field('sqm'); ?></td>
                                    <td><?php the_sub_field('floor'); ?></td>
                                    <td><?php the_sub_field('height'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    
                        
                    </table>
                    <p>
                       Belysning A = Dagslys<br>
                       Belysning B = Dempemuligheter 
                    </p>
                </div>
            </section>
        <?php endif; ?>

    </div>

</div>

<?php get_footer('hc_events'); ?>