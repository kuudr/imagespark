<?php

namespace Migrations;

class Migration {

    private $host;
    private $name;
    private $user;
    private $pass;
    private $stateTable;
    private $sqlDir;
    private $database;

    public function __construct($host, $name, $user, $pass, $stateTable, $sqlDir = 'SQL') {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->pass = $pass;
        $this->stateTable = $stateTable;
        $this->sqlDir = str_replace('\\', '/', realpath($sqlDir)) . '/';
        Database::init($host, $name, $user, $pass);
        $this->database = Database::getInstance();
    }


    public function migrate() {

        // получаем список файлов для миграции
        $files = $this->getNewFiles();

        if (empty($files)) {
            echo "База данных в последнем состоянии \n";
            return;
        }

        echo "Начало миграции \n ", PHP_EOL;
        foreach ($files as $file) {
            $this->execute($file);
            echo "Выполнение файла: ", basename($file), PHP_EOL;
        }

        echo "Миграция выполнена \n";
    }

    public function state() {
        // выводим список старых файлов
        $oldFiles = $this->getOldFiles();
        echo 'Старые файлы: ' . $this->sqlDir . ':';
        if (!empty($oldFiles)) {
            $i = 1;
            foreach ($oldFiles as $file) {
                echo PHP_EOL, '    ', $i, '. ', basename($file);
                $i++;
            }
        } else {
            echo PHP_EOL, '    Старые файлы не найдены';
        }
        // выводим список новых файлов
        $newFiles = $this->getNewFiles();
        echo PHP_EOL, 'Новые файлы в папке: ' . $this->sqlDir . ':';
        if (!empty($newFiles)) {
            $i = 1;
            foreach ($newFiles as $file) {
                echo PHP_EOL, '    ', $i, '. ', basename($file);
                $i++;
            }
        } else {
            echo PHP_EOL, '    Новые файлы не найдены';
        }
    }

    private function getOldFiles() {
        $oldFiles = array();
        if ($this->isEmpty()) {
            return $oldFiles;
        }
        $query = 'SELECT `name` FROM `'.$this->stateTable.'` WHERE 1';
        $rows = $this->database->fetchAll($query);
        foreach ($rows as $row) {
            $oldFiles[] = $this->sqlDir . $row['name'];
        }
        return $oldFiles;
    }

    private function getNewFiles() {
        // получаем список всех sql-файлов
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

    //Занесение старых файлов
    private function execute($file) {
        if ($this->pass != '') {
            $command = 'mysql -u' . $this->user . ' -p' . $this->pass . ' -h ' . $this->host .
                ' -D ' . $this->name . ' < ' . $file;
        } else {
            $command = 'mysql -u' . $this->user . ' -h ' . $this->host .
                ' -D ' . $this->name . ' < ' . $file;
        }
        shell_exec($command);
        $query = 'INSERT INTO `' . $this->stateTable . '` (`name`) VALUES ("' . basename($file) . '")';
        $this->database->execute($query);
    }

    private function isEmpty() {
        $query = 'SHOW TABLES';
        $rows = $this->database->fetchAll($query);
        return empty($rows);
    }

}