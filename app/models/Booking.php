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

    public function insertBooking($userId,$flightId){
        $params = [
            'userID' => $userId,
            'flightID' => $flightId,
            'date' => date('Y-m-d h:i:s')
        ];
        return $this->db->insert($this->table,$params) ? $this->db->lastInsertId() : false;
    }

    public function selectUserBookings($id){
        $this->db->prepareQuery(
        "SELECT user.userID , reservation.*,passanger.*,flight.* 
        FROM flight JOIN (user JOIN reservation ON reservation.userID = user.userID) 
        ON flight.flightID = reservation.flightID JOIN passanger ON passanger.reservationID = reservation.reservationID 
        WHERE user.userID = ? AND flight.departTime > NOW()");

        $this->db->execute([$id]);
            
        return $this->db->getResult();
    }

}