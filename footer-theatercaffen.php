<footer class="site-footer-theater">
  <div class="container pt-5 pb-3">
    <div class="row gy-4 px-2 p1">

      <!-- Column 1: Kontakt -->
      <div class="col-md-3">
        <?php

        $contact_img = get_field('footer_contact_title_img', 'option');
        if ($contact_img): ?>
          <a href="<?php echo esc_url(home_url()); ?>" class="footer-logo-link d-inline-block">
            <img class="footer-logo" src="<?php echo esc_url($contact_img['url']); ?>"
              alt="<?php echo esc_attr($contact_img['alt']); ?>">
          </a>
        <?php endif; ?>

        <p class="font-w1"><?php the_field('footer_contact_text', 'option'); ?></p>
        <div class="social-icons d-flex gap-2">
          <?php if (have_rows('footer_social_media', 'option')): ?>
            <?php while (have_rows('footer_social_media', 'option')):
              the_row();
              $link = get_sub_field('social_link');
              $icon = get_sub_field('social_icon');
              ?>
              <?php if ($link && $icon): ?>
                <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener">
                  <img src="<?php echo esc_url($icon['url']); ?>" alt="Social Icon" style="width:24px; height:24px;">
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>

      </div>

      <div class="col-md-9">
        <div class="row">

          <div class="col-md-5  Address">
            <h6 class="footer-label">Åpningstider</h6>

            <?php the_field('footer_opening_hours_annen', 'option'); ?>

          </div>

          <!-- Column 2: Adresse -->
          <div class="col-md-3 p-0">
            <h6 class="footer-label">Adresse</h6>
            <p class="font-w1">
              <a href="https://www.google.com/maps/search/<?php echo urlencode(get_field('footer_address_line', 'option') . ' ' . get_field('footer_city', 'option')); ?>"
                target="_blank">
                <?php the_field('footer_address_line', 'option'); ?><br>
                <?php the_field('footer_city', 'option'); ?>
              </a>
            </p>

          </div>

          <!-- Column 3: Generelle henvendelser -->
          <div class="col-md-4 p-0">
            <h6 class="footer-label">Generelle henvendelser</h6>
            <p class="font-w1">
              Telefon:
              <a class="phone-nu"
                href="tel:<?php echo preg_replace('/\D+/', '', get_field('footer_phone', 'option')); ?>">
                <?php the_field('footer_phone', 'option'); ?>
              </a>

              <br>
              <a
                href="mailto:<?php the_field('footer_email', 'option'); ?>"><?php the_field('footer_email', 'option'); ?></a>
            </p>

            <!-- Column 4: Jobb med oss -->
            <div class="">
              <h6 class="footer-label">Jobb med oss</h6>

              <?php the_field('footer_career_text', 'option'); ?>

            </div>
          </div>





        </div>

      </div>
    </div>

    <!-- Partner logos -->
    <div class="row mt-2 partner-logos-theater">
      <?php if (have_rows('partner_logos_theater', 'option')): ?>
        <?php while (have_rows('partner_logos_theater', 'option')):
          the_row();
          $logo = get_sub_field('logo_image');
          $link = get_sub_field('logo_link');
          ?>
          <?php if ($logo): ?>
            <div class="col-auto">
              <?php if ($link): ?>
                <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener">
                  <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                </a>
              <?php else: ?>
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
              <?php endif; ?>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>


    <!-- Bottom Links -->
    <div class="footer-bottom d-flex flex-column flex-md-row justify-content-start gap-3 mt-3 pt-2 border-top ">
      <?php if (have_rows('footer_links', 'option')): ?>
        <?php while (have_rows('footer_links', 'option')):
          the_row();
          $link = get_sub_field('link');
          ?>
          <?php if ($link): ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
              <?php echo esc_html($link['title']); ?>
            </a>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

  </div>
</footer>


<div id="pdfModal" class="pdf-modal">
  <div class="pdf-modal-content">
    <span class="pdf-close">&times;</span>
    <iframe src="" frameborder="0" style="width:100%; height:80vh;"></iframe>
  </div>
</div>



<?php wp_footer(); ?>
</body>

</html>