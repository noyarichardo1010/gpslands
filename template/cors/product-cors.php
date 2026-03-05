<!-- LIST PRODUK -->
<section class="wrap_product_cors product-list-section">
  <div class="container">

    <div class="brand-section">

      <div class="brand-header">
        <h2 class="section-title">Produk CORS</h2>

        <a class="brand-link" href="<?php echo get_term_link('cors', 'tags-gps'); ?>">
          Semua Produk <i class="fas fa-long-arrow-alt-right"></i>
        </a>
      </div>

      <div class="row">

        <?php
        $products = new WP_Query([
          'post_type'      => 'our-products',
          'posts_per_page' => 4,
          'tax_query'      => [
            [
              'taxonomy' => 'tags-gps',
              'field'    => 'slug',
              'terms'    => 'cors',
            ]
          ]
        ]);

        if ($products->have_posts()) :
          while ($products->have_posts()) : $products->the_post();

            $categories = get_the_terms(get_the_ID(), 'product-category');
            $brands     = get_the_terms(get_the_ID(), 'brand-products');

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

                <?php if ($brands && !is_wp_error($brands)) : ?>
                  <span class="brand_product">
                    <?php echo esc_html($brands[0]->name); ?>
                  </span>
                <?php endif; ?>

                <?php if ($categories): ?>
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

  </div>
</section>