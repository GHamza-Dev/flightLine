<?php

class FlightController extends Controller{

    public function __construct($model = 'Flight'){
        parent::__construct($model);
    }

    public function index(){
        $this->getFlights();
    }

    public function getFlights(){
        $this->data['flights'] = $this->model->selectFlights();
        $this->data['title'] = 'FlightLine || Flights';
        $this->view('admin.views/flights',$this->data);
    }

    public function removeFlight($params = []){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($params['flightId']) && !empty($params['flightId'])) {
                if ($this->model->deleteFlight($params['flightId'])) {
                    $this->data['alert'] = 'Flight removed successfully';
                }else {
                    $this->data['alert'] = 'Ops somthing went wrong!';
                    $this->data['err'] = true;
                }
            }
        }
        $this->getFlights();
    }

    public function upda


}