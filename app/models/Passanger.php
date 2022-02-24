<?php

class Passanger extends BaseModel{

    public function __construct($tableName = 'passanger',$primaryKey = 'passengerID'){
        parent::__construct($tableName,$primaryKey);
    }

    public function insertPassenger($resId,$firstName,$lastName,$birthDay){
        $this->db->prepareQuery("INSERT INTO $this->table(`reservationID`, `firstName`, `lastName`, `birthDay`) VALUES (?, ?, ?, ?)");
        return $this->db->execute([$resId,$firstName,$lastName,$birthDay]);
    }

}