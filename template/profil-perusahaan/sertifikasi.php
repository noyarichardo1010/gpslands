<section class="wrap_sertifikasi">
  <div class="container">

    <?php
    // HEADER PAGE
    $page = get_page_by_path('profil-perusahaan/sertifikasi');

    if ($page) {
      echo '<div class="sertifikasi_header text-center">';
      echo apply_filters('the_content', $page->post_content);
      echo '</div>';
    }

    // LOOP CPT
    $args = [
      'post_type'      => 'sertifikasi',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC'
    ];

    $sertifikasi = new WP_Query($args);

    if ($sertifikasi->have_posts()) :
    ?>

    <div class="row">
        <?php while ($sertifikasi->have_posts()) : $sertifikasi->the_post();

            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $date = get_the_date('d M Y');
            $desc = get_the_excerpt();
        ?>
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <a href="<?php the_permalink(); ?>" class="sertifikat_link">
                    <div class="sertifikat_card">

                    <?php if ($image_url) : ?>
                    <div class="sertifikat_image">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>">
                    </div>
                    <?php endif; ?>

                    <div class="sertifikat_content">

                    <span class="sertifikat_date">
                        <?php echo esc_html(strtoupper($date)); ?>
                    </span>

                    <h3><?php the_title(); ?></h3>

                    <p>
                        <?php echo esc_html($desc); ?>
                    </p>

                    </div>
                    </div>
                </a>
            </div>

        <?php endwhile; ?>
        </div>

    <?php endif; wp_reset_postdata(); ?>

  </div>
</section>