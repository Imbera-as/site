<?php

use PHPUnit\Framework\TestCase;

class ScssBaseMapperTest extends TestCase {

  public function setUp() {
    $this->collection = new ResponsiveMenuPro\Collections\OptionsCollection;
    $this->scss = new scssc_pro;
    $this->mapper = new ResponsiveMenuPro\Mappers\ScssBaseMapper($this->scss);
  }

  public function testThis() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('breakpoint', 6000));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_text_alignment', 'right'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_disable_scrolling', 'on'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('use_slide_effect', 'off'));
    $mapped = $this->mapper->map($this->collection);
    $this->assertContains('max-width: 6000px)', $mapped);
    $this->assertContains('padding-right: 10%', $mapped);
    $this->assertContains('padding-right: 15%', $mapped);
    $this->assertContains('#responsive-menu-pro-overlay', $mapped);
  }

  public function testThat() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('breakpoint', 3000));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_text_alignment', 'left'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_disable_scrolling', 'off'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('use_slide_effect', 'off'));
    $mapped = $this->mapper->map($this->collection);
    $this->assertContains('max-width: 3000px)', $mapped);
    $this->assertContains('padding-left: 10%', $mapped);
    $this->assertContains('padding-left: 15%', $mapped);
    $this->assertNotContains('#responsive-menu-pro-overlay', $mapped);
  }

}
