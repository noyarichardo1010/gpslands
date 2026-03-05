<?php

// header menu
add_action('after_setup_theme', function () {
    register_nav_menus([
      'primary_menu' => __('Primary Menu', 'gps-theme'),
    ]);
});


// footer menu
function register_footer_menus() {
  register_nav_menus([
    'footer_menu_products'  => __('Footer Menu Products', 'gpslands'),
    'footer_menu_solutions' => __('Footer Menu Solutions', 'gpslands'),
    'footer_menu_company'   => __('Footer Menu Company', 'gpslands'),
  ]);
}
add_action('after_setup_theme', 'register_footer_menus');

// dropdown header menu
require get_template_directory() . '/inc/class-bootstrap-navwalker.php';

function gps_enqueue_assets() {

    /* Bootstrap CSS */
    wp_enqueue_style(
      'bootstrap-css',
      'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
      [],
      '5.3.2'
    );
  
    /* Font Awesome 5 */
    wp_enqueue_style(
      'fontawesome-5',
      'https://use.fontawesome.com/releases/v5.15.4/css/all.css',
      [],
      '5.15.4'
    );

    /* Theme Style */
    wp_enqueue_style(
      'gps-style',
      get_stylesheet_uri(),
      ['bootstrap-css', 'fontawesome-5'],
      '1.0'
    );
  
    /* Bootstrap JS */
    wp_enqueue_script(
      'bootstrap-js',
      'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
      [],
      '5.3.2',
      true
    );
  
  }
  add_action('wp_enqueue_scripts', 'gps_enqueue_assets');
  
//   Swipper JS Slide Carousel
function gps_enqueue_swiper() {

    // Swiper CSS
    wp_enqueue_style(
      'swiper-css',
      'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css',
      [],
      '12.0'
    );
  
    // Swiper JS
    wp_enqueue_script(
      'swiper-js',
      'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js',
      [],
      '12.0',
      true // FOOTER
    );
  
    // Init Swiper (custom)
    wp_enqueue_script(
      'swiper-init',
      get_template_directory_uri() . '/js/swiper-init.js',
      ['swiper-js'], // ← PENTING
      '1.0',
      true
    );
  }
  add_action('wp_enqueue_scripts', 'gps_enqueue_swiper');
  

//   google fonts
function gps_enqueue_google_fonts() {

    wp_enqueue_style(
      'google-font-roboto',
      'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
      [],
      null
    );

    wp_enqueue_style(
      'google-font-bebas-neue',
      'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap',
      [],
      null
    );
  
  }
add_action('wp_enqueue_scripts', 'gps_enqueue_google_fonts');


add_filter('allowed_block_types_all', function ($allowed_blocks, $editor_context) {
  return true; // allow ALL Gutenberg blocks
}, 10, 2);

// featured image gutenberg
add_theme_support('post-thumbnails', ['post', 'page']);
add_action('after_setup_theme', function () {
  add_theme_support('post-thumbnails');
});


function gpslands_theme_setup() {
  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  add_theme_support('align-wide');
}
add_action('after_setup_theme', 'gpslands_theme_setup');


