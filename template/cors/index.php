
<?php

while (have_posts()) : the_post();
  $banner_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
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


<!-- CONTENT SECTION -->
<section class="cors_content product-content py-5 pb-0">
  <div class="container">
    <?php the_content(); ?>
  </div>
</section>

<?php endwhile; ?>