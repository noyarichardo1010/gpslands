<section class="wrap_career">
  <div class="container">
    
    <?php
    $args = [
      'post_type'      => 'job-center',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC'
    ];

    $jobs = new WP_Query($args);

    if ($jobs->have_posts()) :
    ?>

    <div class="accordion career_accordion" id="careerAccordion">

      <?php 
      $i = 0;
      while ($jobs->have_posts()) : $jobs->the_post();
        $i++;

        $location = get_field('location');
        $status   = get_field('status_employee');
        $excerpt  = get_the_excerpt();

        $is_first = ($i === 1);
      ?>

      <div class="accordion-item career_item">

        <!-- HEADER -->
        <h2 class="accordion-header" id="heading<?php echo $i; ?>">
          <button 
            class="accordion-button career_button <?php echo $is_first ? '' : 'collapsed'; ?>" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#collapse<?php echo $i; ?>"
            aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
            aria-controls="collapse<?php echo $i; ?>"
          >

            <div class="career_header_content">
              <div class="career_title">
                <h3><?php the_title(); ?></h3>
                <p class="career_excerpt">
                  <?php echo esc_html($excerpt); ?>
                </p>
              </div>
            </div>

          </button>
        </h2>

        <!-- CONTENT -->
        <div 
          id="collapse<?php echo $i; ?>" 
          class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
          aria-labelledby="heading<?php echo $i; ?>"
          data-bs-parent="#careerAccordion"
        >
          <div class="accordion-body career_body">

            <?php the_content(); ?>
            
            <!-- META -->
            <div class="career_meta mb-3">
              <?php if ($location): ?>
                <span class="career_badge">
                  <i class="fas fa-map-marker-alt"></i>
                  <?php echo esc_html($location); ?>
                </span>
              <?php endif; ?>

              <?php if ($status): ?>
                <span class="career_badge">
                  <i class="fas fa-clock"></i>
                  <?php echo esc_html($status); ?>
                </span>
              <?php endif; ?>
            </div>
            
            <button 
            class="btn btn-warning mt-3 open-cv-modal"
            data-job-id="<?php echo get_the_ID(); ?>"
            data-job-title="<?php echo esc_attr(get_the_title()); ?>"
            >
            Kirim CV
            </button>

          </div>
        </div>

      </div>

      <?php endwhile; ?>

    </div>

    <?php 
    wp_reset_postdata();
    endif; 
    ?>

  </div>
</section>


<!-- modal cv -->
<div class="modal_karir modal fade" id="cvModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content cv-modal-content">

      <!-- CLOSE BUTTON -->
      <button type="button" class="cv-close" data-bs-dismiss="modal">
        <i class="fas fa-times"></i>
      </button>

      <div class="modal-body text-center">

        <h2 class="cv-title">Unggah CV Anda</h2>
        <p class="cv-subtitle">
          Silakan unggah CV terbaru Anda dengan klik tombol Unggah atau cukup drag & drop ke area di bawah ini.
        </p>

        <form id="cvUploadForm" enctype="multipart/form-data">

          <input type="hidden" name="job_id" id="cv_job_id">

          <div class="cv-drop-area" id="cvDropArea">
            
            <p id="cvFileText">
              Harap unggah dokumen dalam format PDF atau DOC/DOCX<br>maksimal 2Mb
            </p>

            <button type="button" class="btn btn-outline-secondary" id="cvSelectBtn">
              Unggah
            </button>

            <input 
            type="file" 
            name="cv_file" 
            id="cvFileInput" 
            accept=".pdf,.doc,.docx"
            hidden
            >

          </div>
          <div class="g-recaptcha mt-3" data-sitekey="6LeBJXMsAAAAAMjmMP08AT8vFL2VnwoqzYyMKSGd"></div>
            <button type="submit" class="btn btn-warning cv-submit-btn">
                <span class="btn-text">Kirim Lamaran</span>
                <i class="fas fa-spinner fa-spin ms-2 d-none" id="cvLoadingIcon"></i>
            </button>

        </form>

      </div>

    </div>
  </div>
</div>