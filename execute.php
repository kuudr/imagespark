<?php
namespace Migrations;
require 'Migrations/Database.php';
require 'Migrations/Migrations.php';
require 'data/dbConn.php';
use data\dbConn;
define('TABLE_CURRENT_STATE', 'current_state_database');


function dd($any) {
    die(var_dump($any));
}
if ($argc == 2) {
    $params = array(
        'm::' => 'migrate::',
        'd::' => 'down::',
        'c::' => 'create::',
        'b::' => 'backup::',
        'r::' => 'restore::'
    );
    $options = getopt(implode('', array_keys($params)), $params);
    $migration = new Migration(
        dbConn::HOST,
        dbConn::DB_NAME,
        dbConn::DB_NAME,
        dbConn::DB_PASSWORD,
        TABLE_CURRENT_STATE
    );
    if(isset($options['migrate']) || isset($options['m'])) {
        $migration->migrate();
    } elseif (isset($options['backup']) || isset($options['b'])) {
        // опция backup (создание резервной копии)
        $migration->backup();
    } elseif (isset($options['restore']) || isset($options['r'])) {
        // опция restore (восстановление из резервной копии)
        $migration->restore();
    } elseif (isset($options['create']) ||  isset($options['c']) ) {
        $migration->make($options['c'], time());
    } else {
        echo 'Неизвестная опция', PHP_EOL;
    }
}