<section class="wrap_mengapa_kami_testimoni">
  <div class="container">

    <?php
    $page = get_page_by_path('mengapa-kami/testimoni-klien');

    if ($page) :
    ?>
      <div class="title_subtitle_section">
        <?php echo apply_filters('the_content', $page->post_content); ?>
      </div>
    <?php endif; ?>

    <!-- SWIPER -->
    <div class="swiper testimoniSwiper">
      <div class="swiper-wrapper">

        <?php
        $args = [
          'post_type'      => 'client-reviews',
          'posts_per_page' => -1,
          'post_status'    => 'publish'
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();

            $photo    = get_field('profile_picture');
            $position = get_field('position');
            $company  = get_field('company');
            $reviews  = get_field('reviews');
        ?>

        <div class="swiper-slide">
          <div class="card-testimoni">

            <div class="testimoni-header">

              <?php if ($photo): ?>
                <img class="client-photo"
                     src="<?= esc_url($photo['sizes']['thumbnail']); ?>"
                     alt="<?= esc_attr(get_the_title()); ?>">
              <?php endif; ?>

              <div class="client-info">
                <h5 class="client-name"><?php the_title(); ?></h5>
                <p class="client-position">
                  <?= esc_html($position); ?>,
                  <?= esc_html($company); ?>
                </p>
              </div>

              <span class="quote-icon">
                <i class="fas fa-quote-left"></i>
              </span>

            </div>

            <div class="testimoni-content">
              <p>"<?= esc_html($reviews); ?>"</p>
            </div>

          </div>
        </div>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

      </div>

      <div class="swiper-pagination"></div>
    </div>

  </div>
</section>