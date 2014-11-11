<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

/**
 * Implements hook_process_zone().
 */
function simpler_process_zone(&$vars) {
  $theme = alpha_get_theme();

  if ($vars['elements']['#zone'] == 'content') {
    $vars['title_prefix'] = $theme->page['title_prefix'];
    $vars['title'] = $theme->page['title'];
    $vars['title_suffix'] = $theme->page['title_suffix'];
    $vars['title_hidden'] = $theme->page['title_hidden'];
  }
}
/**
 * Implements hook_preprocess_node().
 */
function simpler_preprocess_node(&$vars) {
  if (!empty($vars['preprocess_fields']) && in_array('blog_date', $vars['preprocess_fields'])) {
    $vars['blog_date'] = '<div class="blog-date">';
    $vars['blog_date'] .= '<div class="day">' . format_date($vars['node']->created, 'custom', 'd') . '</div>';
    $vars['blog_date'] .= '<div class="month">' . format_date($vars['node']->created, 'custom', 'M') . '</div>';
    $vars['blog_date'] .= '<div class="year">' . format_date($vars['node']->created, 'custom', 'Y') . '</div>';
    $vars['blog_date'] .= '</div>';
  }
  if (!empty($vars['preprocess_fields']) && in_array('comment_count', $vars['preprocess_fields'])) {
    $vars['comment_count'] = '<div class="comment-count">' . $vars['node']->comment_count . ' ' . format_plural($vars['node']->comment_count, 'comment', 'comments') . '</div>';
  }
   if ($vars['node']->type == 'portfolio' && !empty($vars['content']['field_portfolio_link'])) {
    $theme = alpha_get_theme();
    $portfolio_link_copy = $vars['content']['field_portfolio_link'];
    $theme->page['title_suffix'] = drupal_render($portfolio_link_copy);
  }
} 