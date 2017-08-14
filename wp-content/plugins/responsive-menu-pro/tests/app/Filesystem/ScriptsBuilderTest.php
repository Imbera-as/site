<?php

use PHPUnit\Framework\TestCase;

class ScriptsBuilderTest extends TestCase {

  public function setUp() {
    $this->files = $this->createMock('ResponsiveMenuPro\Filesystem\FileCreator');
    $this->folders = $this->createMock('ResponsiveMenuPro\Filesystem\FolderCreator');
    $this->css = $this->createMock('ResponsiveMenuPro\Factories\CssFactory');
    $this->js = $this->createMock('ResponsiveMenuPro\Factories\JsFactory');
    $this->collection = $this->createMock('ResponsiveMenuPro\Collections\OptionsCollection');
    $this->id = 2;
    
    $this->builder = new ResponsiveMenuPro\Filesystem\ScriptsBuilder($this->css, $this->js, $this->files, $this->folders, $this->id);

  }

  public function testBuild() {
    $this->assertEquals(null, $this->builder->build($this->collection));
  }

}
