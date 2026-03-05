<?php
function render_industry_images($blocks) {

  foreach ($blocks as $block) {

    if ($block['blockName'] === 'core/image') {

      $image_id = $block['attrs']['id'] ?? null;

      if ($image_id) {

        $image_url = wp_get_attachment_image_url($image_id, 'large');

        $link = '';

        if (!empty($block['innerHTML'])) {
          preg_match('/<a[^>]+href="([^"]+)"/', $block['innerHTML'], $link_match);
          if (!empty($link_match[1])) {
            $link = $link_match[1];
          }
        }

        if (empty($link) && !empty($block['attrs']['href'])) {
          $link = $block['attrs']['href'];
        }

        if (empty($link)) {
          $link = '#';
        }

        // ===== Ambil Caption =====
        $caption = '';

        if (!empty($block['innerHTML'])) {
          preg_match('/<figcaption.*?>(.*?)<\/figcaption>/s', $block['innerHTML'], $matches);
          if (!empty($matches[1])) {
            $caption = strip_tags($matches[1]);
          }
        }

        if (empty($caption)) {
          $caption = wp_get_attachment_caption($image_id);
        }
        ?>

        <div class="col-12 col-md-3 mb-4">
          <div class="industry-card">
            <a href="<?php echo esc_url($link); ?>">
              <div class="industry-image"
                   style="background-image:url('<?php echo esc_url($image_url); ?>')">
                <div class="industry-caption">
                  <?php echo esc_html($caption); ?>
                </div>
              </div>
            </a>
          </div>
        </div>

        <?php
      }
    }

    if (!empty($block['innerBlocks'])) {
      render_industry_images($block['innerBlocks']);
    }
  }
}

$page = get_page_by_path('solusi-cors/industry-cors', OBJECT, 'page');

if ($page) :
  $blocks = parse_blocks($page->post_content);
?>

<section class="industry-related cors_industry">
  <div class="container">

    <h2 class="industry-title">Industri Terkait</h2>

    <div class="row">
      <?php render_industry_images($blocks); ?>
    </div>

  </div>
</section>

<?php endif; ?>