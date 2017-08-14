<?php

namespace ResponsiveMenuPro\Form;

class Export {

	public function render() {
		return '<input type="submit" class="button submit" name="responsive_menu_pro_export" value="' . __('Export Options', 'responsive-menu-pro') . '" />';
	}

}
