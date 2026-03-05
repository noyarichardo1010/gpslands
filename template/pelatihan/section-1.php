<section class="wrap_pelatihan">
    <div class="container">

        <?php
        $page = get_page_by_path('pelatihan/pelatihan-resmi-produk-yang-optimal');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>