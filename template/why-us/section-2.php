<section class="wrap_mengapa_kami_keunggulan">
    <div class="container">

        <?php
        $page = get_page_by_path('mengapa-kami/keunggulan-yang-membuat-kami-berbeda');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>