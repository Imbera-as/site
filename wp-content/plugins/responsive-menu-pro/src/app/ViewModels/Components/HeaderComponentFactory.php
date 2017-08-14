<?php

namespace ResponsiveMenuPro\ViewModels\Components;
use ResponsiveMenuPro\Translation\Translator;

class HeaderComponentFactory {

  public function build($key) {

    $components = [
      'logo' => 'ResponsiveMenuPro\ViewModels\Components\Header\Logo',
      'title' => 'ResponsiveMenuPro\ViewModels\Components\Header\Title',
      'search' => 'ResponsiveMenuPro\ViewModels\Components\Header\Search',
      'html content' => 'ResponsiveMenuPro\ViewModels\Components\Header\HtmlContent'
    ];

    return new $components[$key](new Translator);

  }

}
