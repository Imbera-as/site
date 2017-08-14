<?php

namespace ResponsiveMenuPro\Repositories;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Database\Database;
use ResponsiveMenuPro\Factories\OptionFactory;

class OptionRepository {

  protected static $table = 'responsive_menu_pro';

  public function __construct(Database $db, OptionFactory $factory, array $defaults) {
    $this->db = $db;
    $this->factory = $factory;
    $this->defaults = $defaults;
  }

  public function all() {
    $options = $this->db->all(self::$table);
    $collection = new OptionsCollection;
    foreach($options as $option)
      $collection->add($this->factory->build($option->name, $option->value));
    return $collection;
  }

  public function update(Option $option) {
    return $this->db->update(self::$table,
      ['value' => $option->getFiltered()],
      ['name' => $option->getName()]
    );
  }

  public function create(Option $option) {
    $arguments['name'] = $option->getName();
    $arguments['value'] = $option->getFiltered();
    $arguments['created_at'] = $this->db->mySqlTime();
    return $this->db->insert(self::$table, $arguments);
  }

  public function remove($name) {
    return $this->db->delete(self::$table, $name);
  }

  public function buildFromArray(array $array) {
    $collection = new OptionsCollection;
    foreach(array_merge($this->defaults, $array) as $name => $value):
      $value = is_array($value) ? json_encode($value) : $value;
      $collection->add($this->factory->build($name, $value));
    endforeach;
    return $collection;
  }

}
