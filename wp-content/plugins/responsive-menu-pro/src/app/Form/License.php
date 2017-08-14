<?php

namespace ResponsiveMenuPro\Form;

class License {

	public function render() {

    $license_key = trim(get_option('responsive_menu_pro_license_key'));
    $license_type = get_option('responsive_menu_pro_license_type');
    $response = wp_remote_get('https://responsive.menu?' . http_build_query([
        'edd_action'=> 'check_license',
        'license' 	=> $license_key,
        'item_name' => urlencode('Responsive Menu Pro - ' . $license_type)
    ]), ['decompress' => false]);
    if(!is_wp_error($response)):
      $response = json_decode($response['body']);
      $is_valid = $response->license == 'valid' ? true : false;
      $error = __('Invalid key', 'responsive-menu-pro');
    else:
      $error = $response->get_error_message();
      $is_valid = false;
    endif;

		$output = '<input type="password" name="menu[responsive_menu_pro_license_key]" value="' . $license_key . '" />';
    $output .= '<input class="button" type="submit" name="responsive_menu_pro_add_license_key" value="' . __('Add License Key', 'responsive-menu-pro') . '" />';
    $output .= $is_valid ? '<span class="license-check license-valid">' . __('Valid', 'responsive-menu-pro') . ' ' . $license_type . '</span>' : '<span class="license-check license-invalid">' . $error . '</span>';
    return $output;
  }

}
