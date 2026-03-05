<?php
$args = [
  'post_type'      => 'footer-settings',
  'posts_per_page' => 1,
  'post_status'    => 'publish'
];

$footer_query = new WP_Query($args);

if ($footer_query->have_posts()) :
  $footer_query->the_post();

  $logo_footer       = get_field('logo_footer');
  $footer_editor     = get_field('footer_editor');
  $footer_copyright  = get_field('footer_copyrights');

  $instagram = get_field('footer_instagram');
  $facebook  = get_field('footer_facebook');
  $linkedin  = get_field('footer_linkedin');
  $youtube   = get_field('footer_youtube');
  $tiktok    = get_field('footer_tiktok');
?>

<footer class="site-footer">
  <div class="footer-container">

    <div class="footer-col footer-about">
    <?php if ($logo_footer) : ?>
      <img src="<?php echo esc_url($logo_footer['url']); ?>" 
          alt="<?php echo esc_attr($logo_footer['alt']); ?>" 
          class="footer-logo">
    <?php endif; ?>


    <?php if ($footer_editor) : ?>
      <div class="footer-editor">
        <?php echo wp_kses_post($footer_editor); ?>
      </div>
    <?php endif; ?>

    </div>

    <div class="footer-col footer-menu">
      <h4 class="footer-title">PRODUK</h4>
      <?php
        wp_nav_menu([
          'theme_location' => 'footer_menu_products',
          'container'      => false,
          'menu_class'     => 'footer-links',
          'depth'          => 1,
          'fallback_cb'    => false,
        ]);
      ?>
    </div>

    <div class="footer-col footer-menu">
      <h4 class="footer-title">SOLUSI DAN LAYANAN</h4>
      <?php
        wp_nav_menu([
          'theme_location' => 'footer_menu_solutions',
          'container'      => false,
          'menu_class'     => 'footer-links',
          'depth'          => 1,
          'fallback_cb'    => false,
        ]);
      ?>
    </div>

    <div class="footer-col footer-menu">
      <h4 class="footer-title">PERUSAHAAN</h4>
      <?php
        wp_nav_menu([
          'theme_location' => 'footer_menu_company',
          'container'      => false,
          'menu_class'     => 'footer-links',
          'depth'          => 1,
          'fallback_cb'    => false,
        ]);
      ?>
    </div>

  </div>

  <div class="footer-bottom">
    <p class="mb-0">
      <?php echo esc_html($footer_copyright); ?>
    </p>

    <div class="footer-social">
      <?php if ($instagram) : ?>
        <a target="_blank" href="<?php echo esc_url($instagram); ?>">
          <i class="fab fa-instagram"></i>
        </a>
      <?php endif; ?>

      <?php if ($facebook) : ?>
        <a target="_blank" href="<?php echo esc_url($facebook); ?>">
          <i class="fab fa-facebook"></i>
        </a>
      <?php endif; ?>

      <?php if ($linkedin) : ?>
        <a target="_blank" href="<?php echo esc_url($linkedin); ?>">
          <i class="fab fa-linkedin"></i>
        </a>
      <?php endif; ?>

      <?php if ($youtube) : ?>
        <a target="_blank" href="<?php echo esc_url($youtube); ?>">
          <i class="fab fa-youtube"></i>
        </a>
      <?php endif; ?>

      <?php if ($tiktok) : ?>
        <a target="_blank" href="<?php echo esc_url($tiktok); ?>">
          <i class="fab fa-tiktok"></i>
        </a>
      <?php endif; ?>

    </div>

  </div>
</footer>

<a href="https://wa.me/+6281388835585" 
   class="floating-wa" 
   target="_blank" 
   rel="noopener"
   aria-label="Chat WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<?php
  wp_reset_postdata();
endif;
?>

<?php wp_footer(); ?>
</body>
</html>