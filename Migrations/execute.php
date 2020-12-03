<?php
namespace Migrations;
define('DB_HOST', 'localhost');
define('DB_NAME', 'homestead');
define('DB_USER', 'homestead');
define('DB_PASS', 'secret');
define('TABLE_CURRENT_STATE', 'current_state_database');
require 'Database.php';
require 'Migrations.php';

$help  = 'Usage: php ' . $argv[0] . ' -h|-s|-m|-b|-r' . PHP_EOL;
$help .= 'Options:' . PHP_EOL;
$help .= '    -h --help       Show this message' . PHP_EOL;
$help .= '    -s --state      Текущий статус' . PHP_EOL;
$help .= '    -m --migrate    Миграция' . PHP_EOL;
if ($argc == 2) { // должна быть только одна опция и это обязательно
    $params = array(
        's::' => 'state::',
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
    if (isset($options['help']) || isset($options['h'])) {
        // опция help (справка по использованию)
        echo $help;
    } elseif (isset($options['state']) || isset($options['s'])) {
        // опция state (текущее состояние базы данных)
        $migration->state();
    } elseif (isset($options['migrate']) || isset($options['m'])) {
        $migration->up();
    } elseif (isset($options['down']) || isset($options['d'])) {
        $migration->down();

    } else {
        echo 'Неизвестная опция', PHP_EOL;
        echo $help;
    }
}