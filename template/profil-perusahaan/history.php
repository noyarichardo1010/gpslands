<section class="wrap_history">
  <div class="container">

    <?php
    // HEADER FROM PAGE (history)
    $page = get_page_by_path('profil-perusahaan/history');

    if ($page) {
      echo '<div class="history_header">';
      echo apply_filters('the_content', $page->post_content);
      echo '</div>';
    }

    // LOOP CPT HISTORY
    $args = [
      'post_type'      => 'history',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC'
    ];

    $history = new WP_Query($args);

    if ($history->have_posts()) :
    ?>

    <div class="history-swiper swiper">

      <div class="swiper-wrapper">

        <?php while ($history->have_posts()) : $history->the_post();

          $image = get_field('history_image');
          $title_history = get_field('title_history');
          $desc  = get_field('descriptions');
          $year  = get_the_title();

          if (is_array($image)) {
            $image_url = $image['url'];
          } elseif (is_numeric($image)) {
            $image_url = wp_get_attachment_image_url($image, 'large');
          } else {
            $image_url = $image;
          }
        ?>

        <div class="swiper-slide" data-year="<?php echo esc_attr($year); ?>">
          <div class="history_card">

            <div class="history_image">
              <img src="<?php echo esc_url($image_url); ?>" alt="">
            </div>

            <div class="history_content">
              <h3><?php echo esc_html($title_history); ?></h3>
              <p><?php echo esc_html($desc); ?></p>
            </div>

          </div>
        </div>

        <?php endwhile; ?>

      </div>

      <!-- Timeline dots -->
      <div class="history_timeline"></div>

      <!-- YEAR DISPLAY (ANTI STACK) -->
      <div class="history_year_display"></div>

    </div>

    <?php endif; wp_reset_postdata(); ?>

  </div>
</section>