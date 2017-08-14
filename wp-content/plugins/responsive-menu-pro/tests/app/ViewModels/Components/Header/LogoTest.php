<?php

namespace ResponsiveMenuPro\ViewModels\Components\Header;

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Collections\OptionsCollection;

class LogoTest extends TestCase {

  public function setUp() {
    $this->translator = $this->createMock('ResponsiveMenuPro\Translation\Translator');
    $this->translator->method('translate')->will($this->returnArgument(0));
    $this->component = new Logo($this->translator);
  }

  public function testRender() {
    $collection = new OptionsCollection;
    $collection->add(new Option('header_bar_logo', 'test.jpg'));
    $collection->add(new Option('header_bar_logo_alt', 'alt-test'));
    $collection->add(new Option('header_bar_logo_link', 'link'));

    $rendered = $this->component->render($collection);

    $this->assertContains('href="link"', $rendered);
    $this->assertContains('src="test.jpg"', $rendered);
    $this->assertContains('alt="alt-test"', $rendered);
  }

  public function testNotRendered() {
    $collection = new OptionsCollection;
    $collection->add(new Option('header_bar_logo', ''));
    $collection->add(new Option('header_bar_logo_alt', ''));
    $collection->add(new Option('header_bar_logo_link', ''));

    $this->assertNull($this->component->render($collection));
  }

}
