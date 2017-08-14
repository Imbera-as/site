<?php

namespace ResponsiveMenuPro\ViewModels\Components\Header;

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Collections\OptionsCollection;

class TitleTest extends TestCase {

  public function setUp() {
    $this->translator = $this->createMock('ResponsiveMenuPro\Translation\Translator');
    $this->translator->method('translate')->will($this->returnArgument(0));
    $this->component = new Title($this->translator);
  }

  public function testRender() {
    $collection = new OptionsCollection;
    $collection->add(new Option('header_bar_title', 'on'));
    $collection->add(new Option('header_bar_logo_link', 'link'));
    $collection->add(new Option('header_bar_title', 'title'));

    $rendered = $this->component->render($collection);

    $this->assertContains('href="link"', $rendered);
    $this->assertContains('>title<', $rendered);
  }

  public function testNotRendered() {
    $collection = new OptionsCollection;
    $collection->add(new Option('header_bar_title', ''));
    $collection->add(new Option('header_bar_logo_link', ''));

    $this->assertNull($this->component->render($collection));
  }

}
