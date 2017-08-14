<?php

namespace ResponsiveMenuPro\View;
use ResponsiveMenuPro\Factories\CssFactory;
use ResponsiveMenuPro\Factories\JsFactory;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\ViewModels\Menu;
use ResponsiveMenuPro\ViewModels\Button;
use ResponsiveMenuPro\ViewModels\HeaderBar;

class FrontView implements View {

  public function __construct(JsFactory $js, CssFactory $css) {
    $this->js = $js;
    $this->css = $css;
  }

	public function render($location, $l = []) {
    add_action('wp_footer', function() use ($location, $l) {
      include dirname(dirname(dirname(__FILE__))) . '/views/' . $location . '.phtml';
    });
	}

	public function make($location, $l = []) {
    ob_start();
      include dirname(dirname(dirname(__FILE__))) . '/views/' . $location . '.phtml';
      $output = ob_get_contents();
    ob_end_clean();
    return $output;
	}

  public function echoOrIncludeScripts(OptionsCollection $options) {

    $css = $this->css->build($options);
    $js = $this->js->build($options);

    add_filter('body_class', function($classes) use($options) {
      $classes[] = 'responsive-menu-pro-' . $options['animation_type'] . '-' . $options['menu_appear_from'];
      return $classes;
    });

    wp_enqueue_script('jquery');

    if($options->usesFontIcons())
      wp_enqueue_script('responsive-menu-pro-font-awesome', 'https://use.fontawesome.com/b6bedb3084.js', null, null);

    if($options['external_files'] == 'on') :
      $data_folder_dir = plugins_url(). '/responsive-menu-pro-data';
      $css_file = $data_folder_dir . '/css/responsive-menu-pro-' . get_current_blog_id() . '.css';
      $js_file = $data_folder_dir . '/js/responsive-menu-pro-' . get_current_blog_id() . '.js';
      wp_enqueue_style('responsive-menu-pro', $css_file, null, false);
      wp_enqueue_script('responsive-menu-pro', $js_file, ['jquery'], false, $options['scripts_in_footer'] == 'on' ? true : false);
    else :
      add_action('wp_head', function() use ($css) {
        echo '<style>' . $css . '</style>';
      }, 100);
      add_action($options['scripts_in_footer'] == 'on' ? 'wp_footer' : 'wp_head', function() use ($js) {
        echo '<script>' . $js . '</script>';
      }, 100);
    endif;
  }

  public function addShortcode($options, HeaderBar $header_bar, Button $button, Menu $menu) {

    add_shortcode('responsive_menu_pro', function($atts) use($options, $header_bar, $button, $menu) {

      if($atts)
        array_walk($atts, function($a, $b) use ($options) { $options[$b]->setValue($a); });

      $html = '';

      $html .= $options['use_header_bar'] == 'on' ? $this->make('header_bar', ['options' => $options, 'header' => $header_bar->getHtml($options)]) : '';
      $html .= $this->make('button', ['options' => $options, 'button' => $button->getHtml($options)]);
      return $html . $this->make('menu', ['options' => $options, 'menu' => $menu->getHtml($options)]);

    });

  }

  public function isMobile() {
    return wp_is_mobile();
  }

}
