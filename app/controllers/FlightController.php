<?php

class FlightController extends Controller{

    public function __construct($model = 'Flight'){
        parent::__construct($model);
    }

    public function index(){
        $this->getNextFlights();
    }

    public function loadTable(){
        $this->data['title'] = 'FlightLine || Flights';
        $this->view('admin.views/flights',$this->data);
    }

    public function getFlights($params = []){
        $atr = $val = [];

        if (!empty($params)){
            $atr = [$params['select']];
            $val = $params['value'];
            $val = ["%$val%"];
        }

        $this->data['flights'] = $this->model->selectFlights($atr,$val);
        $this->data['search-form'] = VIEWS.'/inc/forms/search.all.php';
        $this->loadTable();
    }

    public function getNextFlights($params = []){
        $column = $value = '1';

        if (!empty($params['value']) && !empty($params['select'])) {
            $column = $params['select'];
            $value = $params['value'];
        }

        $this->data['flights'] = $this->model->selectNextFlights($column,$value);
        $this->data['search-form'] = VIEWS.'/inc/forms/search.next.php';
        $this->loadTable();
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

    public function loadAddForm(){
        $this->data['title'] = 'Add flight';
        $this->view('admin.views/add-flight',$this->data);
    }

    public function addFlight($params = null){
        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
            $this->loadAddForm();
            return;
        }

        if (isset($params['addflight'])) {
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
                $this->loadAddForm();
                return;
            }
            
            $data = [$params['from'],$params['to'],$params['depart'],$params['arrival'],$params['price'],$params['seats'],null];
           
            if ($this->model->insertFlight($data)) {
                $this->data['alert'] = 'Flight added successfully';
                $this->loadAddForm();
            }else dump('Somthig went wrong');
        }
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