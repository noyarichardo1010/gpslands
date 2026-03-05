<section class="wrap_profil_perusahaan">
  <div class="container">
    <div class="row align-items-start">

      <?php
      $page = get_page_by_path('profil-perusahaan/partner-survei-pemetaan');

      $title = '';
      $desc  = '';

      function extract_blocks($blocks, &$title, &$desc) {

        foreach ($blocks as $block) {

          if ($block['blockName'] === 'core/heading' && empty($title)) {
            $title = wp_strip_all_tags(render_block($block));
          }

          if ($block['blockName'] === 'core/paragraph') {
            $desc .= render_block($block);
          }

          if (!empty($block['innerBlocks'])) {
            extract_blocks($block['innerBlocks'], $title, $desc);
          }
        }
      }

      if ($page) {
        $blocks = parse_blocks($page->post_content);
        extract_blocks($blocks, $title, $desc);
      }
      ?>

      <!-- KIRI -->
      <div class="col-md-4 col-12">
        <h2 class="profil-title">
          <?php echo $title; ?>
        </h2>
      </div>

      <!-- KANAN -->
      <div class="col-md-8 col-12">
        <div class="profil-desc">
          <?php echo $desc; ?>
        </div>
      </div>

    </div>
  </div>
</section>