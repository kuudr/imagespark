<?php
namespace Migrations;
use PDO;
class Database {

    private static $instance;

    private $pdo;

    public static function init($host, $database, $user, $password) {
        self::$instance = new self($host, $database, $user, $password);
    }

    public static function getInstance() {
        return self::$instance;
    }

    private function __construct($host, $database, $user, $password) {

        $this->pdo = new PDO(
            'mysql:host=' . $host . ';dbname=' . $database,
            $user,
            $password,
            array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
    }


    public function execute($query, $params = array()) {

        $statementHandler = $this->pdo->prepare($query);

        return $statementHandler->execute($params);
    }

    public function fetchAll($query, $params = array()) {
        $statementHandler = $this->pdo->prepare($query);
        $statementHandler->execute($params);
        $result = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}