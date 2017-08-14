<?php

namespace ResponsiveMenuPro\ViewModels;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\ViewModels\Components\ComponentFactory;

class Menu {

  public function __construct(ComponentFactory $factory) {
      $this->factory = $factory;
  }

  public function getHtml(OptionsCollection $options) {
    $content = '';

    foreach(json_decode($options['items_order']) as $key => $val)
      if($val == 'on')
        $content .= $this->factory->build($key)->render($options);

    return $content;
  }

}
