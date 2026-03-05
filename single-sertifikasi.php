<?php get_header(); ?>

<section class="wrap_detail_sertifikat">
  <div class="container">

    <div class="sertifikat_detail">

      <?php if (has_post_thumbnail()) : ?>
        <div class="sertifikat_image">
          <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
        </div>
      <?php endif; ?>

      <div class="sertifikat_content">
        <span class="sertifikat_date">
          <?php echo get_the_date('d M Y'); ?>
        </span>

        <h1><?php the_title(); ?></h1>

        <div class="sertifikat_desc">
          <?php the_content(); ?>
        </div>

      </div>

    </div>

  </div>
</section>

<?php get_footer(); ?>