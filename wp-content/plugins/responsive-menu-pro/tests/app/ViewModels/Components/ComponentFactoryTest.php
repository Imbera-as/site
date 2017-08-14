<?php

use PHPUnit\Framework\TestCase;

class ComponentFactoryTest extends TestCase {

  public function setUp() {
    $this->factory = new ResponsiveMenuPro\ViewModels\Components\ComponentFactory;
  }

  public function testMapTitle() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Menu\Title', $this->factory->build('title'));
  }

  public function testMapMenu() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Menu\Menu', $this->factory->build('menu'));
  }

  public function testMapSearch() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Menu\Search', $this->factory->build('search'));
  }

  public function testMapAdditionalContent() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Menu\AdditionalContent', $this->factory->build('additional content'));
  }

}