// SVG UPload
function allow_svg_upload($mimes) {
  $mimes['svg']  = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');


// gallery slide
function gps_register_gallery_cpt() {
  register_post_type('gallery_slide', [
    'labels' => [
      'name'          => 'Gallery',
      'singular_name' => 'Gallery',
    ],
    'public'      => true,
    'menu_icon'   => 'dashicons-format-gallery',
    'supports'    => [
      'title',
      'editor',        // optional (caption)
      'thumbnail',     // cover image
      'page-attributes'
    ],
    'show_in_rest' => true,
  ]);
}
add_action('init', 'gps_register_gallery_cpt');

function gps_extract_images_from_blocks($blocks, &$results = []) {
  foreach ($blocks as $block) {

    if ($block['blockName'] === 'core/image' && !empty($block['attrs']['id'])) {

      $img_id = $block['attrs']['id'];
      $link   = null;
      $caption = '';

      $html = render_block($block);

      // ambil link
      if (preg_match('/<a[^>]+href=["\']([^"\']+)["\']/', $html, $matches)) {
        $link = $matches[1];
      }

      // ambil caption dari figcaption
      if (preg_match('/<figcaption[^>]*>(.*?)<\/figcaption>/', $html, $cap)) {
        $caption = wp_strip_all_tags($cap[1]);
      }

      $results[] = [
        'id'      => $img_id,
        'link'    => $link,
        'caption' => $caption
      ];
    }

    if (!empty($block['innerBlocks'])) {
      gps_extract_images_from_blocks($block['innerBlocks'], $results);
    }
  }

  return $results;
}



// Table Products

// Tambah kolom taxonomy di CPT our-products
add_filter('manage_our-products_posts_columns', function ($columns) {

  $new_columns = [];

  foreach ($columns as $key => $value) {
      $new_columns[$key] = $value;

      if ($key === 'title') {
          $new_columns['brand_products']      = 'Brand';
          $new_columns['product_category']    = 'Product Category';
          $new_columns['industry']         = 'Industry';
          $new_columns['type_products_gps']    = 'Type';
      }
  }

  return $new_columns;
});

add_action('manage_our-products_posts_custom_column', function ($column, $post_id) {

  $taxonomies = [
      'brand_products'   => 'brand-products',
      'product_category' => 'product-category',
      'industry'     => 'industry',
      'type_products_gps'=> 'type_products_gps',
  ];

  if (isset($taxonomies[$column])) {
      $terms = get_the_terms($post_id, $taxonomies[$column]);

      if (!empty($terms) && !is_wp_error($terms)) {
          echo esc_html(implode(', ', wp_list_pluck($terms, 'name')));
      } else {
          echo '—';
      }
  }

}, 10, 2);
add_filter('manage_edit-our-products_sortable_columns', function ($columns) {

  $columns['brand_products']       = 'brand-products';
  $columns['product_category']     = 'product-category';
  $columns['industry']              = 'industry';
  $columns['type_products_gps']     = 'type_products_gps';

  return $columns;
});

// Shortcode Gallery Slide by ID (NETRAL)
function gps_gallery_slide_shortcode($atts) {

  $atts = shortcode_atts([
    'id' => 0,
  ], $atts);

  $post_id = intval($atts['id']);
  if (!$post_id) return '';

  $content = get_post_field('post_content', $post_id);
  if (!$content) return '';

  $blocks = parse_blocks($content);
  $images = gps_extract_images_from_blocks($blocks);

  if (empty($images)) return '';

  ob_start();

  foreach ($images as $item) {
    $img = wp_get_attachment_image_src($item['id'], 'large');
    if (!$img) continue;
    ?>
      <div class="swiper-slide">
        <div class="slide-inner">
    
          <?php if (!empty($item['link'])) : ?>
            <a href="<?php echo esc_url($item['link']); ?>" rel="noopener">
              <img src="<?php echo esc_url($img[0]); ?>" alt="">
            </a>
          <?php else : ?>
            <img src="<?php echo esc_url($img[0]); ?>" alt="">
          <?php endif; ?>
    
          <?php if (!empty($item['caption'])) : ?>
            <div class="slide-caption-text">
              <?php echo esc_html($item['caption']); ?>
            </div>
          <?php endif; ?>
    
        </div>
      </div>
    <?php
    }
  
  return ob_get_clean();
}
add_shortcode('gps_gallery_slide', 'gps_gallery_slide_shortcode');


add_filter('manage_gallery_slide_posts_columns', function ($columns) {
  $columns['gallery_shortcode'] = 'Shortcode';
  return $columns;
});

add_action('manage_gallery_slide_posts_custom_column', function ($column, $post_id) {

  if ($column === 'gallery_shortcode') {
    echo '<code>[gps_gallery_slide id="' . esc_attr($post_id) . '"]</code>';
  }

}, 10, 2);



// Handle career GPS

add_action('wp_enqueue_scripts', function(){

  wp_enqueue_script(
      'career-script',
      get_stylesheet_directory_uri() . '/js/career.js',
      [],
      '1.0',
      true
  );

  wp_localize_script(
      'career-script',
      'career_ajax',
      ['ajax_url' => admin_url('admin-ajax.php')]
  );

});

// add_action('wp_enqueue_scripts', function() {
//   wp_localize_script(
//       'career-script',
//       'career_ajax',
//       ['ajax_url' => admin_url('admin-ajax.php')]
//   );
// });

// remove wp footer
function remove_footer_admin () {
  echo '';
}
add_filter('admin_footer_text', 'remove_footer_admin');


// Remove update notifications nag
remove_action('admin_notices', 'update_nag', 3);

// Hide plugin update count bubble
function remove_update_count(){
    global $menu;
    unset($menu[65]); // Plugins menu
}
add_action('admin_menu', 'remove_update_count');

// Disable automatic update emails
add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );


