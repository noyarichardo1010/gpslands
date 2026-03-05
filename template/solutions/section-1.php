<div id="pertambangan" class="wrap_solusi" data-aos="fade-up">
  <section class="wrap_solusi daftar-solusi pertambangan-section">
    <div class="container">
      <div class="row">

        <?php
        // Ambil page
        $page = get_page_by_path('daftar-solusi/pertambangan');

        $title = '';
        $desc  = '';

        if ($page) {
          $blocks = parse_blocks($page->post_content);

          foreach ($blocks as $block) {
            if ($block['blockName'] === 'core/heading' && empty($title)) {
              $title = wp_strip_all_tags(render_block($block));
            }

            if ($block['blockName'] === 'core/paragraph') {
              $desc .= render_block($block);
            }          
            
          }
        }
        ?>

        <!-- LEFT SLIDER -->
        <div class="col-12 col-lg-5">

          <div class="swiper pertambangan-swiper">
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

        <?php
        // echo '<pre>';
        // print_r($blocks);
        // echo '</pre>';
        
        ?>
        <!-- RIGHT CONTENT -->
        <div class="col-12 col-lg-7 space_d_solusi right_side">
          <?php if ($title): ?>
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <?php if ($desc): ?>
          <div class="section-desc">
            <?php echo $desc; ?>
          </div>
        <?php endif; ?>

        </div>

      </div>
    </div>
  </section>


  <section class="product-list-section">
    <div class="brand-section container">

      <div class="brand-header">
        <h2 class="section-title">Produk Pertambangan</h2>

        <?php
        $term = get_term_by('slug', 'pertambangan', 'industry');
        ?>

        <?php if ($term): ?>
          <a class="brand-link" href="<?php echo esc_url(get_term_link($term)); ?>">
            Semua Produk <i class="fas fa-long-arrow-alt-right"></i>
          </a>
        <?php endif; ?>
      </div>

      <div class="row">

        <?php
        $products = new WP_Query([
          'post_type'      => 'our-products',
          'posts_per_page' => 4,
          'tax_query'      => [
            [
              'taxonomy' => 'industry',
              'field'    => 'slug',
              'terms'    => 'pertambangan',
            ]
          ]
        ]);

        if ($products->have_posts()) :
          while ($products->have_posts()) : $products->the_post();

            $brands = get_the_terms(get_the_ID(), 'brand-products');
            $categories = get_the_terms(get_the_ID(), 'product-category');

            $content = wp_strip_all_tags(get_the_content());
            $short_desc = strtok($content, '.');
        ?>

        <div class="col-6 col-md-3">
          <div class="product-card">

            <div class="product-image">
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
              </a>
            </div>

            <div class="product-content">

              <div class="product-meta">

                <?php if ($brands): ?>
                  <span class="brand_product">
                    <?php echo esc_html($brands[0]->name); ?>
                  </span>
                <?php endif; ?>

                <?php if (!empty($categories) && !is_wp_error($categories)): ?>
                  <span class="cat_products">
                    • <?php echo esc_html($categories[0]->name); ?>
                  </span>
                <?php endif; ?>

              </div>

              <h3 class="product-title"><?php the_title(); ?></h3>

              <p class="product-desc">
                <?php echo esc_html($short_desc); ?>...
              </p>

              <a class="product-link" href="<?php the_permalink(); ?>">
                Selengkapnya <i class="fas fa-long-arrow-alt-right"></i>
              </a>

            </div>
          </div>
        </div>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

      </div>
    </div>
  </section>
</div>