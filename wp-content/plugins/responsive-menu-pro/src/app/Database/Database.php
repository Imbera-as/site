<?php

namespace ResponsiveMenuPro\Database;

interface Database {
	public function update($table, array $to_update, array $where);
	public function delete($table, $name);
	public function all($table);
	public function insert($table, array $arguments);
}