// Languange Switcher
function gpslands_enqueue_lang_script() {

  wp_enqueue_script(
      'gpslands-lang', 
      get_template_directory_uri() . '/js/lang.js',
      array(), 
      '1.0.0', 
      true 
  );

}
add_action('wp_enqueue_scripts', 'gpslands_enqueue_lang_script');

function gpslands_enqueue_custom_styles() {

  // Responsive CSS
  wp_enqueue_style(
      'gpslands-responsive',
      get_template_directory_uri() . '/css/responsive.css',
      array('gps-style'), // load setelah main style
      filemtime(get_template_directory() . '/css/responsive.css')
  );

  // Animation CSS
  wp_enqueue_style(
      'gpslands-animation',
      get_template_directory_uri() . '/css/animation.css',
      array('gps-style'),
      filemtime(get_template_directory() . '/css/animation.css')
  );

}
add_action('wp_enqueue_scripts', 'gpslands_enqueue_custom_styles');

// function gpslands_enqueue_animation_script() {

//   wp_enqueue_script(
//       'gpslands-animation',
//       get_stylesheet_directory_uri() . '/js/animation.js',
//       array(),
//       filemtime(get_stylesheet_directory() . '/js/animation.js'),
//       true
//   );

// }
// add_action('wp_enqueue_scripts', 'gpslands_enqueue_animation_script');

// vendor animation
function gpslands_enqueue_aos() {

  wp_enqueue_style(
      'aos-css',
      'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css',
      array(),
      '2.3.4'
  );

  wp_enqueue_script(
      'aos-js',
      'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js',
      array(),
      '2.3.4',
      true
  );

  wp_add_inline_script(
      'aos-js',
      'document.addEventListener("DOMContentLoaded", function(){ AOS.init({ duration: 800, once: true }); });'
  );

}
add_action('wp_enqueue_scripts', 'gpslands_enqueue_aos');


// Redirect wp-admin
// Redirect after login
function custom_login_redirect($redirect_to, $request, $user) {

  if (isset($user->roles) && is_array($user->roles)) {

      // Jika admin
      if (in_array('administrator', $user->roles)) {
          return admin_url('upload.php');
      }

      // Jika editor
      if (in_array('editor', $user->roles)) {
          return admin_url('upload.php');
      }

  }

  return $redirect_to;
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);
// Redirect dashboard to media page
function redirect_dashboard_to_media() {
  global $pagenow;

  if (is_admin() && $pagenow == 'index.php') {
      wp_redirect(admin_url('upload.php'));
      exit;
  }
}
add_action('admin_init', 'redirect_dashboard_to_media');

// disable email notif
// add_filter( 'auto_plugin_update_send_email', '__return_false' );