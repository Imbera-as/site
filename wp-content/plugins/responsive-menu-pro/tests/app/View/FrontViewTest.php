<?php

namespace ResponsiveMenuPro\View;
use PHPUnit\Framework\Testcase;

class FrontViewTest extends TestCase {

  public function setUp() {
    $this->js_factory = $this->createMock('ResponsiveMenuPro\Factories\JsFactory');
    $this->css_factory = $this->createMock('ResponsiveMenuPro\Factories\CssFactory');
  }

  public function testSetup() {
    $front_view = new FrontView($this->js_factory, $this->css_factory);
    $this->assertInstanceOf('ResponsiveMenuPro\View\FrontView', $front_view);
  }

}
