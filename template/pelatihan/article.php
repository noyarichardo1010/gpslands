<?php
$current_id = get_the_ID();
$category_ids = [];

if (is_single()) {
    $categories = get_the_category($current_id);
    if (!empty($categories)) {
        $category_ids = wp_list_pluck($categories, 'term_id');
    }
}

$args = [
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'post__not_in'        => [$current_id],
    'ignore_sticky_posts' => true
];

if (!empty($category_ids)) {
    $args['category__in'] = $category_ids;
}

$related = new WP_Query($args);
?>

<section class="wrap_list_news recommended-articles mt-0 pt-3">
  <div class="container">

    <h2 class="section-title">Rekomendasi Artikel</h2>

    <div class="row">

      <?php if ($related->have_posts()) : ?>
        <?php while ($related->have_posts()) : $related->the_post(); 
          $post_categories = get_the_category();
        ?>
          <div class="col-12 col-md-4">
            <div class="news-card">

              <div class="news-image">
                <a href="<?php the_permalink(); ?>">
                  <?php 
                  if (has_post_thumbnail()) {
                      the_post_thumbnail('medium_large');
                  }
                  ?>
                </a>
              </div>

              <div class="news-content">

                <div class="news-meta">
                  <span class="news-category">
                    <?php echo !empty($post_categories) ? esc_html($post_categories[0]->name) : 'News'; ?>
                  </span>
                  <span class="news-date">
                    • <?php echo get_the_date('d M Y'); ?>
                  </span>
                </div>

                <h3 class="news-title">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>

              </div>

            </div>
          </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p class="text-center">Belum ada artikel tersedia.</p>
      <?php endif; ?>

    </div>

    <div class="insight-footer mt-4 text-center mb-5">
      <a href="<?php echo esc_url(home_url('/news')); ?>" class="insight-link">
        Lihat Semuanya <i class="fas fa-long-arrow-alt-right"></i>
      </a>
    </div>

  </div>
</section>