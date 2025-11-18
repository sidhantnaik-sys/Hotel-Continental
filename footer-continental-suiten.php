<footer class="site-footer">
  <?php
  $enable = get_field('enable_sticky_button', 'option');
  $link = get_field('sticky_button_link', 'option');

  if ($enable && $link): ?>
    <a class="btn-dark1 sticky-btn" href="<?php echo esc_url($link['url']); ?>"
      target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
      <?php echo esc_html($link['title']); ?>
    </a>
  <?php endif; ?>

  <div class="container footer-container  h1p pding-btm-footer">
    <div class="row gy-4 h1p p1">

      <!-- Column 1: Kontakt -->
      <div class="col-md-3 h1p p1">
        <h2 class="footer-title">Kontakt Oss</h2>
        <p><?php the_field('footer_contact_text', 'option'); ?></p>
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

      <div class="col-md-3  hid" style="visibility:hidden">
        <h6 class="footer-label">Jobb med oss</h6>
        <p><a href="<?php the_field('footer_career_link', 'option'); ?>">Send us an open application via our application
            portal</a></p>
      </div>

      <!-- Column 2: Adresse -->
      <div class="col-md-3 Address">
        <h6 class="footer-label">Adresse</h6>
        <?php
        $address_line = get_field('footer_address_line', 'option');
        $city = get_field('footer_city', 'option');
        $full_address = $address_line . ', ' . $city;
        ?>

        <p>
          <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($full_address); ?>"
            target="_blank" rel="noopener noreferrer">
            <?php echo esc_html($address_line); ?><br>
            <?php echo esc_html($city); ?>
          </a>
        </p>

      </div>

      <!-- Column 3: Generelle henvendelser -->
      <div class="col-md-3">
        <h6 class="footer-label">Generelle henvendelser</h6>
        <p>
          Telefon:
          <a class="phone-nu" href="tel:<?php echo preg_replace('/\D+/', '', get_field('footer_phone', 'option')); ?>">
            <?php the_field('footer_phone', 'option'); ?>
          </a><br>
          <a
            href="mailto:<?php the_field('footer_email', 'option'); ?>"><?php the_field('footer_email', 'option'); ?></a>
        </p>
      </div>

      <!-- Column 4: Jobb med oss -->

    </div>

    <!-- Partner logos -->
    <div class="row mt-2 partner-logos">
      <?php if (have_rows('partner_logos', 'option')): ?>
        <?php while (have_rows('partner_logos', 'option')):
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
    <div class="footer-bottom d-flex flex-column flex-md-row justify-content-start gap-3 mt-3 pt-2 border-top">
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