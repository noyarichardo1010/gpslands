<section class="trusted-section" data-aos="fade-up">
  <div class="container">
    <div class="trusted-container">

      <?php
      $page = get_page_by_path('homepage2/clients_homepage');


      $title = '';
      $desc  = '';

      if ($page) {
        $blocks = parse_blocks($page->post_content);

        foreach ($blocks as $block) {
          if ($block['blockName'] === 'core/heading' && empty($title)) {
            $title = wp_strip_all_tags(render_block($block));
          }

          if ($block['blockName'] === 'core/paragraph' && empty($desc)) {
            $desc = wp_strip_all_tags(render_block($block));
          }
        }
      }
      ?>

      <?php if ($title): ?>
        <h2 class="trusted-title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($desc): ?>
        <p class="trusted-desc"><?php echo esc_html($desc); ?></p>
      <?php endif; ?>

      <div class="swiper trusted-swiper">
        <div class="swiper-wrapper">

          <?php
          if ($page) {
            $shortcode = get_field('shortcode_gallery', $page->ID);

            if ($shortcode) {
              echo do_shortcode($shortcode);
            }
          }
          ?>

        </div>

        <div class="swiper-pagination"></div>
      </div>

    </div>
  </div>
</section>
