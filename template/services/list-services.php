<section class="wrap-services-gps-section-gen">

<div class="container">
    <div class="btn_cat_services">
        <?php
        $btn_query = new WP_Query([
        'post_type'      => 'services_gps',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
        ]);

        if ($btn_query->have_posts()):
        while ($btn_query->have_posts()): $btn_query->the_post();
            $slug = get_post_field('post_name', get_the_ID());
        ?>
            <a href="#service-<?php echo esc_attr($slug); ?>">
                <?php the_title(); ?>
            </a>
        <?php
        endwhile;
        wp_reset_postdata();
        endif;
        ?>
    </div>
</div>


<?php
$args = [
  'post_type'      => 'services_gps',
  'posts_per_page' => -1,
  'post_status'    => 'publish'
];

$query = new WP_Query($args);
$index = 0;

if ($query->have_posts()) :
while ($query->have_posts()) : $query->the_post();
$index++;

$post_id = get_the_ID();
$image   = get_the_post_thumbnail_url($post_id,'large');

/* background class */
$bg_class = ($index % 2 == 1) ? 'left_side_background' : 'right_side_background';

/* row reverse */
$is_reverse = ($index % 2 == 0);

/* row class */
$row_side_class = ($index % 2 == 1) ? 'left_side_row' : 'right_side_row';

/* image class */
$image_side_class = ($index % 2 == 1) ? 'left_side' : 'right_side';

$clients  = get_field('client_gallery', $post_id);
$projects = get_field('project_gallery', $post_id);
$post_slug = get_post_field('post_name', $post_id);
?>

<section id="service-<?php echo esc_attr($post_slug); ?>"  class="wrap-services-gps-section <?php echo $bg_class; ?>">
  <div class="container">

    <div class="row align-items-center mb-5 service-row <?php echo $is_reverse ? 'flex-lg-row-reverse' : ''; ?> <?php echo $row_side_class; ?>">

      <!-- IMAGE -->
      <div class="col-lg-6">
        <div class="service-image <?php echo $image_side_class; ?>">
          <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
        </div>
      </div>

      <!-- TEXT -->
      <div class="col-lg-6">
        <div class="service-content">
          <h2 class="service-title"><?php the_title(); ?></h2>
          <div class="service-desc"><?php the_content(); ?></div>
        </div>
      </div>

    </div>

    <?php if ($clients): ?>
    <div class="client-section">
      <h3 class="section-title">Klien & Dokumentasi</h3>

      <div class="swiper trusted-swiper-client" id="client-swiper-<?php echo $post_id; ?>">
        <div class="swiper-wrapper">
          <?php foreach ($clients as $img): 
            $image_id  = $img['id'];
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          ?>
          <div class="swiper-slide client-logo">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
          </div>
          <?php endforeach; ?>
        </div>
        <div class="swiper-pagination client-pagination-<?php echo $post_id; ?>"></div>
      </div>
    </div>
    <?php endif; ?>

    <?php if ($projects): ?>
    <div class="project-section mt-1">
      <div class="swiper project-swiper-client" id="project-swiper-<?php echo $post_id; ?>">
        <div class="swiper-wrapper">
          <?php foreach ($projects as $img):
            $image_id  = $img['id'];
            $image_url = wp_get_attachment_image_url($image_id, 'large');
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          ?>
          <div class="swiper-slide project-item">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
          </div>
          <?php endforeach; ?>
        </div>
        <div class="swiper-pagination project-pagination-<?php echo $post_id; ?>"></div>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php
endwhile;
wp_reset_postdata();
endif;
?>
</section>