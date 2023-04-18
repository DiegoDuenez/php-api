<?php

namespace Utilities;

use Database\Database;
use Exception;

class Model extends Database{

    protected $table = "";

    protected $primaryKey = "id";

    public $query = "";

    public $statment = "";


    public function all(Array $columns = null)
    {
        if($columns){
            $columns = implode(',' , $columns);
            $this->query = "SELECT $columns FROM $this->table ";
            return $this->read($this->query);
        }
        else{
            $this->query = "SELECT * FROM $this->table ";
            return $this->read($this->query);
        }
    }

    public function getById(int $id)
    {

        try{

            if($id <= 0){
                throw new Exception("ID must be greater than zero");
            }
            else{

                $this->query = "SELECT * FROM $this->table WHERE id = $id LIMIT 1";
                return $this->read($this->query);

            }

        }catch(Exception $e){

            return $e->getMessage();

        }

    }


    public function select($query)
    {

        $this->query = $query;

    }

    public function get()
    {
        $this->read($this->query);
    }

    public function exec()
    {
        $this->execute($this->statment, []);
    }
}