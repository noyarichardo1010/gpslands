<?php
$map_page = get_page_by_path('kontak-kami/map-kontak');
$map_content = '';
if ($map_page) {
    $map_content = do_blocks($map_page->post_content);
}

$args = [
  'post_type'      => 'footer-settings',
  'posts_per_page' => 1,
  'post_status'    => 'publish'
];

$footer_query = new WP_Query($args);
?>

<div class="wrap_map_kontak_kami">
    <div class="consult-bg"></div>  
    <div class="container">
        <div class="map_content">
            <?php echo $map_content; ?>
        </div>

        <div class="sosmed_content">
            <div class="title_sosmed col-12 col-md-6 m-auto">
                <h3 class="title_head">Social Media</h3>
                <p>Dapatkan update terbaru seputar produk, layanan, aktivitas perusahaan, serta informasi dunia survei dan pemetaan melalui media sosial kami.</p>
            </div>

            <div class="col-12 col-md-8 m-auto">

                <?php if ($footer_query->have_posts()) : 
                        $footer_query->the_post();

                        $instagram = get_field('footer_instagram');
                        $facebook  = get_field('footer_facebook');
                        $linkedin  = get_field('footer_linkedin');
                        $youtube   = get_field('footer_youtube');
                        $tiktok    = get_field('footer_tiktok');
                    ?>

                        <?php if ($instagram) : ?>
                            <a target="_blank" href="<?php echo esc_url($instagram); ?>">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($facebook) : ?>
                            <a target="_blank" href="<?php echo esc_url($facebook); ?>">
                                <i class="fab fa-facebook"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($linkedin) : ?>
                            <a target="_blank" href="<?php echo esc_url($linkedin); ?>">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($youtube) : ?>
                            <a target="_blank" href="<?php echo esc_url($youtube); ?>">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($tiktok) : ?>
                            <a target="_blank" href="<?php echo esc_url($tiktok); ?>">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        <?php endif; ?>

                    <?php 
                        wp_reset_postdata();
                    endif; 
                    ?>

            </div>
            
            

        </div>
    </div>
    

</div>