<?php

namespace ResponsiveMenuPro\ViewModels\Components\Menu;

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Collections\OptionsCollection;

class TitleTest extends TestCase {

  public function setUp() {
    $this->translator = $this->createMock('ResponsiveMenuPro\Translation\Translator');
    $this->component = new Title($this->translator);
  }

  public function testRender() {
    $collection = new OptionsCollection;
    $collection->add(new Option('menu_title', 'a'));
    $collection->add(new Option('menu_title_link', 'b'));
    $collection->add(new Option('menu_title_link_location', 'c'));
    $collection->add(new Option('menu_title_image', 'd'));
    $collection->add(new Option('menu_title_image_alt', 'alt-test'));
    $collection->add(new Option('menu_title_font_icon', ''));
    $this->translator->method('translate')->will($this->onConsecutiveCalls('a', 'b'));
    $rendered = $this->component->render($collection);
    $this->assertContains('target="c"', $rendered);
    $this->assertContains('href="b"', $rendered);
    $this->assertContains('src="d"', $rendered);
    $this->assertContains('alt="alt-test"', $rendered);
    $this->assertContains('>a<', $rendered);
  }

}
