<?php
namespace Migrations;
define('DB_HOST', 'localhost');
define('DB_NAME', 'homestead');
define('DB_USER', 'homestead');
define('DB_PASS', 'secret');
define('TABLE_CURRENT_STATE', 'current_state_database');
require 'Database.php';
require 'Migrations.php';

if ($argc == 2) {
    $params = array(
        'm::' => 'migrate::',
        'd::' => 'down::',
    );
    $options = getopt(implode('', array_keys($params)), $params);

    $migration = new Migration(
        DB_HOST,
        DB_NAME,
        DB_USER,
        DB_PASS,
        TABLE_CURRENT_STATE
    );
    if(isset($options['migrate']) || isset($options['m'])) {
        $migration->up();
    } elseif (isset($options['down']) || isset($options['d'])) {
        $migration->down();
    } else {
        echo 'Неизвестная опция', PHP_EOL;
    }
}