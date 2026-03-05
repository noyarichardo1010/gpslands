<section class="wrap_pelatihan wrap_pelatihan_section2">
    <div class="container">

        <?php
        $page = get_page_by_path('pelatihan/training-pasca-pembelian');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>