<?php

use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase {

  public function setUp() {
    $this->form_component = new ResponsiveMenuPro\Form\Import;
  }

  public function testRendering() {
    $output = $this->form_component->render();
    $this->assertEquals('<input type="file" name="responsive_menu_pro_import_file" /><input type="submit" class="button submit" name="responsive_menu_pro_import" value="Import Options" />', $output);
  }

}
