<?php
namespace Migrations;
class Migration {

    private $host;
    private $name;
    private $user;
    private $pass;
    private $stateTable;
    private $dbDownDir;
    private $sqlDir;

    private $database;

    public function __construct($host, $name, $user, $pass, $stateTable, $sqlDir = 'dbUp', $dbDownDir = 'dbDown') {
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


    public function up() {

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

    public function down() {

        $files = $this->getNewFilesToDown();

        if (empty($files)) {
            echo "Нечего откатывать \n";
            return;
        }

        echo "Начало отката \n ", PHP_EOL;
        foreach ($files as $file) {
            $this->execute($file);
            echo "Выполнение файла отката: ", basename($file), PHP_EOL;
        }

        echo "Откат выполнен! \n";

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
            $oldFiles[] = $this->dbDownDir . $row['name'];
        }
        return $oldFiles;
    }

    private function getNewFiles() {

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

    private function getNewFilesToDown() {

        $items = scandir($this->dbDownDir);
        $allFiles = array();
        foreach ($items as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            $allFiles[] = $this->dbDownDir . $item;
        }

        $oldFiles = $this->getOldFiles();

        return array_diff($allFiles, $oldFiles);
    }

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