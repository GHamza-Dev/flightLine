<?php

class BookingController extends Controller{

    public function __construct($model = 'Booking'){
        parent::__construct($model);
    }

    public function index(){
        // $this->bookings();
        dump(' ');
        dump($this->model->insertBooking(9,37));
    }

    public function bookings(){
        $bks = $this->model->selectBookings();
        $this->data['bookings'] = $bks;
        $this->view('admin.views/bookings',$this->data);
    }

    public function _reserve($params){
        $flightMdl = $this->getModelInstance('Flight');
        $this->data['nbrOfAvSeats'] = $flightMdl->nbrOfAvSeats($params['flightId']);
        $this->data['flightId'] = $params['flightId'];
        $this->data['userId'] = 12;
        $this->view('user.views/pages/reserve',$this->data);
    }

    public function reserve($params = []){
        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {header("HTTP/1.0 404 Not Found");exit;}

        if (isset($params['flightId'])) {
            $this->_reserve($params);
            return;
        }
        
        if(isset($params['book']) && !empty($params['reserveUser']) && !empty($params['reserveFlight'])){
            
            $user_id = $params['reserveUser'];
            $flight_id = $params['reserveFlight'];

            $passangerMdl = $this->getModelInstance('Passanger');
            $flightMdl = $this->getModelInstance('Flight');
            $lastInsertedId = $this->model->insertBooking($user_id,$flight_id);

            if($lastInsertedId){
                $fname = $params['fname'];
                $lname = $params['lname'];
                $bdate = $params['date'];
                $nbrOfPassangers = count($fname);
                $i = 0;
                foreach ($fname as $fn) {
                    $passangerMdl->insertPassenger($lastInsertedId,$fn,$lname[$i],$bdate[$i]);
                    $i++;
                }
                if ($nbrOfPassangers == $i) {
                    $flightMdl->updateReservedPlaces($flight_id,$i);    
                    $this->data['alert'] = "You have successfully booked $i tecket(s)";
                    $this->data['err'] = false;  
                    $this->data['avFlights'] = $flightMdl->selectAvFlights();          
                    $this->view('user.views/pages/home',$this->data);
                    return;
                }
            }
        }
    }
}