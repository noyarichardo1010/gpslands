<section class="wrap_mengapa_kami">
    <div class="container">

        <?php
        $page = get_page_by_path('mengapa-kami/lebih-dari-sekadar-penyedia-jasa');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>