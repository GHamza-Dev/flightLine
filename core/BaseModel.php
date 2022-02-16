<?php

class BaseModel{
    protected $db = null;
    protected $table = null;
    protected $primaryKey = null;

    public function __construct($table,$primaryKey){
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->db = new Database();
    }
}