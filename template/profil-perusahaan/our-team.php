<section class="wrap_our_team">
  <div class="container">

    <?php
  
    $page = get_page_by_path('profil-perusahaan/our-team');

    if ($page) {
      echo '<div class="team_header">';
      echo apply_filters('the_content', $page->post_content);
      echo '</div>';
    }

    $args = [
      'post_type'      => 'our-team',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC'
    ];

    $team = new WP_Query($args);

    if ($team->have_posts()) :

      $count = 0;
    ?>

      <div class="row justify-content-center team_row_top mb-5">
        <?php while ($team->have_posts()) : $team->the_post();
          $count++;
          if ($count > 2) break;

          $photo      = get_field('profile_photo');
          $position   = get_field('position');
          $specialist = get_field('specialist');
        ?>
          <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="team_card large">
              <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php the_title(); ?>">
              <div class="team_overlay">
                <h3><?php the_title(); ?></h3>
                <span class="position"><?php echo esc_html($position); ?></span>
                <p class="specialist"><?php echo esc_html($specialist); ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <?php
      wp_reset_postdata();

      // Query
      $team = new WP_Query($args);
      $count = 0;
      ?>

      <div class="row team_row_bottom">
        <?php while ($team->have_posts()) : $team->the_post();
          $count++;
          if ($count <= 2) continue;

          $photo      = get_field('profile_photo');
          $position   = get_field('position');
          $specialist = get_field('specialist');
        ?>
          <div class="col-lg-3 col-md-4 col-12 mb-4">
            <div class="team_card">
              <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php the_title(); ?>">
              <div class="team_overlay">
                <h4><?php the_title(); ?></h4>
                <span class="position"><?php echo esc_html($position); ?></span>
                <p class="specialist"><?php echo esc_html($specialist); ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

    <?php endif; wp_reset_postdata(); ?>

  </div>
</section>