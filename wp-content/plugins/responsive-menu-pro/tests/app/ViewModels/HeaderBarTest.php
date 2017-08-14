<?php

use PHPUnit\Framework\TestCase;

class HeaderBarTest extends TestCase {

  public function setUp() {
    $this->collection = new ResponsiveMenuPro\Collections\OptionsCollection;
    $this->factory = $this->createMock('ResponsiveMenuPro\ViewModels\Components\HeaderComponentFactory');
    $this->component = $this->createMock('ResponsiveMenuPro\ViewModels\Components\Menu\Title');
    $this->component->method('render')->willReturn('a');
    $this->factory->method('build')->willReturn($this->component);

    $this->menu = new ResponsiveMenuPro\ViewModels\HeaderBar($this->factory);
  }

  public function testOutput() {
      $this->collection->add(new ResponsiveMenuPro\Models\Option('header_bar_items_order', '{"title" : "on", "search" : "off"}'));
      $this->assertEquals('a', $this->menu->getHtml($this->collection));
  }

  public function testOutputWithTwoOptionsOn() {
      $this->collection->add(new ResponsiveMenuPro\Models\Option('header_bar_items_order', '{"title" : "on", "search" : "on"}'));
      $this->assertEquals('aa', $this->menu->getHtml($this->collection));
  }

  public function testOutputWithOptionsOff() {
      $this->collection->add(new ResponsiveMenuPro\Models\Option('header_bar_items_order', '{"title" : "off", "search" : "off"}'));
      $this->assertEquals('', $this->menu->getHtml($this->collection));
  }

}
