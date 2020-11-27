<?php
namespace Core;

abstract class Model {

    protected $storageDirectoryPath;


    protected $attributes = [

    ];


    public function getAll() {
        $files = array();
        foreach (glob($this->storageDirectoryPath . "/*.json") as $jsonFilePath) {
            $file = json_decode(file_get_contents($jsonFilePath), true);
            $files[] = $file;

        }
        return $files;
    }



    protected function putJson($fileId, $data){

        return file_put_contents($this->storageDirectoryPath . $fileId . '.json'  , json_encode($data, JSON_PRETTY_PRINT));
    }

    protected function create($data)
    {

        $id = $this->attributes['id'] = uniqid();

        $data['id'] = $id;

        $this->attributes = $data;

        $this->putJson($id, $data);

    }

    protected function update($data)
    {
        $file = $this->getUserId() . '.json';

        $fileUpdate = $this->storageDirectoryPath . $file;

        if (file_put_contents($fileUpdate, json_encode($data))){

            return $data['id'];
        }
        return false;

    }




    public function get()
    {

        $file = $this->getUserId() . '.json';

        $path = $this->storageDirectoryPath;

        $resultView = [(json_decode(file_get_contents($path . $file) , true))];

        foreach ($resultView as $file){
            return $file;
        }

    }



    public function getUserId(){

        $parseUri = explode('/',$_SERVER['REQUEST_URI']);

        $userId = $parseUri[2];

        return $userId;
    }




    public function delete()
    {

        $file = $this->getUserId() . '.json';

        $fileRemove = $this->storageDirectoryPath . $file;

        if (file_exists($fileRemove)){

            unlink($fileRemove);
        }

    }

}

