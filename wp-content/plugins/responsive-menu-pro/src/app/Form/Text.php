<?php

namespace ResponsiveMenuPro\Form;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Form\FormComponent;

class Text implements FormComponent {

	public function render(Option $option) {
		return "<input type='text' class='text' id='{$option->getName()}' name='menu[{$option->getName()}]' value='" . htmlentities($option->getValue(), ENT_QUOTES) . "' />";
	}

}
