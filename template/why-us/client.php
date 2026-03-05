<section class="wrap_mengapa_kami_client">
  <div class="container">

    <?php
   
    $page = get_page_by_path('mengapa-kami/klien-kami');

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

    <div class="title_subtitle_section">
      <?php if ($title): ?>
        <h2><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($desc): ?>
        <p><?php echo esc_html($desc); ?></p>
      <?php endif; ?>
    </div>

    <!-- SWIPER -->
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
</section>