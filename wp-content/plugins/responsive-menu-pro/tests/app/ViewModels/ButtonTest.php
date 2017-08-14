<?php

use PHPUnit\Framework\TestCase;

class ButtonTest extends TestCase {

  public function setUp() {
    $this->collection = $this->createMock('ResponsiveMenuPro\Collections\OptionsCollection');
    $this->component = $this->createMock('ResponsiveMenuPro\ViewModels\Components\Button\Button');
    $this->component->method('render')->willReturn('a');
    $this->button = new ResponsiveMenuPro\ViewModels\Button($this->component);
  }

  public function testOutput() {
      $this->assertEquals('a', $this->button->getHtml($this->collection));
  }

}
