<section class="wrap_visi_misi">
    <div class="container">

        <?php
        $page = get_page_by_path('profil-perusahaan/visi-misi');

        if ($page) {
        echo apply_filters('the_content', $page->post_content);
        }
        ?>

    </div>
</section>