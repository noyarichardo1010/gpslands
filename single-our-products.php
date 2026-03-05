<?php
get_header();

while (have_posts()) : the_post();

$brand = get_the_terms(get_the_ID(), 'brand-products');
$category = get_the_terms(get_the_ID(), 'product-category');

$key_products = get_field('key_products');
$product_gallery = get_field('product_gallery');

?>

<section class="col-12 col-md-7 product-detail-section m-auto">
  <div class="container">
    <div class="align-items-start">

    <div class="wrap_detail_products">

    <div class="row">

        <div class="col-12 col-lg-6" data-aos="fade-right">

            <div class="product-gallery">

            <div class="swiper product-main-slider">
                <div class="swiper-wrapper">

                    <?php if (!empty($product_gallery)) : ?>
                        <?php foreach ($product_gallery as $image) : ?>
                            <div class="swiper-slide">
                                <div class="zoom-container">
                                    <img 
                                        src="<?php echo esc_url($image['full_image_url']); ?>"
                                        alt="<?php echo esc_attr($image['title']); ?>"
                                        class="img-fluid zoom-image"
                                    >
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="swiper-slide">
                            <div class="zoom-container">
                                <?php the_post_thumbnail('large', ['class' => 'zoom-image']); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="swiper-button-next">
                    <i class="fas fa-chevron-circle-right"></i>
                </div>

                <div class="swiper-button-prev">
                    <i class="fas fa-chevron-circle-left"></i>
                </div>
            </div>

        <?php if (!empty($product_gallery)) : ?>
            <div class="swiper product-thumb-slider">
                    <div class="swiper-wrapper">

                        <?php foreach ($product_gallery as $image) : ?>
                        <div class="swiper-slide">
                            <img 
                            src="<?php echo esc_url($image['thumbnail_image_url']); ?>"
                            alt="<?php echo esc_attr($image['title']); ?>"
                            class="img-fluid"
                            loading="lazy"
                            >
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            <?php endif; ?>


            </div>
        </div>


        <div class="col-12 col-lg-6">

            <div class="product-info">

                <div class="product-meta-top">
                    <?php if ($brand) : ?>
                    <span class="brand_name"><?php echo esc_html($brand[0]->name); ?></span>
                    <?php endif; ?>

                    <?php if ($category) : ?>
                    <span class="cat_name"> <i class="fas fa-circle"></i> <?php echo esc_html($category[0]->name); ?></span>
                    <?php endif; ?>
                </div>

                <h1 class="product-title">
                    <?php the_title(); ?>
                </h1>

                <?php
                    $product_key = get_post_meta(get_the_ID(), 'product_key', true);

                    if (!empty($product_key) && is_array($product_key)) :
                    ?>
                    <ul class="product-key-list">
                    <?php foreach ($product_key as $row) : ?>
                        <?php if (!empty($row['key_products'])) : ?>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <?php echo esc_html($row['key_products']); ?>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <!-- CTA -->
                <div class="product-cta" data-aos="fade-up">
                    <p>
                    <strong>Siap memulai proyek Anda?</strong><br>
                    Hubungi kami hari ini untuk konsultasi gratis dan solusi terbaik.
                    </p>

                    <a target="_blank" href="https://wa.me/+6281388835585" class="gps-btn-primary-style w-100 text-center">
                    <i class="fab fa-whatsapp"></i> Konsultasi Gratis
                    </a>
                </div>

            </div>
        </div>

    </div>

    </div>
