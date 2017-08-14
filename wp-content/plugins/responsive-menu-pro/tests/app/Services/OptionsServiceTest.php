<?php

use PHPUnit\Framework\TestCase;
use ResponsiveMenuPro\Services\OptionService;

class OptionsServiceTest extends TestCase {

    public function setUp() {
      $this->repository = $this->createMock('ResponsiveMenuPro\Repositories\OptionRepository');
      $this->factory = $this->createMock('ResponsiveMenuPro\Factories\OptionFactory');
      $this->translator = $this->createMock('ResponsiveMenuPro\Translation\Translator');
      $this->scripts_builder = $this->createMock('ResponsiveMenuPro\Filesystem\ScriptsBuilder');

      $this->service = new OptionService($this->repository, $this->factory, $this->translator, $this->scripts_builder);
    }

    public function testCombiningBasicOptions() {
      $this->assertSame(['one' => 1, 'two' => 'two'], $this->service->combineOptions(['one' => 1],['two' => 'two']));
    }

    public function testCombiningStringZeroOptions() {
      $this->assertSame(['one' => '0'], $this->service->combineOptions(['one' => 'default'],['one' => '0']));
    }

    public function testCombiningIntegerZeroOptions() {
      $this->assertSame(['one' => 0], $this->service->combineOptions(['one' => 'default'],['one' => 0]));
    }

    public function testOverwritingDefaultOptionValue() {
      $this->assertSame(['one' => 'updated'], $this->service->combineOptions(['one' => 'default'],['one' => 'updated']));
    }

    public function testRepositoryReturn() {
      $this->repository->method('all')->willReturn('a');
      $this->assertEquals('a', $this->service->all());
    }

    public function testBuildPostArray() {
      $this->repository->method('buildFromArray')->willReturn('a');
      $this->assertEquals('a', $this->service->buildFromPostArray([]));
    }

    public function testUpdateOptions() {
      $this->repository->method('all')->willReturn(new ResponsiveMenuPro\Collections\OptionsCollection);
      $this->repository->method('update')->willReturn('a');
      $this->factory->method('build')->willReturn(new ResponsiveMenuPro\Models\Option('a', 1));
      $this->assertInstanceOf('ResponsiveMenuPro\Collections\OptionsCollection', $this->service->updateOptions(['a' => 1]));
    }

    public function testCreateOptions() {
      $collection = new ResponsiveMenuPro\Collections\OptionsCollection;
      $collection->add(new ResponsiveMenuPro\Models\Option('external_files', 'on'));
      $this->repository->method('all')->willReturn($collection);
      $this->repository->method('create')->willReturn('a');
      $this->factory->method('build')->willReturn(new ResponsiveMenuPro\Models\Option('a', 1));
      $this->assertInstanceOf('ResponsiveMenuPro\Collections\OptionsCollection', $this->service->createOptions(['a' => 1]));
    }

}
