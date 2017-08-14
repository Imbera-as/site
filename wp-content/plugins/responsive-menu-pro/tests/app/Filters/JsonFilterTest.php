<?php

use PHPUnit\Framework\TestCase;

class JsonFilterTest extends TestCase {

  public function setUp() {
      $this->filter = new ResponsiveMenuPro\Filters\JsonFilter;
  }

  public function testFilteredWithString() {
    $this->assertEquals('{"a":1,"b":2}', $this->filter->filter('{"a":1,"b":2}'));
  }

  public function testFilteredWithArray() {
    $this->assertEquals('{"a":1,"b":2}', $this->filter->filter(['a' => 1, 'b' => 2]));
  }

}
