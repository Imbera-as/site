<?php

namespace ResponsiveMenuPro\ViewModels\Components;
use ResponsiveMenuPro\Translation\Translator;

class ComponentFactory {

  public function build($key) {

    $components = [
      'title' => 'ResponsiveMenuPro\ViewModels\Components\Menu\Title',
      'menu' => 'ResponsiveMenuPro\ViewModels\Components\Menu\Menu',
      'search' => 'ResponsiveMenuPro\ViewModels\Components\Menu\Search',
      'additional content' => 'ResponsiveMenuPro\ViewModels\Components\Menu\AdditionalContent'
    ];

    return new $components[$key](new Translator);

  }

}
