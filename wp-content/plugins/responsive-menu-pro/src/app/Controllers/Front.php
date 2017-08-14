<?php

namespace ResponsiveMenuPro\Controllers;
use ResponsiveMenuPro\Services\OptionService;
use ResponsiveMenuPro\View\View;
use ResponsiveMenuPro\ViewModels\Menu;
use ResponsiveMenuPro\ViewModels\Button;
use ResponsiveMenuPro\ViewModels\HeaderBar;

class Front {

  public function __construct(OptionService $service, View $view, Menu $menu, Button $button, HeaderBar $header) {
    $this->service = $service;
    $this->view = $view;
    $this->menu = $menu;
    $this->button = $button;
    $this->header = $header;
  }

	public function index() {

    $options = $this->service->all();

    if($options['mobile_only'] == 'on' && !$this->view->isMobile())
      return;

    return $this->buildFrontEndFromOptions($options);

	}

  public function preview($options) {

    $options['external_files'] = 'off';
    $options = $this->service->buildFromPostArray($options);

    return $this->buildFrontEndFromOptions($options);

  }

  private function buildFrontEndFromOptions($options) {

    $this->view->echoOrIncludeScripts($options);

    if($options['shortcode'] == 'off'):
      if($options['use_header_bar'] == 'on')
        $this->view->render('header_bar', ['options' => $options, 'header' => $this->header->getHtml($options)]);
      $this->view->render('button', ['options' => $options, 'button' => $this->button->getHtml($options)]);
      return $this->view->render('menu', ['options' => $options, 'menu' => $this->menu->getHtml($options)]);
    else:
      return $this->view->addShortcode($options, $this->header, $this->button, $this->menu);
    endif;

  }

}
