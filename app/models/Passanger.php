<?php

class Passanger extends BaseModel{

    public function __construct($tableName = 'passanger',$primaryKey = 'passengerID'){
        parent::__construct($tableName,$primaryKey);
    }

    public function insertPassenger($resId,$firstName,$lastName,$birthDay){
        $this->db->prepareQuery("INSERT INTO $this->table(`reservationID`, `firstName`, `lastName`, `birthDay`) VALUES (?, ?, ?, ?)");
        return $this->db->execute([$resId,$firstName,$lastName,$birthDay]);
    }

    public function updatePassanger($id,$fname,$lname,$bdate){
        $this->db->prepareQuery("UPDATE $this->table 
        SET `firstName` = ? , `lastName` = ? ,`birthDay` = ?
        WHERE $this->table.$this->primaryKey = ?");
        return $this->db->execute([$fname,$lname,$bdate,$id]);
    }

}