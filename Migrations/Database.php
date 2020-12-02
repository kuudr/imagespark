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
        // создаем новый экземпляр класса PDO
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
        // подготавливаем запрос к выполнению
        $statementHandler = $this->pdo->prepare($query);
        // выполняем запрос
        return $statementHandler->execute($params);
    }


    public function fetchAll($query, $params = array()) {
        $statementHandler = $this->pdo->prepare($query);
        $statementHandler->execute($params);
        $result = $statementHandler->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function fetch($query, $params = array()) {
        // подготавливаем запрос к выполнению
        $statementHandler = $this->pdo->prepare($query);
        // выполняем запрос
        $statementHandler->execute($params);
        // получаем результат
        $result = $statementHandler->fetch(PDO::FETCH_ASSOC);
        // возвращаем результат запроса
        return $result;
    }

    public function fetchOne($query, $params = array()) {
        // подготавливаем запрос к выполнению
        $statementHandler = $this->pdo->prepare($query);
        // выполняем запрос
        $statementHandler->execute($params);
        // получаем результат
        $result = $statementHandler->fetch(PDO::FETCH_NUM);
        // возвращаем результат запроса
        if (false === $result) {
            return false;
        }
        return $result[0];
    }

    public function lastInsertId() {
        return (int)$this->pdo->lastInsertId();
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollBack() {
        return $this->pdo->rollBack();
    }
}