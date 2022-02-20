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

    public function loadUpdateForm($id){
        $flight = $this->model->selectFlightById($id);
        $this->data['flight'] = $flight;
        $this->data['title'] = 'Update flight';
        $this->view('admin.views/update-flight',$this->data);
    }

    public function updateFlight($params = []){

        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
            $this->redirect(URLROOT);
            exit;
        }

        if (isset($params['flightId'])) {
            $this->loadUpdateForm($params['flightId']);
        }else if(isset($params['update'])){

            $error = [];

            if (empty($params['from'])) 
                $error['from_err'] = '*This feild is required'; 

            if (empty($params['to'])) 
                $error['to_err'] = '*This feild is required';

            if (empty($params['depart'])) 
                $error['depart_err'] = '*This feild is required';
            

            if(empty($params['arrival'])) 
                $error['arrival_err'] = '*This feild is required';
            

            if (!filter_var($params['price'],FILTER_VALIDATE_FLOAT)) 
                $error['price_err'] = '*Please provide a valide number';
            
            if (!filter_var($params['seats'],FILTER_VALIDATE_INT)) 
                $error['seats_err'] = '*Please provide a valide number';
            

            if (!empty($error)) {
                $this->data['error'] = $error;
                $this->loadUpdateForm($params['id']);
                return;
            }
            
            $data = [$params['from'],$params['to'],$params['depart'],$params['arrival'],$params['price'],$params['seats'],null];
           
            if ($this->model->updateFlight($data,$params['id'])) {
                $this->data['alert'] = 'Flight updated successfully';
                $this->view('admin.views/update-flight',$this->data);
            }

        }
    }

}