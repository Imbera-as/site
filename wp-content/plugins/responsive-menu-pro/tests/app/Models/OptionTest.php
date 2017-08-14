<?php

use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase {

  public function setUp() {
    $this->option = new ResponsiveMenuPro\Models\Option('a', 'b');
  }

  public function testGetName() {
    $this->assertEquals('a', $this->option->getName());
  }

  public function testGetValue() {
    $this->assertEquals('b', $this->option->getValue());
  }

  public function testSetValue() {
    $this->option->setValue('c');
    $this->assertEquals('c', $this->option->getValue());
  }

  public function testToString() {
    $this->assertEquals('b', $this->option);
  }

  public function testAddFilter() {
    $filter = $this->createMock('ResponsiveMenuPro\Filters\TextFilter');
    $filter->method('filter')->willReturn('d');
    $this->option->setFilter($filter);
    $this->assertEquals('b', $this->option->getValue());
    $this->assertEquals('d', $this->option->getFiltered());
  }

  public function testAddAndGetFilter() {
    $filter = $this->createMock('ResponsiveMenuPro\Filters\TextFilter');
    $filter->method('filter')->willReturn('d');
    $this->option->setFilter($filter);
    $this->assertInstanceOf('ResponsiveMenuPro\Filters\TextFilter', $this->option->getFilter());
  }

  public function testFilteredJsonAsString() {
    $option = new ResponsiveMenuPro\Models\Option('a', '{"a":"1","b":"2"}');
    $filter = new ResponsiveMenuPro\Filters\JsonFilter;
    $option->setFilter($filter);
    $this->assertEquals('{"a":"1","b":"2"}', $option->getFiltered());
  }

  public function testFilteredJsonAsArray() {
    $option = new ResponsiveMenuPro\Models\Option('a', ['a' => 1,'b' => 2]);
    $filter = new ResponsiveMenuPro\Filters\JsonFilter;
    $option->setFilter($filter);
    $this->assertEquals('{"a":1,"b":2}', $option->getFiltered());
  }

}
