<?php

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


<?php
// FILTER PARAM
$search_query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$filter_cat   = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// Query arguments
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'paged'          => $paged,
    's'              => $search_query,
];


// Filter kategori
if (!empty($filter_cat)) {
    $args['category_name'] = $filter_cat;
}

$query = new WP_Query($args);
?>

<section class="wrap_list_news">
    <div class="news-list-section">
        <div class="container">

            <!-- FILTER TOP -->
            <div class="news-filter-top">

                <!-- SEARCH -->
                <form method="GET" class="news-search-form col-12 col-md-6">
                    <input type="text"
                        name="search"
                        placeholder="Cari berdasarkan judul..."
                        value="<?php echo esc_attr($search_query); ?>">
                </form>

                <!-- CATEGORY FILTER -->
                <div class="news-category-filter product-filter">

                    <div class="filter-type">

                        <!-- SHOW ALL -->
                        <button 
                            class="filter-btn <?php echo empty($filter_cat) ? 'active' : ''; ?>" 
                            onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                            Show All
                        </button>

                        <!-- STUDI KASUS -->
                        <button 
                            class="filter-btn <?php echo ($filter_cat == 'studi-kasus') ? 'active' : ''; ?>" 
                            onclick="window.location.href='?category=studi-kasus<?php echo $search_query ? '&search=' . urlencode($search_query) : ''; ?>'">
                            Studi Kasus
                        </button>

                        <!-- ARTIKEL -->
                        <button 
                            class="filter-btn <?php echo ($filter_cat == 'artikel') ? 'active' : ''; ?>" 
                            onclick="window.location.href='?category=artikel<?php echo $search_query ? '&search=' . urlencode($search_query) : ''; ?>'">
                            Artikel
                        </button>

                    </div>

                </div>


            </div>

            <!-- NEWS LIST -->
            <div class="row">

            <?php if ($query->have_posts()) : ?>

                <?php while ($query->have_posts()) : $query->the_post(); ?>

                <?php
                $categories = get_the_category();
                ?>

                <div class="col-12 col-md-4 mb-5">
                    <div class="news-card">

                    <div class="news-image">
                        <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    </div>

                    <div class="news-content">

                        <div class="news-meta">
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

                        <h3 class="news-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                        </h3>

                    </div>

                    </div>
                </div>

                <?php endwhile; wp_reset_postdata(); ?>

                <?php else : ?>

                    <div class="col-12 text-center mt-5">
                        <h4 class="no-product-message">
                            <i class="fas fa-info-circle"></i> Tidak tersedia
                            "<?php echo esc_html($search_query); ?>"
                        </h4>
                    </div>

                <?php endif; ?>

            </div>

               
            <!-- PAGINATION -->
                <?php if ($query->max_num_pages > 1) : ?>

                <div class="pagination-wrap">
                    <?php
                    echo paginate_links([
                        'total'      => $query->max_num_pages,
                        'current'    => $paged,
                        'mid_size'   => 1,
                        'prev_text'  => '<i class="fas fa-chevron-left"></i>',
                        'next_text'  => '<i class="fas fa-chevron-right"></i>',
                        'type'       => 'list',
                        'add_args'   => [
                            'search'   => $search_query,
                            'category' => $filter_cat,
                        ],
                    ]);
                    ?>
                </div>

                <?php endif; ?>



        </div>
    </div>
</section>