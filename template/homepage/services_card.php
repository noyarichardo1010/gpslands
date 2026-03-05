<section class="gps-services">
  <div class="container">
    <div class="row g-4">

<?php

function gps_find_button_url($blocks) {

  foreach ($blocks as $block) {

    if ($block['blockName'] === 'core/button') {

      // ambil url langsung
      if (!empty($block['attrs']['url'])) {
        return $block['attrs']['url'];
      }

      // fallback dari HTML render
      $html = render_block($block);
      if (preg_match('/href="([^"]+)"/', $html, $m)) {
        return $m[1];
      }
    }

    // cek child block (penting)
    if (!empty($block['innerBlocks'])) {
      $found = gps_find_button_url($block['innerBlocks']);
      if ($found) return $found;
    }
  }

  return '';
}

$page = get_page_by_path('homepage2/card-banner');

if ($page) {

  $blocks = parse_blocks($page->post_content);

  foreach ($blocks as $block) {

    if ($block['blockName'] === 'core/columns') {

      foreach ($block['innerBlocks'] as $column) {

        $icon  = '';
        $title = '';
        $desc  = '';
        $url   = '';

        foreach ($column['innerBlocks'] as $inner) {

          // IMAGE
          if ($inner['blockName'] === 'core/image') {
            $img_id = $inner['attrs']['id'] ?? 0;
            if ($img_id) {
              $icon = wp_get_attachment_image_url($img_id, 'full');
            }
          }

          // TITLE
          if ($inner['blockName'] === 'core/heading') {
            $title = wp_strip_all_tags(render_block($inner));
          }

          // DESCRIPTION
          if ($inner['blockName'] === 'core/paragraph') {
            $desc = wp_strip_all_tags(render_block($inner));
          }

          $found_url = gps_find_button_url([$inner]);
          if ($found_url) {
            $url = $found_url;
          }
        }
?>

      <!-- CARD -->
      <div class="col-lg-3 col-md-6" data-aos="fade-down">
        <div class="gps-card">

          <?php if ($icon): ?>
            <div class="gps-card-icon">
              <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>">
            </div>
          <?php endif; ?>

          <h5><?php echo esc_html($title); ?></h5>

          <?php if ($desc): ?>
            <p><?php echo esc_html($desc); ?></p>
          <?php endif; ?>

          <?php if ($url): ?>
            <a href="<?php echo esc_url($url); ?>" class="gps-link">
              Selengkapnya <i class="fas fa-arrow-right"></i>
            </a>
          <?php endif; ?>

        </div>
      </div>

<?php
      }
    }
  }
}
?>

    </div>
  </div>
</section>