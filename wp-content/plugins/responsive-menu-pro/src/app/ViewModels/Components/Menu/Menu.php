<?php

namespace ResponsiveMenuPro\ViewModels\Components\Menu;
use ResponsiveMenuPro\ViewModels\Components\ViewComponent;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Walkers\WpWalker;
use ResponsiveMenuPro\Translation\Translator;

class Menu implements ViewComponent {

  public function __construct(Translator $translator) {
    $this->translator = $translator;
  }

  public function render(OptionsCollection $options) {

    $menu = $this->translator->translate($options['menu_to_use']);
    $walker = $options['custom_walker']->getValue();

    $output = wp_nav_menu(
      [
        'container' => '',
        'menu_id' => 'responsive-menu-pro',
        'menu_class' => null,
        'menu' => $menu && !$options['theme_location_menu']->getValue() ? $menu : null,
        'depth' => $options['menu_depth']->getValue() ? $options['menu_depth']->getValue() : 0,
        'theme_location' => $options['theme_location_menu']->getValue() ? $options['theme_location_menu']->getValue() : null,
        'walker' => $walker ? new $walker($options) : new WpWalker($options),
        'echo' => false
      ]
    );

    return $output;

  }

}
