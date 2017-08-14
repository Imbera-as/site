<?php

namespace ResponsiveMenuPro\Factories;
use ResponsiveMenuPro\Mappers\ScssBaseMapper;
use ResponsiveMenuPro\Mappers\ScssButtonMapper;
use ResponsiveMenuPro\Mappers\ScssMenuMapper;
use ResponsiveMenuPro\Mappers\ScssHeaderBarMapper;
use ResponsiveMenuPro\Mappers\ScssSingleMenuMapper;
use ResponsiveMenuPro\Formatters\Minify;
use ResponsiveMenuPro\Collections\OptionsCollection;

class CssFactory {

  public function __construct(Minify $minifier, ScssBaseMapper $base, ScssButtonMapper $button, ScssMenuMapper $menu, ScssHeaderBarMapper $header_bar, ScssSingleMenuMapper $single_menu) {
    $this->minifier = $minifier;
    $this->base = $base;
    $this->button = $button;
    $this->menu = $menu;
    $this->header_bar = $header_bar;
    $this->single_menu = $single_menu;
  }

  public function build(OptionsCollection $options) {

    $css =  $this->base->map($options) . $this->button->map($options) . $this->menu->map($options);

    if($options['use_header_bar'] == 'on')
      $css .= $this->header_bar->map($options);

    if($options['use_single_menu'] == 'on')
      $css .= $this->single_menu->map($options);

    $ios = '
      .responsive-menu-pro-open #responsive-menu-pro-noscroll-wrapper {
        -webkit-overflow-scrolling: auto;
      }
      #responsive-menu-pro-noscroll-wrapper {
        -webkit-overflow-scrolling: touch;
      } ';

    $css .= $ios . $options['custom_css'];

    if($options['minify_scripts'] == 'on')
      $css = $this->minifier->minify($css);

    return $css;

  }

}
