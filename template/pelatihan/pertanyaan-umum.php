<section class="wrap_pelatihan pertanyaan_umum">
    <div class="container">

        <?php
        $page = get_page_by_path('pelatihan/pertanyaan-umum');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>