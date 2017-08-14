<?php

namespace ResponsiveMenuPro\Form;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Form\FormComponent;

class TextArea implements FormComponent {

	public function render(Option $option) {
		return "<textarea class='textarea' id='{$option->getName()}' name='menu[{$option->getName()}]'>{$option->getValue()}</textarea>";
	}

}
