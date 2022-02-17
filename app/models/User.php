<?php


class User extends BaseModel{

    public function __construct($tableName = 'user',$primaryKey = 'userID'){
        parent::__construct($tableName,$primaryKey);
    }

    public function insertUser($data){
        $params = [
            'nic'=> $data[0],
            'firstName'=> $data[1],
            'lastName'=> $data[2],
            'phone'=> $data[3],
            'password' => $data[4]
        ];
        return $this->db->insert($this->table,$params);
    }

    public function selectUserById($id){
        $this->db->prepareQuery("SELECT * FROM $this->table WHERE $this->primaryKey = ?");
        return $this->db->execute([$id]) ? $this->db->getRow() : false;
        
    }

    public function selectUsers(){
        return $this->db->select($this->table);
    }

    

}