</div>

    <div class="product-description">
        <h2 class="wp-block-heading">Deskripsi</h3>
      <?php the_content(); ?>
    </div>


    <?php
        $spesifikasi = get_post_meta(get_the_ID(), 'spesifikasi-group', true);
        if (!empty($spesifikasi)) :
        ?>

        <section class="product-specifications mt-5" data-aos="fade-up">
            <h3 class="section-title">SPESIFIKASI</h3>

            <div class="spec-table">
                <?php foreach ($spesifikasi as $row) : ?>
                    <?php if (!empty($row['spesifikasi-label']) && !empty($row['spesifikasi-value'])) : ?>
                        <div class="spec-row">
                            <div class="spec-label">
                                <?php echo esc_html($row['spesifikasi-label']); ?>
                            </div>
                            <div class="spec-value">
                                <?php echo esc_html($row['spesifikasi-value']); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <?php endif; ?>


    <!-- Download -->
    <?php
        $downloads = get_post_meta(get_the_ID(), 'download_link', true);

        if (!empty($downloads)) :
        ?>

        <section class="product-download mt-5">
            <h3 class="section-title">DOWNLOAD</h3>
            <h6>Ingin melihat spesifikasi lebih detail?</h6>
            <p>Unduh file PDF spesifikasi lengkap melalui tautan di bawah.</p>

            <ul class="download-list">

                <?php foreach ($downloads as $row) : ?>

                    <?php 
                    if (!empty($row['link'])) :

                        $attachment_id = $row['link'];

                        $file_url  = wp_get_attachment_url($attachment_id);
                        $file_path = get_attached_file($attachment_id);
                        $file_name = basename($file_path);
                    ?>

                        <li>
                            <a href="<?php echo esc_url($file_url); ?>" target="_blank">
                                <?php echo esc_html($file_name); ?>
                            </a>
                        </li>

                    <?php endif; ?>

                <?php endforeach; ?>

            </ul>

        </section>

        <?php endif; ?>

    
    <!-- FAQ -->
    <?php
        $faqs = get_post_meta(get_the_ID(), 'faq_products', true);

        if (!empty($faqs)) :
        ?>

        <section class="product-faq mt-5" data-aos="fade-up">
            <h3 class="section-title">Pertanyaan Umum</h3>

            <div class="accordion" id="faqAccordion">

                <?php foreach ($faqs as $index => $row) : ?>

                    <?php
                    $pertanyaan = $row['pertanyaan'] ?? '';
                    $jawaban    = $row['value-editor'] ?? '';
                    ?>

                    <?php if ($pertanyaan && $jawaban) : ?>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo $index; ?>">
                                <button class="accordion-button <?php echo ($index != 0) ? 'collapsed' : ''; ?>"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-<?php echo $index; ?>">
                                    <?php echo esc_html($pertanyaan); ?>
                                </button>
                            </h2>

                            <div id="collapse-<?php echo $index; ?>"
                                class="accordion-collapse collapse <?php echo ($index == 0) ? 'show' : ''; ?>"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body">
                                    <?php echo wp_kses_post($jawaban); ?>
                                </div>

                            </div>
                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>
        </section>

        <?php endif; ?>


        <?php
            get_template_part('template/section-call-us');
        ?>

  </div>
</section>



<section class="wrap_recom col-12 col-md-12" data-aos="fade-up">

    <?php
    $current_id     = get_the_ID();
    $brand_terms    = get_the_terms($current_id, 'brand-products');
    $category_terms = get_the_terms($current_id, 'product-category');

    $args = [
        'post_type'      => 'our-products',
        'posts_per_page' => 4,
        'post__not_in'   => [$current_id],
    ];

    $related_products = null;

    // same Brand
    if ($brand_terms && !is_wp_error($brand_terms)) {

        $args['tax_query'] = [
            [
                'taxonomy' => 'brand-products',
                'field'    => 'term_id',
                'terms'    => $brand_terms[0]->term_id,
            ]
        ];

        $related_products = new WP_Query($args);
    }

    if (!$related_products || !$related_products->have_posts()) {

        if ($category_terms && !is_wp_error($category_terms)) {

            $args['tax_query'] = [
                [
                    'taxonomy' => 'product-category',
                    'field'    => 'term_id',
                    'terms'    => $category_terms[0]->term_id,
                ]
            ];

            $related_products = new WP_Query($args);
        }
    }

    // New Products
    if (!$related_products || !$related_products->have_posts()) {

        unset($args['tax_query']);
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';

        $related_products = new WP_Query($args);
    }
    ?>

    <?php if ($related_products && $related_products->have_posts()) : ?>

    <div class="recommended-products mt-5">
        <div class="container">

            <div class="brand-header">
                <h3 class="section-title">Rekomendasi Produk</h3>
            </div>

            <div class="row">

            <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>

                <?php
                $brand = get_the_terms(get_the_ID(), 'brand-products');
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
                                <?php if ($brand): ?>
                                    <span class="brand_product">
                                        <?php echo esc_html($brand[0]->name); ?>
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

            <?php endwhile; wp_reset_postdata(); ?>

            </div>

            <div class="text-center mt-4">
                <a href="<?php echo esc_url( home_url('/list-produk/') ); ?>" class="brand-link">
                    Semua Produk
                    <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            </div>

        </div>
    </div>

    <?php endif; ?>

</section>



<?php endwhile; get_footer(); ?>
