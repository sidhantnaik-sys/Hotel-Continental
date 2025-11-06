<?php
/**
 * Global 404 page for all subsites (Multisite)
 */

$site_id = get_current_blog_id();

// Load correct header based on site
if ($site_id == 1) {
  get_header();
} elseif ($site_id == 5) {
  get_header('theatercaffen');
} elseif ($site_id == 6) {
  get_header('hc_events');
} elseif ($site_id == 8) {
  get_header('annen_etage');
} elseif ($site_id == 9) {
  get_header('continental-suiten');
} elseif ($site_id == 10) {
  get_header('casbar');
} elseif ($site_id == 12) {
  get_header('barboman');
} else {
  get_header();
}
?>

<main id="main" class="site-main not-found-page">
  <section class="error-404 not-found container">



    <div class="container">
      <h1 class="error-title">404</h1>
      <h2 class="error-subtitle">Oops! Page not found</h2>
      <p class="error-description">
        The page you’re looking for doesn’t exist or has been moved.
      </p>

      <a href="<?php echo home_url(); ?>" class="btn">
        Go Back Home
      </a>

      <p class="redirect-text mt-3">Redirecting to home in <span id="countdown">5</span> seconds...</p>
    </div>
  </section>




  </section>
  <script>
    // Simple redirect after countdown
    let seconds = 5;
    const countdownEl = document.getElementById('countdown');
    const interval = setInterval(() => {
      seconds--;
      countdownEl.textContent = seconds;
      if (seconds <= 0) {
        clearInterval(interval);
        window.location.href = "<?php echo home_url(); ?>";
      }
    }, 1000);
  </script>
</main>

<?php
// Load correct footer based on site
if ($site_id == 1) {
  get_footer(); // footer-hotel.php
} elseif ($site_id == 5) {
  get_footer('theatercaffen');
} elseif ($site_id == 6) {
  get_footer('hc_events');
} elseif ($site_id == 8) {
  get_footer('annen_etage');
} elseif ($site_id == 9) {
  get_footer('continental-suiten');
} elseif ($site_id == 10) {
  get_footer('casbar');
} elseif ($site_id == 12) {
  get_footer('barboman');
} else {
  get_footer();
}
?>