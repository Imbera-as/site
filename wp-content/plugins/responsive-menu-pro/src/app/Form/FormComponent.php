<?php

namespace ResponsiveMenuPro\Form;
use ResponsiveMenuPro\Models\Option;

interface FormComponent {
  public function render(Option $option);
}
