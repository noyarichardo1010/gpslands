<!-- <?php
$hero_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<section class="gps-hero" style="background-image: url('<?php echo esc_url($hero_bg); ?>');">
  <div class="gps-hero-overlay"></div>

  <div class="container">
    <div class="row justify-content-center text-center mt-5">
      <div class="col-lg-10 col-12" data-aos="fade-up">

        <?php
        while ( have_posts() ) :
          the_post();
          the_content();
        endwhile;
        ?>

      </div>
    </div>
  </div>
</section> -->



<?php
$hero_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
$featured_video = get_field('featured_video'); // ACF File field
?>

<section class="wrap_section1_home gps-hero">

  <?php if ($featured_video) : ?>

      <video class="gps-hero-video" autoplay muted loop playsinline>
          <source src="<?php echo esc_url($featured_video['url']); ?>" type="video/mp4">
      </video>

  <?php elseif ($hero_bg) : ?>

      <div class="gps-hero-bg" 
           style="background-image: url('<?php echo esc_url($hero_bg); ?>');">
      </div>

  <?php endif; ?>

  <div class="gps-hero-overlay"></div>

  <div class="container">
    <div class="row justify-content-center text-center mt-5">
      <div class="col-lg-10 col-12" data-aos="fade-up">

        <?php
        while ( have_posts() ) :
          the_post();
          the_content();
        endwhile;
        ?>

      </div>
    </div>
  </div>

</section>

