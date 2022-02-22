<?php

class Flight extends BaseModel{

    public function __construct($tableName = 'flight',$primaryKey = 'flightID'){
        parent::__construct($tableName,$primaryKey);
    }

    public function insertFlight($data){
        $params = [
            'aFrom'=> $data[0],
            'aTo'=> $data[1],
            'departTime'=> $data[2],
            'arrivalTime'=> $data[3],
            'price' => $data[4],
            'nbrPlaces'=> $data[5],
            'reservedPlaces'=> $data[6]
        ];
        return $this->db->insert($this->table,$params);
    }

    public function selectFlights($columns = [],$values = []){
        return $this->db->select($this->table,$columns,$values);
    }

    public function selectNextFlights($column = 1,$value = 1){
        $this->db->prepareQuery("SELECT * FROM $this->table WHERE `departTime` > NOW() AND $column LIKE ?");
        $this->db->execute(["%$value%"]);
        return $this->db->getResult();
    }

    public function selectFlightById($id){
        $this->db->prepareQuery("SELECT * FROM $this->table WHERE $this->primaryKey = ?");
        $this->db->execute([$id]);
        return $this->db->getRow();
    }

    public function updateFlight($data,$id){
        $params = [
            'aFrom'=> $data[0],
            'aTo'=> $data[1],
            'departTime'=> $data[2],
            'arrivalTime'=> $data[3],
            'price' => $data[4],
            'nbrPlaces'=> $data[5],
            'reservedPlaces'=> $data[6]
        ];
        return $this->db->update($this->table,$this->primaryKey,$id,$params);
    }

    public function deleteFlight($id){
        return $this->db->delete($this->table,$this->primaryKey,$id);
    }

}