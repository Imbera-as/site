<?php

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Factories\CssFactory;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Models\Option;

class CssFactoryTest extends TestCase {

  public function setUp() {
      $this->base_mapper = $this->createMock('ResponsiveMenuPro\Mappers\ScssBaseMapper');
      $this->button_mapper = $this->createMock('ResponsiveMenuPro\Mappers\ScssButtonMapper');
      $this->menu_mapper = $this->createMock('ResponsiveMenuPro\Mappers\ScssMenuMapper');
      $this->header_bar_mapper = $this->createMock('ResponsiveMenuPro\Mappers\ScssHeaderBarMapper');
      $this->single_menu_mapper = $this->createMock('ResponsiveMenuPro\Mappers\ScssSingleMenuMapper');
      $this->minifier = $this->createMock('ResponsiveMenuPro\Formatters\Minify');

      $this->base_mapper->method('map')->willReturn('a');
      $this->button_mapper->method('map')->willReturn('b');
      $this->menu_mapper->method('map')->willReturn('c');
      $this->header_bar_mapper->method('map')->willReturn('e');
      $this->single_menu_mapper->method('map')->willReturn('f');
      $this->minifier->method('minify')->willReturn('d');
      $this->factory = new CssFactory($this->minifier, $this->base_mapper, $this->button_mapper, $this->menu_mapper, $this->header_bar_mapper, $this->single_menu_mapper);
  }

  public function testMinified() {
    $collection = new OptionsCollection;
    $collection->add(new Option('minify_scripts', 'on'));
    $this->assertContains('d', $this->factory->build($collection));
  }

  public function testNotMinified() {
    $collection = new OptionsCollection;
    $collection->add(new Option('minify_scripts', 'off'));
    $this->assertContains('abc', $this->factory->build($collection));
  }

  public function testWithHeaderBar() {
    $collection = new OptionsCollection;
    $collection->add(new Option('minify_scripts', 'off'));
    $collection->add(new Option('use_header_bar', 'on'));
    $this->assertContains('abce', $this->factory->build($collection));
  }

  public function testWithSingleMenu() {
    $collection = new OptionsCollection;
    $collection->add(new Option('minify_scripts', 'off'));
    $collection->add(new Option('use_single_menu', 'on'));
    $this->assertContains('abcf', $this->factory->build($collection));
  }

  public function testWithHeaderBarAndSingleMenu() {
    $collection = new OptionsCollection;
    $collection->add(new Option('minify_scripts', 'off'));
    $collection->add(new Option('use_header_bar', 'on'));
    $collection->add(new Option('use_single_menu', 'on'));
    $this->assertContains('abcef', $this->factory->build($collection));
  }

}
