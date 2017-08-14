<?php

namespace ResponsiveMenuPro\ViewModels\Components\Menu;
use ResponsiveMenuPro\ViewModels\Components\ViewComponent;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Translation\Translator;

class Search implements ViewComponent {

  public function __construct(Translator $translator) {
    $this->translator = $translator;
  }

  public function render(OptionsCollection $options) {

      return '<div id="responsive-menu-pro-search-box">
        <form action="'.$this->translator->searchUrl().'" class="responsive-menu-pro-search-form" role="search">
          <input type="search" name="s" placeholder="' . $this->translator->translate($options['menu_search_box_text']) . '" class="responsive-menu-pro-search-box">
        </form>
      </div>';

  }

}
