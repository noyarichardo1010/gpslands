<section class="wrap_slide_products fadeinx" data-aos="fade-up">
  <div class="container">

    <?php

    $page = get_page_by_path('homepage2/product_slide_home');

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

    <div class="section-head">
      <?php if ($title): ?>
        <h2><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($desc): ?>
        <p><?php echo esc_html($desc); ?></p>
      <?php endif; ?>
    </div>

    <div class="swiper product-swiper">
      <div class="swiper-wrapper">

        <?php

       
        if ($page) {
          $shortcode = get_field('shortcode_gallery', $page->ID);
        
          if ($shortcode) {
     
            $html = do_shortcode($shortcode);
        
            /**
             * Transform:
             * <div class="swiper-slide">
             *   <a> / <img>
             * </div>
             * to
             * <div class="swiper-slide">
             *   <div class="product-card">
             *     <a> / <img>
             *   </div>
             * </div>
             */
            $html = preg_replace(
              '/<div class="swiper-slide">(.*?)<\/div>/s',
              '<div class="swiper-slide"><div class="product-card">$1</div></div>',
              $html
            );
        
            echo $html;
          }
        }

        ?>

      </div>

      <div class="swiper-pagination"></div>
    </div>

  </div>
</section>
