<?php
namespace Core;
use Core\Router;

class Model {

    protected $storageDirectoryPath;

    protected $attributes = [];

    protected function getAll() {
        if ($this->storageDirectoryPath == null) {
            throw new \Exception('Директория для хранения данных не указана');
        }
        $dir = scandir($this->storageDirectoryPath);
    }

    protected function create()
    {

    }

    protected function delete()
    {

    }

    protected function update()
    {

    }

    protected function getById()
    {

    }
}

