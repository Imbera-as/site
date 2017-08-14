<?php

namespace ResponsiveMenuPro\ViewModels\Components\Menu;

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Models\Option;

class SearchTest extends TestCase {

  public function setUp() {
    $this->translator = $this->createMock('ResponsiveMenuPro\Translation\Translator');
    $this->component = new Search($this->translator);
  }

  public function testRender() {
    $collection = new OptionsCollection;
    $collection->add(new Option('menu_search_box_text', 'c'));
    $this->translator->method('searchUrl')->willReturn('a');
    $this->translator->method('translate')->willReturn('b');
    $this->assertContains('action="a" ', $this->component->render($collection));
  }

}
