<?php

namespace Migrations;
class Migration
{

    private $host;
    private $name;
    private $user;
    private $pass;
    private $stateTable;
    private $dbDownDir;
    private $sqlDir;

    private $database;

    public function __construct($host, $name, $user, $pass, $stateTable, $sqlDir = 'Migrations/sqls', $dbDownDir = 'Migrations/dbDown')
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->pass = $pass;
        $this->stateTable = $stateTable;
        $this->sqlDir = str_replace('\\', '/', realpath($sqlDir)) . '/';
        $this->dbDownDir = str_replace('\\', '/', realpath($dbDownDir)) . '/';
        Database::init($host, $name, $user, $pass);
        $this->database = Database::getInstance();
    }


    public function make($name, $time)
    {

        file_put_contents($this->sqlDir . '/' . (string)$time . '_' . $name . '_up.sql', '');
        file_put_contents($this->sqlDir . '/' . (string)$time . '_' . $name . '_down.sql', '');
    }

    public function up()
    {

        $files = $this->getNewFiles();
        if (empty($files)) {
            echo "База данных в последнем состоянии \n";
            return;
        }
        echo "Начало миграции \n ", PHP_EOL;
        foreach ($files as $file) {
            if ($this->isUp($file)) {
                if ($this->confirm('Применить миграцию:' . basename($file) . '?')){
                    $this->execute($file);
                    echo "Выполнение файла: ", basename($file), PHP_EOL;
                    break;
                }
            }

        }
        echo "Миграция выполнена \n";
    }

    private function isUp($fileName)
    {

        return (bool)stripos($fileName, '_up');
    }

    public function down()
    {
        $files = $this->getOldFiles();
        if (empty($files)) {
            echo "Нечего откатывать \n";
            return;
        }
        echo "Начало отката \n ", PHP_EOL;
        foreach ($files as $file) {
            $downFileName = str_replace('_up', '_down', $file);
            if ($this->confirm('Применить откат миграции: ' .  basename($downFileName) . '?')) {
                $this->execute($downFileName, false);
                echo "Выполнение файла отката: ", basename($downFileName), PHP_EOL;
                $name = $this->getMigrationName($downFileName);
                $fileToDel = basename($name);
                $query =  'DELETE FROM ' . $this->stateTable . ' WHERE name = ' . "'$fileToDel'" ;
                $this->database->execute($query);
                break;
            }else{
                echo "Откат был отменен! \n";
            }


        }
    }




//    public function down() {
//        $files = $this->getNewFiles();
//        if (empty($files)) {
//            echo "Нечего откатывать \n";
//            return;
//        }
//        echo "Начало отката \n ", PHP_EOL;
//        foreach ($files as $file) {
//            $downFileName = str_replace('_up', '_down' , $file);{
//                echo '   ' . basename($downFileName) . PHP_EOL;
//            }
//            foreach ($files as $downFile){
//                if ($this->confirm('Применить откат миграции?'))
//                    $this->execute($downFile, false);
//                    echo "Выполнение файла отката: ", basename($downFile), PHP_EOL;
//
//            }
//            $this->execute($downFileName, false);
//            echo "Выполнение файла отката: ", basename($file), PHP_EOL;
//            $name = $this->getMigrationName($downFileName);
//            $query =  'DELETE FROM ' . $this->stateTable . ' WHERE name = ' . "'$name'" ;

//            $this->database->execute($query);
//        }

//    }
    private function execute($file, $insertToDb = true)
    {
        if ($this->pass != '') {
            $command = 'mysql -u' . $this->user . ' -p' . $this->pass . ' -h ' . $this->host .
                ' -D ' . $this->name . ' < ' . $file;
        } else {
            $command = 'mysql -u' . $this->user . ' -h ' . $this->host .
                ' -D ' . $this->name . ' < ' . $file;
        }
        shell_exec($command);
        if ($insertToDb) {
            $query = 'INSERT INTO `' . $this->stateTable . '` (`name`) VALUES ("' . basename($file) . '")';
            $this->database->execute($query);
        }
        if ($insertToDb = false) {
            $this->database->execute($file);
        }

    }

    private function getOldFiles()
    {
        $oldFiles = array();
        if ($this->isEmpty()) {
            return $oldFiles;
        }
        $query = 'SELECT `name` FROM `' . $this->stateTable . '` WHERE 1';
        $rows = $this->database->fetchAll($query);
        foreach ($rows as $row) {
            $oldFiles[] = $this->sqlDir . $row['name'];
        }

        return $oldFiles;
    }

    private function getNewFiles()
    {

        $items = scandir($this->sqlDir);
        $allFiles = array();
        foreach ($items as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            $allFiles[] = $this->sqlDir . $item;
        }

        $oldFiles = $this->getOldFiles();

        return array_diff($allFiles, $oldFiles);
    }


    private function isEmpty()
    {
        $query = 'SHOW TABLES';
        $rows = $this->database->fetchAll($query);
        return empty($rows);
    }

    private function getMigrationName($path)
    {
        return $path;
    }

    private function confirm($message)
    {
        echo $message . ' (yes|no) [yes]: ';
        $input = trim(fgets(STDIN));
        return !strncasecmp($input, 'y', 1);
    }


}