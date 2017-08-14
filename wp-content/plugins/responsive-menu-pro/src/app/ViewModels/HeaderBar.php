<?php

namespace ResponsiveMenuPro\ViewModels;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\ViewModels\Components\HeaderComponentFactory;

class HeaderBar {

  public function __construct(HeaderComponentFactory $factory) {
      $this->factory = $factory;
  }

  public function getHtml(OptionsCollection $options) {
    $content = '';

    foreach(json_decode($options['header_bar_items_order']) as $key => $val)
      if($val == 'on' && $key != 'button')
        $content .= $this->factory->build($key)->render($options);

    return $content;
  }

}
