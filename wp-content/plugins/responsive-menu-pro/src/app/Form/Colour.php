<?php

namespace ResponsiveMenuPro\Form;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Form\FormComponent;

class Colour implements FormComponent {

	public function render(Option $option) {
		return "<input type='text' class='colour wp-color-picker' id='{$option->getName()}' name='menu[{$option->getName()}]' value='{$option->getValue()}' />";
	}

}
