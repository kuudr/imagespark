<?php
namespace Core;
use data\dbConn;
use PDO;
abstract class Model {

    protected $record;

    protected $storageDirectoryPath;
    protected $table;
    protected $valuesToRender;
    protected $columnsToInsert;
    protected $attributes = [];
    protected $columnsToUpdate = [];

    public function __construct()
    {
        $this->record = $this->getId();
    }


    protected static function setDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . dbConn::HOST . ';dbname=' . dbConn::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, dbConn::DB_USER, dbConn::DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        }

        return $db;
    }


    protected function getFromDB()
    {

        $table = $this->table;

        $db = self::setDB();

        $getFromDB = $db->query("SELECT * FROM $table");

        return $getFromDB->fetchAll(PDO::FETCH_ASSOC);

    }


    protected function get()
    {
        $table = $this->table;

        $valuesToRender = $this->valuesToRender;

        $db = self::setDB();

        $query = $db->query("SELECT $valuesToRender FROM $table WHERE id = $this->record");

        foreach ($query as $render){
            return $render;
        }

    }

    protected function putDB($data)
    {

        $db = self::setDB();

        $columnsToInsert = $this->columnsToInsert;

        $values = implode(',', $data);

        $query = "INSERT INTO $this->table ($columnsToInsert) VALUES ($values)";

        $db->query($query);

    }


    protected function delete()
    {

        $table = $this->table;

        $db = self::setDB();

        $query = ("DELETE FROM $table WHERE id = $this->record");

        $db->query($query);

    }


    public function update($data)
    {
        $table = $this->table;

        $id = $this->record;

        $db = self::setDB();

        var_dump($data);

        $query = "UPDATE" . $table .
            "SET article_name = :article_name, text = :text
             WHERE id = :id";

        $db->query($query, [
            'id' => $id,
            'text' => $data['text'],
            'article_name' => $data['article_name']
        ]);
    }




    public function getId(){
        $parseUri = explode('/',$_SERVER['REQUEST_URI']);
        if (isset($parseUri[2])){
            return $parseUri[2];
        }
    }

}

