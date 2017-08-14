<?php

namespace ResponsiveMenuPro\ViewModels\Components\Button;

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Collections\OptionsCollection;

class ButtonTest extends TestCase {

  public function setUp() {
    $this->translator = $this->createMock('ResponsiveMenuPro\Translation\Translator');
    $this->component = new Button($this->translator);
  }

  public function testRender() {
    $collection = new OptionsCollection;
    $collection->add(new Option('button_title', 'b'));
    $collection->add(new Option('button_title_position', 'left'));
    $collection->add(new Option('button_click_animation', 'd'));
    $collection->add(new Option('button_image', 'e'));
    $collection->add(new Option('button_image_alt', 'alt-test'));
    $collection->add(new Option('button_image_when_clicked', 'f'));
    $collection->add(new Option('button_image_alt_when_clicked', 'alt-test-two'));
    $collection->add(new Option('button_font_icon', ''));
    $collection->add(new Option('button_font_icon_when_clicked', ''));

    $this->translator->method('translate')->willReturn('a');

    $rendered = $this->component->render($collection);
    $this->assertContains('responsive-menu-pro-label-left', $rendered);
    $this->assertContains('responsive-menu-pro-accessible', $rendered);
    $this->assertContains('responsive-menu-pro-d', $rendered);
    $this->assertContains('alt="alt-test"', $rendered);
    $this->assertContains('alt="alt-test-two"', $rendered);
  }

}
