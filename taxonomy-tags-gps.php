<?php
get_header();

$industry = get_queried_object();
?>

<!-- LIST PRODUK -->
<section class="product-list-section wrap_brand_products">
  <div class="brand-section container">

  <div class="wrap_title_filter" data-aos="zoom-in">
    <div class="row">
        <div class="col-12 col-md-5">
            <!-- BRAND TITLE -->
            <div class="brand-title-wrap">
                <h1 class="brand-title text-uppercase">
                    <?php echo esc_html($industry->name); ?>
                </h1>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <!-- FILTER BAR -->
            <div class="product-filter">

                <div class="filter-type">
                    <button class="filter-btn active" data-type="all">Show All</button>

                    <?php
                    $types = get_terms([
                    'taxonomy' => 'type_products_gps',
                    'hide_empty' => true
                    ]);

                    foreach ($types as $type) :
                    ?>
                    <button class="filter-btn" data-type="<?php echo esc_attr($type->slug); ?>">
                        <?php echo esc_html($type->name); ?>
                    </button>
                    <?php endforeach; ?>
                </div>

                <div class="filter-industry d-none">
                    <span class="show_filter_text">Show by :</span>
                    <select id="industryFilter">
                        <option selected value="all">All Industries</option>
                    <?php
                    // Ambil semua product ID berdasarkan Industry aktif
                    $product_ids = get_posts([
                        'post_type'      => 'our-products',
                        'posts_per_page' => -1,
                        'fields'         => 'ids',
                        'tax_query'      => [
                        [
                            'taxonomy' => 'tags-gps',
                            'field'    => 'term_id',
                            'terms'    => $industry->term_id,
                        ]
                        ]
                    ]);
                    
                    $industries = !empty($product_ids)
                        ? wp_get_object_terms($product_ids, 'tags-gps', ['orderby' => 'name'])
                        : [];
  
                    foreach ($industries as $industry) :
                    ?>
                        <option value="<?php echo esc_attr($industry->slug); ?>">
                        <?php echo esc_html($industry->name); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                </div>
            </div>
        </div>

    </div>
   
    <!-- PRODUCT GRID -->
    <div class="row" data-aos="fade-up">
        <div class="no-product-message" style="display:none;">
            <i class="fas fa-info-circle"></i> Produk tidak tersedia
        </div>

        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        $products = new WP_Query([
        'post_type'      => 'our-products',
        'posts_per_page' => 12,
        'paged'          => $paged,
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

            $brand_terms = get_the_terms(get_the_ID(), 'brand-products');
            $brand_name = (!empty($brand_terms) && !is_wp_error($brand_terms))
                ? $brand_terms[0]->name
                : '';

            $type_terms = wp_get_post_terms(get_the_ID(), 'type_products_gps');
            $industry_terms = wp_get_post_terms(get_the_ID(), 'industry');
            $categories = get_the_terms(get_the_ID(), 'product-category');

            $type_slug = $type_terms ? $type_terms[0]->slug : '';
            $industry_slug = $industry_terms ? $industry_terms[0]->slug : '';

            $content = wp_strip_all_tags(get_the_content());
            $short_desc = strtok($content, '.');
        ?>

        <!-- CARD -->
        <div class="col-6 col-md-3 product-item"
            data-type="<?php echo esc_attr($type_slug); ?>"
            data-industry="<?php echo esc_attr($industry_slug); ?>">

            <div class="product-card">

            <div class="product-image">
                <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
                </a>
            </div>

            <div class="product-content">

                <div class="product-meta">
                <?php if ($brand_name): ?>
                    <span class="brand_product">
                        <?php echo esc_html($brand_name); ?>
                    </span>
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

        </div><!-- /.row -->

        <!-- PAGINATION -->
        <?php if ($products->max_num_pages > 1) : ?>
        <div class="pagination-wrap">
            <?php
            echo paginate_links([
            'total'      => $products->max_num_pages,
            'current'    => $paged,
            'mid_size'   => 1,
            'prev_text'  => '<i class="fas fa-chevron-left"></i>',
            'next_text'  => '<i class="fas fa-chevron-right"></i>',
            'type'       => 'list',
            ]);
            ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php get_footer(); ?>
