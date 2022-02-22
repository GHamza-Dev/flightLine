<?php

class Booking extends BaseModel{

    public function __construct($tableName = 'reservation',$primaryKey = 'reservationID'){
        parent::__construct($tableName,$primaryKey);
    }

    public function selectBookings(){
        $this->db->prepareQuery("SELECT * FROM `user` JOIN $this->table on `user`.`userID` = $this->table.`userID` JOIN flight ON flight.flightID = reservation.flightID");
        $this->db->execute();
        return $this->db->getResult();
    }

    

}