<?php

namespace ResponsiveMenuPro\ViewModels\Components\Header;

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Collections\OptionsCollection;

class HtmlContentTest extends TestCase {

  public function setUp() {
    $this->translator = $this->createMock('ResponsiveMenuPro\Translation\Translator');
    $this->component = new HtmlContent($this->translator);
  }

  public function testRender() {
    $collection = new OptionsCollection;
    $collection->add(new Option('header_bar_html_content', 'b'));
    $this->translator->method('translate')->willReturn('b');
    $this->translator->method('allowShortcode')->willReturn('b');
    $this->assertContains('responsive-menu-pro-header-box">b</div>', $this->component->render($collection));
  }

}
