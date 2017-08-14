<?php

use PHPUnit\Framework\TestCase;

class OptionsCollectionTest extends TestCase {

  public function setUp() {
    $this->collection = new ResponsiveMenuPro\Collections\OptionsCollection;
  }

  public function testAddingOptionReturnTypes() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('a', 'a'));
    $all_options = $this->collection->all();
    $this->assertInternalType('array', $all_options);
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $all_options['a']);
  }

  public function testAddingMultipleOptionReturnTypes() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('a', 'a'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('b', 'b'));
    $all_options = $this->collection->all();
    $this->assertInternalType('array', $all_options);
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $all_options['a']);
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $all_options['b']);
  }

  public function testAddingOptionGetOptionReturnTypes() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('a', 'a'));
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $this->collection->get('a'));
  }

  public function testAddingMultipleOptionGetOptionReturnTypes() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('a', 'a'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('b', 'b'));

    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $this->collection->get('a'));
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $this->collection->get('b'));
  }

  public function testUsesFontAwesomeIconsWithJustOneOptionEnabled() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon_when_clicked', 'fa-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_font_icons', ''));
    $this->assertTrue($this->collection->usesFontIcons());
  }

  public function testUseFontAwesomeIconsIsFalseWhenAllEmpty() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon_when_clicked', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_font_icon', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_font_icons', '{"id":[""],"icon":[""]}'));
    $this->assertFalse($this->collection->usesFontIcons());
  }

  public function testUseFontAwesomeIconsIsTrueWhenAllFull() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon', 'fa-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon_when_clicked', 'fa-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', 'fa-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', 'fa-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_font_icon', 'fa-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_font_icons', 'fa-test'));
    $this->assertTrue($this->collection->usesFontIcons());
  }

  public function testGetActiveArrow() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', ''));
    $this->assertEquals('<img alt="alt-test" src="test.jpg" />', $this->collection->getActiveArrow());
  }

  public function testGetActiveFontIcon() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', 'test'));
    $this->assertEquals('<i class="fa fa-test"></i>', $this->collection->getActiveArrow());
  }

  public function testGetActiveArrowDoesntExist() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_image_alt', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_shape', 'arrow'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('active_arrow_font_icon', ''));
    $this->assertEquals('arrow', $this->collection->getActiveArrow());
  }

  public function testGetInactiveArrow() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', ''));
    $this->assertEquals('<img alt="alt-test" src="test.jpg" />', $this->collection->getInActiveArrow());
  }

  public function testGetInactiveFontIcon() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', 'test'));
    $this->assertEquals('<i class="fa fa-test"></i>', $this->collection->getInActiveArrow());
  }

  public function testGetInactiveArrowDoesntExist() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_image_alt', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_shape', 'arrow'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('inactive_arrow_font_icon', ''));
    $this->assertEquals('arrow', $this->collection->getInActiveArrow());
  }

  public function testGetInactiveTitleImage() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_font_icon', ''));
    $this->assertEquals('<img alt="alt-test" src="test.jpg" />', $this->collection->getTitleImage());
  }

  public function testGetInactiveTitleFontIcon() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_font_icon', 'test'));
    $this->assertEquals('<i class="fa fa-test"></i>', $this->collection->getTitleImage());
  }

  public function testGetInactiveTitleImageDoesntExist() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_image', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_image_alt', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('menu_title_font_icon', ''));
    $this->assertEquals(null, $this->collection->getTitleImage());
  }

  public function testGetButtonFontIcon() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon', 'test'));
    $this->assertEquals('<i class="fa fa-test responsive-menu-pro-button-icon responsive-menu-pro-button-icon-active"></i>', $this->collection->getButtonIcon());
  }

  public function testGetButtonIcon() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon', ''));
    $this->assertEquals('<img alt="alt-test" src="test.jpg" class="responsive-menu-pro-button-icon responsive-menu-pro-button-icon-active" />', $this->collection->getButtonIcon());
  }

  public function testGetButtonIconDoesntExist() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon', ''));
    $this->assertEquals('<span class="responsive-menu-pro-inner"></span>', $this->collection->getButtonIcon());
  }

  public function testGetButtonIconActive() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image', 'test2.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_when_clicked', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt_when_clicked', 'alt-test-two'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon_when_clicked', ''));
    $this->assertEquals('<img alt="alt-test-two" src="test.jpg" class=" responsive-menu-pro-button-icon responsive-menu-pro-button-icon-inactive" />', $this->collection->getButtonIconActive());
  }

  public function testGetButtonFontIconInActive() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image', 'test2.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_when_clicked', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt_when_clicked', 'alt-test-two'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon_when_clicked', 'test'));
    $this->assertEquals('<i class="fa fa-test responsive-menu-pro-button-icon responsive-menu-pro-button-icon-inactive"></i>', $this->collection->getButtonIconActive());
  }

  public function testGetButtonIconActiveDoesntExist() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt', ''));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_when_clicked', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt_when_clicked', 'alt-test'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_font_icon_when_clicked', ''));
    $this->assertEquals(null, $this->collection->getButtonIconActive());
  }

  public function testIsCollectionEmpty() {
    $this->assertTrue($this->collection->isEmpty());
  }

  public function testIsCollectionEmptyNotEmpty() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image', 'test.jpg'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('button_image_alt', 'alt-test'));
    $this->assertFalse($this->collection->isEmpty());
  }

  public function testArrayAccessGetFunctions() {
    $this->collection->add(new ResponsiveMenuPro\Models\Option('a', 'a'));
    $this->collection->add(new ResponsiveMenuPro\Models\Option('b', 'b'));
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $this->collection['a']);
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $this->collection['b']);
  }

  public function testArrayAccessSetFunctions() {
    $this->collection['a'] = new ResponsiveMenuPro\Models\Option('a', 'a');
    $this->collection['b'] = new ResponsiveMenuPro\Models\Option('b', 'b');
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $this->collection->get('a'));
    $this->assertInstanceOf('ResponsiveMenuPro\Models\Option', $this->collection->get('b'));
  }

  public function testArrayAccessUnSetFunctions() {
    $this->collection['a'] = new ResponsiveMenuPro\Models\Option('a', 'a');
    $this->collection['b'] = new ResponsiveMenuPro\Models\Option('b', 'b');
    unset($this->collection['b']);
    $this->assertArrayNotHasKey('b', $this->collection);
  }

}
