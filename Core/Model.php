<?php
namespace Core;
use data\dbConn;
use PDO;
abstract class Model {


    protected $record;
    protected $table;
    protected $columns;

    public function __construct($record)
    {
        $this->record = $record;

    }


    protected static function setDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . dbConn::HOST . ';dbname=' . dbConn::DB_NAME . ';   charset=utf8';
            $db = new PDO($dsn, dbConn::DB_USER, dbConn::DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        }

        return $db;
    }


    public function getFromDB()
    {

        $db = self::setDB();

        $getFromDB = $db->query("SELECT * FROM $this->table");

        return $getFromDB->fetchAll(PDO::FETCH_ASSOC);

    }


    public function get()
    {

        $db = self::setDB();

        $query = $db->query("SELECT $this->columns FROM $this->table WHERE id = $this->record");

        foreach ($query as $render){
            return $render;
        }

    }

    public function putDB($data)
    {

        $db = self::setDB();

        $values = implode(',', $data);

        $query = "INSERT INTO $this->table ($this->columns) VALUES ($values)";

        $db->query($query);

    }


    public function delete()
    {

        $db = self::setDB();

        $query = ("DELETE FROM $this->table WHERE id = $this->record");

        return $db->query($query);

    }

}

