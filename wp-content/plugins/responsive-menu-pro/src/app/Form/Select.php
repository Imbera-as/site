<?php

namespace ResponsiveMenuPro\Form;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Form\FormComponent;

class Select {

	public function render(Option $option, array $select_data) {

    $html = "<div class='select-style'><select class='select' name='menu[{$option->getName()}]' id='{$option->getName()}'>";
    foreach($select_data as $data) :
      $selected = $option->getValue() == $data['value'] ? " selected='selected'" : '';
      $html .= "<option value='{$data['value']}'{$selected}>{$data['display']}</option>";
    endforeach;
    $html .= "</select></div>";
    return $html;
	}

}
