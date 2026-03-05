<section class="insight-section">
  <div class="container">
    <div class="insight-container">

      <?php
      $page = get_page_by_path('homepage2/news_homepage');

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

      <?php if ($title): ?>
        <h2 class="insight-title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($desc): ?>
        <p class="insight-desc"><?php echo esc_html($desc); ?></p>
      <?php endif; ?>

      <div class="insight-grid">

        <?php
        // ======================================
        // 2. Ambil 3 post TERBARU
        // ======================================
        $args = [
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'post_status'    => 'publish',
          'orderby'        => 'date',
          'order'          => 'DESC',
        ];

        $news = new WP_Query($args);

        if ($news->have_posts()) :
          while ($news->have_posts()) : $news->the_post();

            // kategori
            $categories = get_the_category();
            $label = '';

            if ($categories) {
              foreach ($categories as $cat) {
                if ($cat->slug === 'artikel') {
                  $label = 'ARTIKEL';
                }
                if ($cat->slug === 'studi-kasus') {
                  $label = 'STUDI KASUS';
                }
              }
            }

            // tanggal
            $date = get_the_date('d M Y');

            // featured image
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
        ?>

          <article class="insight-card">
            <div class="insight-image">
              <?php if ($thumb): ?>
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
              <?php endif; ?>
            </div>

            <div class="insight-content">
              <span class="insight-meta">
               <span class="cat_news"><?php echo esc_html($label); ?></span> <i class="fas fa-circle"></i>  <span class="date_news"><?php echo esc_html($date); ?></span>
              </span>

              <h3>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            </div>
          </article>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

      </div>

      <div class="insight-footer">
        <a href="<?php echo esc_url(home_url('/news/')); ?>" class="insight-link">
          Lihat Semuanya <i class="fas fa-long-arrow-alt-right"></i>
        </a>
      </div>


    </div>
  </div>
</section>
