<section class="wrap_lab">
    <div class="container">

        <?php
        $page = get_page_by_path('laboratorium-kalibrasi/laboratorium-kalibrasi-gps');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>