<?php

class BookingController extends Controller{

    public function __construct($model = 'Booking'){
        parent::__construct($model);
    }

    public function index(){
        Auth::check('admin');
        $this->bookings();
    }

    public function bookings(){
        Auth::check('admin');
        $bks = $this->model->selectBookings();
        $this->data['bookings'] = $bks;
        $this->view('admin.views/bookings',$this->data);
    }

    public function _reserve($params){
        Auth::check();
        $flightMdl = $this->getModelInstance('Flight');
        $this->data['nbrOfAvSeats'] = $flightMdl->nbrOfAvSeats($params['flightId']);
        $this->data['flightId'] = $params['flightId'];
        $this->data['userId'] = id();
        $this->view('user.views/pages/reserve',$this->data);
    }

    public function reserve($params = []){
        Auth::check();
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

    public function mybookings(){
        $myBookings = $this->model->selectUserBookings(id());
        $this->data['bookings'] = $myBookings;
        $this->view('user.views/pages/bookings',$this->data);
    }

    public function updatePassanger($params = []){
        Auth::check();
        if (!($_SERVER['REQUEST_METHOD'] === 'POST') || !isset($params['updatePsgr'])) {
            header('location:'.URLROOT.'booking/mybookings');
            exit;
        }

        $id = $params['updatePsgr'];
        $fname = $params['fname'];
        $lname = $params['lname'];
        $bdate = $params['bdate'];
        $psgrMdl = $this->getModelInstance('Passanger');

        if ($psgrMdl->updatePassanger($id,$fname,$lname,$bdate)) {
            header('location:'.URLROOT.'booking/mybookings');
            exit;
        }

        $this->data['err'] = true;
        $this->data['alert'] = 'Ops something went wrong';

        $this->view('user.views/pages/booking',$this->data);

    }

    public function removePassanger($params = []){
        Auth::check();
        if (!($_SERVER['REQUEST_METHOD'] === 'POST') || !isset($params['deletePsgr'])) {
            header('location:'.URLROOT.'booking/mybookings');
            exit;
        }
        $id = $params['deletePsgr'];
        $flight_id = $params['flightId'];
        $psgrMdl = $this->getModelInstance('Passanger');
        $flightMdl = $this->getModelInstance('Flight');
        
        if ($psgrMdl->deletePassanger($id)) {
            if ($flightMdl->decreaseReservedSeats($flight_id)) {
                header('location:'.URLROOT.'booking/mybookings');
                exit;
            }  
        }

        $this->data['err'] = true;
        $this->data['alert'] = 'Ops something went wrong';

        $this->view('user.views/pages/booking',$this->data);
    }

    public function cancelBooking($params = []){
        Auth::check();
        if (!($_SERVER['REQUEST_METHOD'] === 'POST') || !isset($params['bookingId'])) {
            header('location:'.URLROOT.'booking/mybookings');
            exit;
        }

        $id = $params['bookingId'];

        if($this->model->deleteBooking($id)){
            header('location:'.URLROOT.'booking/mybookings');
            exit;
        }

        $this->data['err'] = true;
        $this->data['alert'] = 'Ops something went wrong';

        $this->view('user.views/pages/booking',$this->data);
    }
}