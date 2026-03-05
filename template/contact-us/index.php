<?php

while (have_posts()) : the_post();
  $banner_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');

  $page  = get_page_by_path('kontak-kami');
  $title = '';
  $desc  = '';

  if ($page) {

    $blocks = parse_blocks($page->post_content);

    foreach ($blocks as $block) {

      if ($block['blockName'] === 'core/heading' && empty($title)) {
        $title = wp_strip_all_tags(render_block($block));
      }

      if ($block['blockName'] === 'core/paragraph' && empty($desc)) {
        $desc = wp_strip_all_tags(render_block($block));
      }
    }
  }
?>

<!-- HERO / HEADER -->
<section class="product-hero"
  <?php if ($banner_bg): ?>
    style="background-image:url('<?php echo esc_url($banner_bg); ?>')"
  <?php endif; ?>
>
  <div class="product-hero-overlay"></div>

  <div class="container text-center">
    <div class="hero-content">
      <h2 class="wp-block-heading"><?php the_title(); ?></h2>
    </div>
  </div>
</section>


<section class="consult-section">
  <div class="container">

    <div class="consult-container col-12 col-md-8">

      <div class="title_subtitle_section">

        <?php if ($title): ?>
          <h2 class="consult-title">
            <?php echo esc_html($title); ?>
          </h2>
        <?php endif; ?>

        <?php if ($desc): ?>
          <p class="consult-desc">
            <?php echo esc_html($desc); ?>
          </p>
        <?php endif; ?>

      </div>

      <div class="consult-card">
        <div class="wrap_form_contacts">
          <?php
            echo do_shortcode('[contact-form-7 id="a37f414" title="Contact form 1"]');
          ?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php endwhile; ?>