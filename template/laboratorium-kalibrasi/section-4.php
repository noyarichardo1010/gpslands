<section class="wrap_lab_section_4">
    <div class="container">

        <?php
        $page = get_page_by_path('laboratorium-kalibrasi/proses-layanan');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>