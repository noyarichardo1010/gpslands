<section class="wrap_tentang_karir">
    <div class="container">

        <?php
        $page = get_page_by_path('karir/tentang-karir');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>