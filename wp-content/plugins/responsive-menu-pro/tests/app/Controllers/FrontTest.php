<?php

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Models\Option;

class FrontTest extends TestCase {

  public function setUp() {
    $this->view = $this->createMock('ResponsiveMenuPro\View\FrontView');
    $this->service = $this->createMock('ResponsiveMenuPro\Services\OptionService');
    $this->menu = $this->createMock('ResponsiveMenuPro\ViewModels\Menu');
    $this->button = $this->createMock('ResponsiveMenuPro\ViewModels\Button');
    $this->header = $this->createMock('ResponsiveMenuPro\ViewModels\HeaderBar');
    $this->collection = new OptionsCollection;

    $this->view->method('render')->willReturn('rendered');
    $this->controller = new ResponsiveMenuPro\Controllers\Front($this->service, $this->view, $this->menu, $this->button, $this->header);

  }

  public function testHeaderBarIsCalledInPreview() {
    $this->collection->add(new Option('shortcode', 'off'));
    $this->collection->add(new Option('use_header_bar', 'on'));
    $this->service->method('buildFromPostArray')->willReturn($this->collection);
    $options['shortcode'] = 'off';
    $this->assertEquals('rendered', $this->controller->preview($options));
  }

  public function testIndexShortcodeIsCalledInPreview() {
    $this->service->method('buildFromPostArray')->willReturn($this->collection);
    $this->view->method('addShortcode')->willReturn('shortcode added');
    $options['shortcode'] = 'off';
    $this->assertEquals('shortcode added', $this->controller->preview($options));
  }

  public function testIndexShortcodeIsNotCalledInPreview() {
    $this->collection->add(new Option('shortcode', 'off'));
    $this->service->method('buildFromPostArray')->willReturn($this->collection);
    $this->view->method('addShortcode')->willReturn('shortcode added');
    $options['shortcode'] = 'off';
    $this->assertEquals('rendered', $this->controller->preview($options));
  }

  public function testIndexHeaderBarIsCalled() {
    $this->collection->add(new Option('shortcode', 'off'));
    $this->collection->add(new Option('use_header_bar', 'on'));
    $this->service->method('all')->willReturn($this->collection);
    $this->assertEquals('rendered', $this->controller->index());
  }

  public function testIndexShortcodeIsNotCalled() {
    $this->collection->add(new Option('shortcode', 'off'));
    $this->service->method('all')->willReturn($this->collection);
    $this->assertEquals('rendered', $this->controller->index());
  }

  public function testIndexShortcodeIsCalled() {
    $this->service->method('all')->willReturn($this->collection);
    $this->view->method('addShortcode')->willReturn('shortcode added');
    $this->assertEquals('shortcode added', $this->controller->index());
  }

  public function testIndexNotShownOnMobile() {
    $this->collection->add(new Option('mobile_only', 'on'));
    $this->service->method('all')->willReturn($this->collection);
    $this->view->method('isMobile')->willReturn(false);
    $this->assertNull($this->controller->index());
  }

}
