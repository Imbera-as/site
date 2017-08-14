<?php

namespace ResponsiveMenuPro\ViewModels\Components\Header;
use ResponsiveMenuPro\ViewModels\Components\ViewComponent;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Translation\Translator;

class HtmlContent implements ViewComponent {

  public function __construct(Translator $translator) {
    $this->translator = $translator;
  }

  public function render(OptionsCollection $options) {

    return '<div id="responsive-menu-pro-header-bar-html" class="responsive-menu-pro-header-bar-item responsive-menu-pro-header-box">' .
              $this->translator->allowShortcode($options['header_bar_html_content']) .
            '</div>';

  }

}
