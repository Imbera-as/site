<?php

use PHPUnit\Framework\TestCase;

class HeaderComponentFactoryTest extends TestCase {

  public function setUp() {
    $this->factory = new ResponsiveMenuPro\ViewModels\Components\HeaderComponentFactory;
  }

  public function testMapLogo() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Header\Logo', $this->factory->build('logo'));
  }

  public function testMapSearch() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Header\Search', $this->factory->build('search'));
  }

  public function testMapHtmlContent() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Header\HtmlContent', $this->factory->build('html content'));
  }

  public function testMapTitle() {
      $this->assertInstanceOf('ResponsiveMenuPro\ViewModels\Components\Header\Title', $this->factory->build('title'));
  }

}
