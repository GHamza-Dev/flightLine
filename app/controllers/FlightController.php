<?php

class FlightController extends Controller{

    public function __construct($model = 'Flight'){
        parent::__construct($model);
    }

    public function index(){
        $this->view('user.views/pages/home',[]);
    }

    private function loadTable(){
        $this->data['title'] = 'FlightLine || Flights';
        $this->view('admin.views/flights',$this->data);
    }

    public function getFlights($params = []){
        Auth::check('admin');
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
        Auth::check('admin');
        $column = $value = '1';

        if (!empty($params['value']) && !empty($params['select'])) {
            $column = $params['select'];
            $value = $params['value'];
        }

        $this->data['flights'] = $this->model->selectNextFlights($column,$value);
        $this->data['search-form'] = VIEWS.'/inc/forms/search.next.php';
        $this->loadTable();
    }

    public function availableFlights($params = []){
        $columns = [];
        $values = [];
        if(!empty($params['from'])){
            $columns[] = 'aFrom';
            $from = $params['from'];
            $values[] = "%$from%";
        }
        if(!empty($params['to'])){
            $columns[] = 'aTo';
            $to = $params['to'];
            $values[] = "%$to%";
        }
        if(!empty($params['depart'])){
            $columns[] = 'departTime';
            $depArr = explode('T',$params['depart']);
            $dep = $depArr[0].' '.$depArr[1];
            $values[] = "%$dep%";
        }
        if(!empty($params['arrival'])){
            $columns[] = 'arrivalTime';
            $arArr = explode('T',$params['arrival']);
            $ar = $arArr[0].' '.$arArr[1];
            $values[] = "%$ar%";
        }

        $avf = $this->model->selectAvFlights($columns,$values);
        echo json_encode($avf);
    }

    public function returnFlights($id = 0){
        $rFlghts = $this->model->selectReturnFlights($id);
        echo json_encode($rFlghts);
    }

    public function availableSeats($params = []){
        // $nbr = $this->model->nbrOfAvSeats($params['flightId']);
        
        echo json_encode($_POST);
    }

    public function removeFlight($params = []){
        Auth::check('admin');
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

    private function loadAddForm(){
        $this->data['title'] = 'Add flight';
        $this->view('admin.views/add-flight',$this->data);
    }

    public function addFlight($params = null){
        Auth::check('admin');
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

    private function loadUpdateForm($id){
        $flight = $this->model->selectFlightById($id);
        $this->data['flight'] = $flight;
        $this->data['title'] = 'Update flight';
        $this->view('admin.views/update-flight',$this->data);
    }

    public function updateFlight($params = []){
        Auth::check('admin');
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