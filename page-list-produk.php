<?php
get_header();

while (have_posts()) : the_post();
  $banner_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<!-- HERO / HEADER -->
<section class="product-hero"
  <?php if ($banner_bg): ?>
    style="background-image:url('<?php echo esc_url($banner_bg); ?>')"
  <?php endif; ?>
>
  <div class="product-hero-overlay"></div>

  <div class="container text-center">
    <div class="hero-content">
      <?php the_content(); ?>
    </div>
  </div>
</section>

<?php endwhile; ?>

<!-- LIST PRODUK -->
<section class="product-list-section">
  <div class="container">

    <?php
    $custom_order = [
      'trimble-geospatial',
      'dji-enterprise',
      'sensys-products',
      'beta'
    ];

    $all_brands = get_terms([
      'taxonomy'   => 'brand-products',
      'hide_empty' => true,
    ]);

    if (!empty($all_brands) && !is_wp_error($all_brands)) :

      $ordered_brands = [];
      $other_brands   = [];

      // Urut Brand
      foreach ($custom_order as $slug) {
        foreach ($all_brands as $brand) {
          if ($brand->slug === $slug) {
            $ordered_brands[] = $brand;
          }
        }
      }

      // Brand Lainnya
      foreach ($all_brands as $brand) {
        if (!in_array($brand->slug, $custom_order)) {
          $other_brands[] = $brand;
        }
      }


      foreach ($ordered_brands as $brand) :
    ?>

    <div class="brand-section" data-aos="fade-down">

      <div class="brand-header">
        <h2 class="section-title"><?php echo esc_html($brand->name); ?></h2>

        <a class="brand-link" href="<?php echo esc_url(get_term_link($brand)); ?>">
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
              'taxonomy' => 'brand-products',
              'field'    => 'term_id',
              'terms'    => $brand->term_id,
            ]
          ]
        ]);

        if ($products->have_posts()) :
          while ($products->have_posts()) : $products->the_post();

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
                <span class="brand_product"><?php echo esc_html($brand->name); ?></span>
                <?php if ($categories): ?>
                  <span class="cat_products"> • <?php echo esc_html($categories[0]->name); ?></span>
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

    <?php
      endforeach;

      /*
      ============================
      PRODUK LAINNYA
      ============================
      */
      if (!empty($other_brands)) :
    ?>


      <div class="brand-section">

        <div class="brand-header">
          <h2 class="section-title">Produk Lainnya</h2>

          <a class="brand-link" href="<?php echo esc_url(home_url('/brand-products/others')); ?>">
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
                'taxonomy' => 'brand-products',
                'field'    => 'slug',
                'terms'    => $custom_order,
                'operator' => 'NOT IN'
              ]
            ],
            'orderby' => 'date',
            'order'   => 'DESC'
          ]);

          if ($products->have_posts()) :
            while ($products->have_posts()) : $products->the_post();

              $brands = get_the_terms(get_the_ID(), 'brand-products');
              $categories = get_the_terms(get_the_ID(), 'product-category');

              $content = wp_strip_all_tags(get_the_content());
              $short_desc = strtok($content, '.');
          ?>

          <div class="col-12 col-md-3">
            <div class="product-card">

              <div class="product-image">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium'); ?>
                </a>
              </div>

              <div class="product-content">

                <div class="product-meta">
                  <?php if ($brands): ?>
                    <span class="brand_product"><?php echo esc_html($brands[0]->name); ?></span>
                  <?php endif; ?>

                  <?php if ($categories): ?>
                    <span class="cat_products"> • <?php echo esc_html($categories[0]->name); ?></span>
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



    <?php
      endif;
    endif;
    ?>





  </div>
</section>
<?php get_footer(); ?>