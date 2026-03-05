<?php get_header(); ?>

<section class="wrap-single-news-section">
  <div class="col-12 col-md-7 single-news-section container">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php
      $categories = get_the_category();
      $tags       = get_the_tags();
      ?>

      <!-- FEATURED IMAGE -->
      <div class="news-featured-image">
        <?php the_post_thumbnail('large'); ?>
      </div>

      <!-- META -->
      <div class="news-meta-top">
        <?php if ($categories): ?>
          <span class="news-category">
            <?php echo esc_html($categories[0]->name); ?>
          </span>
        <?php endif; ?>
        <i class="fas fa-circle"></i>
        <span class="news-date">
          <?php echo get_the_date('d M Y'); ?>
        </span>
      </div>

      <!-- TITLE -->
      <h1 class="news-title-main">
        <?php the_title(); ?>
      </h1>

      <!-- CONTENT -->
      <div class="news-content-main">
        <?php the_content(); ?>
      </div>

      <!-- TAGS -->
      <?php if ($tags): ?>
        <div class="news-tags">
          <span class="tag-label">Tag</span>
          <?php foreach ($tags as $tag): ?>
            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-item">
              <?php echo esc_html($tag->name); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- SHARE -->
      <div class="news-share">
        <span>Share</span>

        <a href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>">
          <i class="fas fa-envelope"></i>
        </a>

        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" target="_blank">
          <i class="fab fa-linkedin"></i>
        </a>

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
          <i class="fab fa-facebook"></i>
        </a>

        <div class="copy-wrapper">
          <button type="button"
                  class="copy-btn"
                  data-link="<?php the_permalink(); ?>">
            <i class="fas fa-copy"></i>
          </button>

          <span class="copy-text">Copied!</span>
        </div>
      </div>

    <?php endwhile; endif; ?>

  </div>
</section>

<section class="wrap_list_news recommended-articles">
  <div class="container">

    <h2 class="section-title">Rekomendasi Artikel</h2>

    <div class="row">

      <?php
      $current_id = get_the_ID();
      $categories = get_the_category();

      if ($categories) :

        $related = new WP_Query([
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'post__not_in'   => [$current_id],
          'category__in'   => [$categories[0]->term_id],
        ]);

        if ($related->have_posts()) :
          while ($related->have_posts()) : $related->the_post();
      ?>

      <div class="col-12 col-md-4">
        <div class="news-card">

          <div class="news-image">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium_large'); ?>
            </a>
          </div>

          <div class="news-content">

            <div class="news-meta">
              <span class="news-category">
                <?php echo esc_html($categories[0]->name); ?>
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

      <?php
          endwhile;
          wp_reset_postdata();
        endif;
      endif;
      ?>

    </div>

    <div class="insight-footer mt-4 text-center mb-5">
        <a href="<?php echo esc_url(home_url('/news/')); ?>" class="insight-link">
          Lihat Semuanya <i class="fas fa-long-arrow-alt-right"></i>
        </a>
    </div>

  </div>
</section>

<?php get_footer(); ?>