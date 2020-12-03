<?php
namespace Migrations;
use Core\Model;

class Migration
{

    private $db;
    private $host;
    private $name;
    private $user;
    private $pass;
    private $stateTable;
    private $sqlDir;
    private $backupDir;
    private $database;


    public function __construct($host, $name, $user, $pass, $stateTable, $sqlDir = 'Migrations/sqls', $backupDir = 'Migrations/backup')
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->pass = $pass;
        $this->stateTable = $stateTable;
        $this->sqlDir = str_replace('\\', '/', realpath($sqlDir)) . '/';
        $this->backupDir = str_replace('\\', '/', realpath($backupDir)) . '/';

        Database::init($host, $name, $user, $pass);
        $this->database = Database::getInstance();
    }

    public function migrate()
    {

        $files = $this->getNewFiles();

        if (empty($files)) {
            echo "База данных в последнем состоянии \n ";
            return;
        }

        if (!$this->isEmpty()) {
            $this->backup();
            echo PHP_EOL;
        }

        echo "Начало миграции \n", PHP_EOL;
        foreach ($files as $file) {
            $this->execute($file);
            echo 'Выполнение файла ', basename($file), PHP_EOL;
        }

        echo "Миграция базы данных выполнена \n";
    }


    public function backup()
    {
        if ($this->isEmpty()) {
            echo 'Не найдено таблиц в БД';
            return;
        }
        echo 'Создание бэкапа текущего состояния';
        $backupName = $this->backupDir . $this->name . '-' . date('d.m.Y-H.i.s') . '.sql';
        if ($this->pass != '') {
            $command = 'mysqldump -u' . $this->user . ' -p' . $this->pass . ' -h ' . $this->host .
                ' -B ' . $this->name . ' > ' . $backupName;
        } else {
            $command = 'mysqldump -u' . $this->user . ' -h ' . $this->host .
                ' -B ' . $this->name . ' > ' . $backupName;
        }
        shell_exec($command);
    }

    public function restore()
    {
        $backupName = $this->choose();
        if (false === $backupName) {
            return;
        }
        if (!$this->isEmpty()) {
            $this->backup();
            echo PHP_EOL;
        }
        $query = 'SHOW TABLES';
        $rows = $this->database->fetchAll($query);
        foreach ($rows as $row) {
            $query = 'DROP TABLE `' . $row['Tables_in_' . $this->name] . '`';
            $this->database->execute($query);

        }
        echo "Восстановление БД из резервной копии \n";
        if ($this->pass != '') {
            $command = 'mysql -u' . $this->user . ' -p' . $this->pass . ' -h ' . $this->host .
                ' -D ' . $this->name . ' < ' . $backupName;
        } else {
            $command = 'mysql -u' . $this->user . ' -h ' . $this->host .
                ' -D ' . $this->name . ' < ' . $backupName;
        }
        shell_exec($command);
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

    private function execute($file)
    {
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

    private function isEmpty()
    {
        $query = 'SHOW TABLES';
        $rows = $this->database->fetchAll($query);
        return empty($rows);
    }


    private function choose()
    {
        $items = scandir($this->backupDir);
        if (count($items) == 2) {
            echo "Не найдено файлов резервных копий \n", PHP_EOL;
            return false;
        }
        echo 'Выберите файл резервной копии:', PHP_EOL;
        $i = 0;
        $numbers = array();
        foreach ($items as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            $i++;
            $numbers[] = $i;
            echo $i, '. ', $item, PHP_EOL;
        }
        while (true) {
            echo 'Введите номер файла резервной копии: ';
            $number = fgets(STDIN);
            if (in_array($number, $numbers)) {
                break;
            }
        }
        $i = 0;
        foreach ($items as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            $i++;
            if ($i == $number) {

                return $this->backupDir . $item;
            }
        }
    }

    public function make($name, $time) {

        file_put_contents($this->sqlDir . '/' . (string) $time . '_' . $name . '.sql', '');

    }

}