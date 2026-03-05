<?php
class Bootstrap_Navwalker extends Walker_Nav_Menu {

  // START LEVEL
  function start_lvl( &$output, $depth = 0, $args = null ) {
    $indent = str_repeat("\t", $depth);

    if ($depth === 0) {
        $output .= '<ul class="dropdown-menu">';
      } else {
        $output .= '<ul class="dropdown-menu dropdown-submenu">';
      }      
  }

  // START ELEMENT
  function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $classes = empty($item->classes) ? [] : (array) $item->classes;
    $has_children = in_array('menu-item-has-children', $classes);
    
    $li_class = 'nav-item';
    if ($has_children && $depth === 0) {
      $li_class .= ' dropdown';
    }
    

    $output .= "$indent<li class=\"$li_class\">";

    // A class
    if ($depth === 0) {
      $a_class = 'nav-link';
    } else {
      $a_class = 'dropdown-item';
    }

    if ($has_children) {
      $a_class .= ' dropdown-toggle';
    }

    $atts  = ' class="' . esc_attr($a_class) . '"';
    $atts .= ' href="' . esc_url($item->url) . '"';

    if ($has_children) {
      $atts .= ' data-bs-toggle="dropdown"';
    }

    $output .= '<a' . $atts . '>';
    $output .= esc_html($item->title);
    $output .= '</a>';
  }
}
