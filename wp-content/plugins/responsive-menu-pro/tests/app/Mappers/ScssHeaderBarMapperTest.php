<?php

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Models\Option;

class ScssHeaderBarMapperTest extends TestCase {

  public function setUp() {
    $this->collection = new OptionsCollection;
    $this->scss = new scssc_pro;
    $this->mapper = new ResponsiveMenuPro\Mappers\ScssHeaderBarMapper($this->scss);
  }

  public function testOneSetOfOptions() {
    $this->collection->add(new Option('header_bar_position_type', 'fixed'));
    $this->collection->add(new Option('header_bar_breakpoint', 900));
    $this->collection->add(new Option('header_bar_background_color', '#333333'));
    $this->collection->add(new Option('header_bar_height', 500));
    $this->collection->add(new Option('header_bar_height_unit', 'em'));
    $this->collection->add(new Option('header_bar_text_color', '#ffffff'));
    $this->collection->add(new Option('header_bar_font_size', 55));
    $this->collection->add(new Option('header_bar_font_size_unit', 'rem'));
    $this->collection->add(new Option('header_bar_font', 'Arial'));

    $mapped = $this->mapper->map($this->collection);

    $this->assertContains('position: fixed;', $mapped);
    $this->assertContains('background-color: #333;', $mapped);
    $this->assertContains('height: 500em;', $mapped);
    $this->assertContains('color: #fff;', $mapped);
    $this->assertContains('font-size: 55rem;', $mapped);
    $this->assertContains('font-family: \'Arial\';', $mapped);
    $this->assertContains('line-height: 500em;', $mapped);
    $this->assertContains('max-width: 900px', $mapped);

  }

  public function testAlternativeSetOfOptions() {
    $this->collection->add(new Option('header_bar_position_type', 'relative'));
    $this->collection->add(new Option('header_bar_breakpoint', 900));
    $this->collection->add(new Option('header_bar_background_color', '#222222'));
    $this->collection->add(new Option('header_bar_height', 250));
    $this->collection->add(new Option('header_bar_height_unit', 'em'));
    $this->collection->add(new Option('header_bar_text_color', '#DADADA'));
    $this->collection->add(new Option('header_bar_font_size', 23));
    $this->collection->add(new Option('header_bar_font_size_unit', 'rem'));
    $this->collection->add(new Option('header_bar_font', ''));

    $mapped = $this->mapper->map($this->collection);

    $this->assertContains('position: relative;', $mapped);
    $this->assertContains('background-color: #222;', $mapped);
    $this->assertContains('height: 250em;', $mapped);
    $this->assertContains('color: #dadada;', $mapped);
    $this->assertContains('font-size: 23rem;', $mapped);
    $this->assertNotContains('font-family', $mapped);
    $this->assertContains('line-height: 250em;', $mapped);

  }

}
