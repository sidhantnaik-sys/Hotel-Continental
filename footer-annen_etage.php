<footer class="site-footer-annen">
  <div class="container pb-3 ">
    <div class="row gy-4 p-2 align-items-start">

      <!-- Left Section -->
      <div class="col-md-6 ">
        <?php
        $contact_img = get_field('footer_annen_img', 'option');
        if ($contact_img): ?>
          <div class="logo_annen">
            <a href="<?php echo esc_url(home_url()); ?>" class="footer-logo-link d-inline-block mb-3">
              <img class="footer-logo " src="<?php echo esc_url($contact_img['url']); ?>"
                alt="<?php echo esc_attr($contact_img['alt']); ?>">
            </a>
          </div>
        <?php endif; ?>

        <p class="footer-description">
          <?php the_field('footer_contact_text_annen', 'option'); ?>
        </p>

        <!-- Social Icons -->
        <div class="social-icons d-flex gap-2 mt-3">
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
      <div class="col-md-6">
        <div class="row">
          <!-- Top Row: Address + Opening Hours -->
          <div class="col-md-6">
            <h6 class="footer-label footerlabelcolor">Address</h6>
            <p>

              <a href="https://www.google.com/maps/search/<?php echo urlencode(get_field('footer_address_line', 'option') . ' ' . get_field('footer_city', 'option')); ?>"
                target="_blank">
                <?php the_field('footer_address_line_annen', 'option'); ?><br>
                <?php the_field('footer_city_annen', 'option'); ?>
              </a>
            </p>

          </div>

          <div class="col-md-6 ">
            <h6 class="footer-label footerlabelcolor">Åpningstider</h6>

            <?php the_field('footer_opening_hours_annen', 'option'); ?>

          </div>

          <!-- Bottom Row: Contact Details (Full Width) -->
          <div class="col-md-12 mt-3">
            <h6 class="footer-label footerlabelcolor">Kontaktinformasjon</h6>
            <p>
              Telefon: <a class="phone-nu" href="tel:<?php the_field('footer_phone_annen', 'option'); ?>">
                <?php the_field('footer_phone_annen', 'option'); ?>
              </a>
              <br>
              <a href="mailto:<?php the_field('footer_email_annen', 'option'); ?>">
                <?php the_field('footer_email_annen', 'option'); ?>
              </a>
            </p>
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom Links -->
    <div class="footer-bottom d-flex flex-column flex-md-row justify-content-start gap-3 mt-4 pt-4 border-top">
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