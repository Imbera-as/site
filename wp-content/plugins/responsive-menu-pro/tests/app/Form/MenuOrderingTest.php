<?php

use PHPUnit\Framework\TestCase;

class MenuOrderingTest extends TestCase {

  public function setUp() {
    $this->form_component = new ResponsiveMenuPro\Form\MenuOrdering;
  }

  public function testRendering() {
    $output = $this->form_component->render(new ResponsiveMenuPro\Models\Option('a', '{"search": "on", "title": "off"}'));
    $this->assertContains('menu-order-option-switch menu-order-option-switch-on', $output);
    $this->assertContains('value="off" name="menu[a][title]"', $output);
    $this->assertContains('value="on" name="menu[a][search]"', $output);
  }
}
