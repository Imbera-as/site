<?php

namespace ResponsiveMenuPro\Controllers;
use ResponsiveMenuPro\View\View;
use ResponsiveMenuPro\Services\OptionService;

class Admin {

  public function __construct(OptionService $service, View $view) {
		$this->service = $service;
		$this->view = $view;
	}

	public function update($default_options, $new_options) {

    update_option('responsive_menu_pro_current_page', $new_options['responsive_menu_pro_current_page']);
    unset($new_options['responsive_menu_pro_current_page']);

    $updated_options = $this->service->combineOptions($default_options, $new_options);
    return $this->view->render('main', [
      'options' => $this->service->updateOptions($updated_options),
      'flash' => ['success' =>  __('Responsive Menu Options Updated Successfully', 'responsive-menu-pro')]
    ]);
	}

	public function reset($default_options) {
    return $this->view->render('main', [
      'options' => $this->service->updateOptions($default_options),
      'flash' => ['success' => __('Responsive Menu Options Reset Successfully', 'responsive-menu-pro')]
    ]);
	}

  public function index() {
    return $this->view->render('main', ['options' => $this->service->all()]);
  }

  public function import($default_options, $imported_options) {
    if(!empty($imported_options)):
      unset($imported_options['button_click_trigger']);
      $updated_options = $this->service->combineOptions($default_options, $imported_options);
      $options = $this->service->updateOptions($updated_options);
      $flash['success'] = __('Responsive Menu Options Imported Successfully', 'responsive-menu-pro');
    else:
      $flash['errors'][] = __('No file selected', 'responsive-menu-pro');
      $options = $this->service->all();
    endif;

    return $this->view->render('main', ['options' => $options, 'flash' => $flash]);
  }

  public function export() {
    $this->view->noCacheHeaders();
    $final = [];
    foreach($this->service->all()->all() as $option)
      $final[$option->getName()] = $option->getValue();
    $this->view->display(json_encode($final));
    $this->view->stopProcessing();
  }

  public function addLicense() {
    if(!isset($_POST['menu']['responsive_menu_pro_license_key'])):
      $flash['errors'][] = __('No license key added', 'responsive-menu-pro');
    else:
      /*
      First Check The Single License */
      $license_key = trim($_POST['menu']['responsive_menu_pro_license_key']);
      $response = wp_remote_get('https://responsive.menu?' . http_build_query(
        [
          'edd_action'=> 'activate_license',
          'license' 	=> $license_key,
          'item_name' => urlencode('Responsive Menu Pro - Single License'),
          'url'       => home_url()
        ]
      ), ['decompress' => false]);
      $license_type = 'Single License';

      if(is_wp_error($response))
        $flash['errors'] = [$response->get_error_message()];
      else
        $response = json_decode($response['body']);

      /*
      Parse Result */
      if(!isset($response->success) || !$response->success):
        /*
        Now Check The Multi License */
        $response = wp_remote_get('https://responsive.menu?' . http_build_query(
          [
            'edd_action'=> 'activate_license',
            'license' 	=> $license_key,
            'item_name' => urlencode('Responsive Menu Pro - Multi License'),
            'url'       => home_url()
          ]
        ), ['decompress' => false]);
        $license_type = 'Multi License';
        if(is_wp_error($response))
          $flash['errors'] = [$response->get_error_message()];
        else
          $response = json_decode($response['body']);
      endif;

      if(isset($response->success) && $response->success):
        update_option('responsive_menu_pro_license_type', $license_type);
        $flash['errors'] = null;
        $flash['success'] = __('License key updated', 'responsive-menu-pro');
      else:
        update_option('responsive_menu_pro_license_type', '');
        if(!is_wp_error($response))
          $flash['errors'][] = __('License key invalid', 'responsive-menu-pro');
      endif;
      update_option('responsive_menu_pro_license_key', $license_key);
    endif;

    $this->view->render('main', ['options' => $this->service->all(), 'flash' => $flash]);

  }

}
