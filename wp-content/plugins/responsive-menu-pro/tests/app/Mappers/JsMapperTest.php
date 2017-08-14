<?php

use PHPUnit\Framework\TestCase;

class JsMapperTest extends TestCase {

  public function setUp() {
    $this->collection = new ResponsiveMenuPro\Collections\OptionsCollection;
    $this->collection->add(new ResponsiveMenuPro\Models\Option('animation_speed', 5));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_click_trigger', 'a'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image', 'a'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image', 'b'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image_alt', 'alt-test-two'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('breakpoint', 'c'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_click_trigger', 'd'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('animation_type', 'e'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_appear_from', 'f'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('page_wrapper', 'g'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('accordion_animation', 'h'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_close_on_body_click', 'i'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_close_on_link_click', 'j'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_item_click_to_trigger_submenu', 'k'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_push_with_animation', 'l'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', ''));

    $this->mapper = new ResponsiveMenuPro\Mappers\JsMapper;
  }

  public function testOutput() {
    $mapped = $this->mapper->map($this->collection);
    $this->assertContains('animationSpeed: 5000', $mapped);
    $this->assertContains("trigger: 'd'", $mapped);
    $this->assertContains('breakpoint: c', $mapped);
    $this->assertContains("pushButton: 'l'", $mapped);
    $this->assertContains("animationType: 'e'", $mapped);
    $this->assertContains("animationSide: 'f'", $mapped);
    $this->assertContains("pageWrapper: 'g'", $mapped);
    $this->assertContains("accordion: 'h'", $mapped);
    $this->assertContains("closeOnBodyClick: 'i'", $mapped);
    $this->assertContains("closeOnLinkClick: 'j'", $mapped);
    $this->assertContains("itemTriggerSubMenu: 'k'", $mapped);
    $this->assertContains('alt="alt-test"', $mapped);
    $this->assertContains('alt="alt-test-two"', $mapped);
  }

  public function testDefaultAnimationSpeed() {
    $collection = new ResponsiveMenuPro\Collections\OptionsCollection;
    $collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image', 'a'));
    $collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image_alt', 'alt-test'));
    $collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image', 'b'));
    $collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image_alt', 'alt-test-two'));
    $collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', ''));
    $collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', ''));
    $mapper = new ResponsiveMenuPro\Mappers\JsMapper;
    $mapped = $this->mapper->map($collection);
    $this->assertContains('animationSpeed: 500', $mapped);
    $this->assertContains('alt="alt-test"', $mapped);
    $this->assertContains('alt="alt-test-two"', $mapped);
  }

}
