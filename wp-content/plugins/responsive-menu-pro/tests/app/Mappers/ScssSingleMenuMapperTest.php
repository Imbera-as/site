<?php

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Models\Option;

class ScssSingleMenuMapperTest extends TestCase {

  public function setUp() {
    $this->collection = new OptionsCollection;
    $this->scss = new scssc_pro;
    $this->mapper = new ResponsiveMenuPro\Mappers\ScssSingleMenuMapper($this->scss);
  }

  public function testOneSetOfOptions() {
    $this->collection->add(new Option('breakpoint', 900));
    $this->collection->add(new Option('single_menu_height', 45));
    $this->collection->add(new Option('single_menu_height_unit', 'px'));
    $this->collection->add(new Option('single_menu_font_size', 23));
    $this->collection->add(new Option('single_menu_font_size_unit', 'em'));
    $this->collection->add(new Option('single_menu_submenu_font_size', 43));
    $this->collection->add(new Option('single_menu_submenu_font_size_unit', 'rem'));
    $this->collection->add(new Option('transition_speed', 500));
    $this->collection->add(new Option('single_menu_submenu_height', 63));
    $this->collection->add(new Option('single_menu_submenu_height_unit', '%'));
    $this->collection->add(new Option('single_menu_font', 'Arial'));
    $this->collection->add(new Option('single_menu_submenu_font', 'Helvetica'));
    $this->collection->add(new Option('single_menu_item_link_colour', '#111111'));
    $this->collection->add(new Option('single_menu_item_background_colour', '#222222'));
    $this->collection->add(new Option('single_menu_item_link_colour_hover', '#333333'));
    $this->collection->add(new Option('single_menu_item_background_colour_hover', '#444444'));
    $this->collection->add(new Option('single_menu_item_submenu_background_colour', '#555555'));
    $this->collection->add(new Option('single_menu_item_submenu_link_colour', '#666666'));
    $this->collection->add(new Option('single_menu_item_submenu_link_colour_hover', '#777777'));
    $this->collection->add(new Option('single_menu_item_submenu_background_colour_hover', '#888888'));

    $mapped = $this->mapper->map($this->collection);

    $this->assertContains('(min-width: 900px)', $mapped);
    $this->assertContains('line-height: 45px;', $mapped);
    $this->assertContains('font-size: 23em;', $mapped);
    $this->assertContains('font-size: 43rem;', $mapped);
    $this->assertContains('transition: color, background 500s;', $mapped);
    $this->assertContains('height: 63%;', $mapped);
    $this->assertContains('font-family: \'Arial\';', $mapped);
    $this->assertContains('font-family: \'Helvetica\';', $mapped);
    $this->assertContains('color: #111;', $mapped);
    $this->assertContains('color: #333;', $mapped);
    $this->assertContains('color: #666;', $mapped);
    $this->assertContains('color: #777;', $mapped);
    $this->assertContains('background: #222;', $mapped);
    $this->assertContains('background: #444;', $mapped);
    $this->assertContains('background: #555;', $mapped);
    $this->assertContains('background: #888;', $mapped);

  }


}
