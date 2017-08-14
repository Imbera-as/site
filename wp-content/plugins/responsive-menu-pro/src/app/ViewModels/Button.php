<?php

namespace ResponsiveMenuPro\ViewModels;
use ResponsiveMenuPro\ViewModels\Components\Button\Button as ButtonComponent;
use ResponsiveMenuPro\Collections\OptionsCollection;

class Button {

  public function __construct(ButtonComponent $component) {
      $this->component = $component;
  }

  public function getHtml(OptionsCollection $options) {
      return $this->component->render($options);
  }

}
