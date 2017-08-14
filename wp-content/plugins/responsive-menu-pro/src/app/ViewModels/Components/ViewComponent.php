<?php

namespace ResponsiveMenuPro\ViewModels\Components;

use ResponsiveMenuPro\Collections\OptionsCollection as OptionsCollection;

interface ViewComponent {

  public function render(OptionsCollection $collection);

}
