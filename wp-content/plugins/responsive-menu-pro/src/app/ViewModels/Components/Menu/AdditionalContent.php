<?php

namespace ResponsiveMenuPro\ViewModels\Components\Menu;
use ResponsiveMenuPro\ViewModels\Components\ViewComponent;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Translation\Translator;

class AdditionalContent implements ViewComponent {

  public function __construct(Translator $translator) {
    $this->translator = $translator;
  }

  public function render(OptionsCollection $options) {

    $content = $this->translator->translate($options['menu_additional_content']);

    if($content)
      return '<div id="responsive-menu-pro-additional-content">' . $this->translator->allowShortcode($content) . '</div>';

  }

}
