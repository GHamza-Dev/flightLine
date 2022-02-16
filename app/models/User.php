<?php


class User extends BaseModel{

    public function __construct($tableName = 'user',$parimaryKey = 'userID'){
        parent::__construct($tableName,$parimaryKey);
    }

    public function insertUser($nic,$firstName,$lastName,$phone,$password){
        return $this->db->insert($this->table,
            ['nic','firstName','lastName','phone','password'],
            [$nic,$firstName,$lastName,$phone,$password]
        );
    }


}