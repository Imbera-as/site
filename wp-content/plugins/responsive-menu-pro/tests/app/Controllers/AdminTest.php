<?php

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Models\Option;

class AdminTest extends TestCase {

  static public function setUpBeforeClass() {
    function __($a, $b) {
      return $a;
    }
    if(!function_exists('update_option')):
      function update_option($a, $b) {
        return $a . ' ' . $b;
      }
    endif;
  }
  public function setUp() {
    $this->view = $this->createMock('ResponsiveMenuPro\View\AdminView');
    $this->service = $this->createMock('ResponsiveMenuPro\Services\OptionService');
    $this->view->method('render')->willReturn(true);
    $this->view->method('display')->will($this->returnArgument(0));
    $this->service->method('combineOptions')->willReturn([]);
    $collection = new OptionsCollection;
    $collection->add(new Option('a', 1));
    $this->service->method('all')->willReturn($collection);
    $this->controller = new ResponsiveMenuPro\Controllers\Admin($this->service, $this->view);

  }

  public function testUpdate() {
    $this->assertTrue($this->controller->update([],['responsive_menu_pro_current_page' => 'a_one']));
  }

  public function testReset() {
    $this->assertTrue($this->controller->reset([]));
  }

  public function testIndex() {
    $this->assertTrue($this->controller->index([]));
  }

  public function testExport() {
    $this->assertNull($this->controller->export());
  }

  public function testImportNoFile() {
    $this->assertTrue($this->controller->import(['a' => 1], null));
  }

  public function testImport() {
    $this->assertTrue($this->controller->import(['a' => 1], ['b' => 2]));
  }

}
