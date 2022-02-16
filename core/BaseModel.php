<?php

class BaseModel{
    protected $db = null;
    protected $table = null;
    protected $id = null;

    public function __construct($table,$id){
        $this->table = $table;
        $this->id = $id;
        $this->db = new Database();
    }
}