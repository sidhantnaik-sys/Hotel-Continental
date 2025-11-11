<footer class="site-footer-casbar" id="footer-casbar">
  <div class="container pb-3 ">
    <div class="row gy-4 p-2 align-items-start">

      <!-- Left Section -->
      <div class="col-md-4 ">
        <?php
        $contact_img = get_field('footer_casbar_img', 'option');
        if ($contact_img): ?>
          <div class="logo_annen">
            <a href="<?php echo esc_url(home_url()); ?>" class="footer-logo-link d-inline-block mb-3">
              <img class="footer-logo " src="<?php echo esc_url($contact_img['url']); ?>"
                alt="<?php echo esc_attr($contact_img['alt']); ?>">
            </a>
          </div>
        <?php endif; ?>

        <p class="footer-description">
          <?php the_field('footer_contact_text_casbar', 'option'); ?>
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

        <div class=" p1 send-app pt-3">
          <h6 class="footer-label footerlabelcolor">Jobb med oss</h6>

          <?php the_field('footer_career_text', 'option'); ?>


        </div>
      </div>
      <div class="col-md-8">
        <div class="row">
          <!-- Top Row: Address + Opening Hours -->
          <div class="col-md-5">
            <h6 class="footer-label footerlabelcolor">Address</h6>
            <p>
              <a href="https://www.google.com/maps/search/<?php echo urlencode(get_field('footer_address_line', 'option') . ' ' . get_field('footer_city', 'option')); ?>"
                target="_blank">
                <?php the_field('footer_address_line_casbar', 'option'); ?><br>
                <?php the_field('footer_city_casbar', 'option'); ?>
              </a>
            </p>
          </div>

          <div class="col-md-7 ">
            <?php if (have_rows('footer_opening_hours_casbar', 'option')): ?>
              <div class="opening-timings">
                <h6 class="footer-label footerlabelcolor">Our Hours</h6>
                <ul>
                  <?php while (have_rows('footer_opening_hours_casbar', 'option')):
                    the_row(); ?>
                    <li>
                      <span><?php the_sub_field('day', 'option'); ?></span>
                      <span><?php the_sub_field('time', 'option'); ?></span>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </div>
            <?php endif; ?>

          </div>

          <!-- Bottom Row: Contact Details (Full Width) -->
          <div class="col-md-12 mt-3">
            <h6 class="footer-label footerlabelcolor">Contact details</h6>
            <p>
              Telefon: <a class="phone-nu" href="tel:<?php the_field('footer_phone_casbar', 'option'); ?>">
                <?php the_field('footer_phone_casbar', 'option'); ?>
              </a>
              <br>
              <a href="mailto:<?php the_field('footer_email_casbar', 'option'); ?>">
                <?php the_field('footer_email_casbar', 'option'); ?>
              </a>
            </p>
          </div>
        </div>
      </div>




    </div>

    <!-- Bottom Links -->
    <!-- <div class="footer-bottom d-flex flex-column flex-md-row justify-content-start gap-3 mt-4 pt-4 border-top">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & Conditions</a>
    </div> -->
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>