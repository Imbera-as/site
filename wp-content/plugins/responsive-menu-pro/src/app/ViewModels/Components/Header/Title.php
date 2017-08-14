<?php

namespace ResponsiveMenuPro\ViewModels\Components\Header;
use ResponsiveMenuPro\ViewModels\Components\ViewComponent;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Translation\Translator;

class Title implements ViewComponent {

  public function __construct(Translator $translator) {
    $this->translator = $translator;
  }

  public function render(OptionsCollection $options) {

    $link = $this->translator->translate($options['header_bar_logo_link']);

    if($options['header_bar_title']->getValue()):
      $content = '<div id="responsive-menu-pro-header-bar-title" class="responsive-menu-pro-header-bar-item responsive-menu-pro-header-box">';
      $content .= $link ? '<a href="' . $link . '">' : '';
      $content .= $options['header_bar_title'];
      $content .= $link ? '</a>' : '';
      $content .= '</div>';

      return $content;
    endif;

  }

}
