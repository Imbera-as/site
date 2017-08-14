<?php

namespace ResponsiveMenuPro\Form;

class Reset {

	public function render() {
    return '<input type="submit" class="button submit" name="responsive_menu_pro_reset" value="' . __('Reset Options', 'responsive-menu-pro') . '" />';
	}

}
