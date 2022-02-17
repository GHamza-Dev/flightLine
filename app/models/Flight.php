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

    public function selectFlights(){
        return $this->db->select($this->table);
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