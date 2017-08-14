<?php

use PHPUnit\Framework\TestCase;

class FontIconPageListTest extends TestCase {

  public function setUp() {
    $this->form_component = new ResponsiveMenuPro\Form\FontIconPageList;
  }

  public function testRendering() {
    $output = $this->form_component->render(new ResponsiveMenuPro\Models\Option('a', '{"id":["1", "2"],"icon":["a", "b"]}'));
    $this->assertContains("class='a_icon'", $output);
    $this->assertContains("value='2'", $output);
    $this->assertContains("value='b'", $output);
  }

  public function testRenderingWhenEmpty() {
    $output = $this->form_component->render(new ResponsiveMenuPro\Models\Option('a', 'b'));
    $this->assertContains("class='a_icon'", $output);
  }

}
