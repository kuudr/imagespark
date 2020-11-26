<?php
namespace Core;
use Core\Router;

class Model {

    protected $storageDirectoryPath;

    protected $attributes = [

    ];


    public function getAll() {
        $files = array();
        foreach (glob($this->storageDirectoryPath . "/*.json") as $jsonFilePath) {
            $file = json_decode(file_get_contents($jsonFilePath), true);
            $files[] = $file;
//            var_dump($files);

        }
        return $files;
    }



    protected function putJson($fileId, $data){

        return file_put_contents($this->storageDirectoryPath . $fileId . '.json'  , json_encode($data, JSON_PRETTY_PRINT));
    }

    protected function create($data)
    {

        $id = $this->attributes['id'] = uniqid();
        $this->attributes = $data;
        $this->putJson($id, $data);

    }

    protected function delete($id)
    {


    }

    protected function update($id)
    {

    }

    protected function getById()
    {

    }
}

