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
        $this->data['nbrOfAvSeats'][] = $flightMdl->nbrOfAvSeats($params['flightId']);
        $this->data['nbrOfAvSeats'][] = $params['rFlightId'] ? $flightMdl->nbrOfAvSeats($params['rFlightId']): false;
        $this->data['flightId'] = $params['flightId'];
        $this->data['rFlightId'] = $params['rFlightId'];
        $this->data['userId'] = id();
        $this->view('user.views/pages/reserve',$this->data);
    }

    public function _reservePassanger($bookingId,$params){
        $fname = $params['fname'];
        $lname = $params['lname'];
        $bdate = $params['date'];
        $nbrOfPassangers = count($fname);
        $passangerMdl = $this->getModelInstance('Passanger');
        $i = 0;
        foreach ($fname as $fn) {
            $passangerMdl->insertPassenger($bookingId,$fn,$lname[$i],$bdate[$i]);
            $i++;
        }
        return ($nbrOfPassangers == $i) ? $i : false;
    }

    public function _updateReservedPlaces($flightId,$nbr){
        $flightMdl = $this->getModelInstance('Flight');
        $flightMdl->updateReservedPlaces($flightId,$nbr);  
    }

    public function reserve($params = []){
        Auth::check();
        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {header("HTTP/1.0 404 Not Found");exit;}

        if (isset($params['flightId'])) {
            $this->_reserve($params);
            return;
        }
                
        if(isset($params['book']) && !empty($params['reserveUser']) && !empty($params['reserveFlight1'])){
            
            $user_id = $params['reserveUser'];
            $flight_id1 = $params['reserveFlight1'];
            $flight_id2 = $params['reserveFlight2'];
            
            $err = true;
            
            $lastInsertedId1 = $flight_id1 ? $this->model->insertBooking($user_id,$flight_id1) : false;
            $lastInsertedId2 = $flight_id2 ? $this->model->insertBooking($user_id,$flight_id2) : false;
            
            if(!$lastInsertedId1) {
                $this->data['alert'] = "Ops something went wrong";
                $this->data['err'] = true;  
                $this->view('user.views/pages/home',$this->data);
                return;
            }
            
            if ($i = $this->_reservePassanger($lastInsertedId1,$params)) {
                $this->_updateReservedPlaces($flight_id1,$i);
                $err = false;
            }
            
            if(!$flight_id2) {
                $this->data['alert'] = $err ? "Ops something went wrong" : "Congratulations you have successfully booked a ticket";
                $this->data['err'] = $err;  
                $this->view('user.views/pages/home',$this->data); 
                return;
            }

            if(!$lastInsertedId2 || $err) {
                $this->data['alert'] = "Ops something went wrong";
                $this->data['err'] = true;  
                $this->view('user.views/pages/home',$this->data);
                return;
            }

            $err = true;

            if ($i = $this->_reservePassanger($lastInsertedId2,$params)) {
                $this->_updateReservedPlaces($flight_id2,$i);
                $err = false;
            }

            $this->data['alert'] = $err ? "Ops something went wrong" : "Congratulations you have successfully booked a ticket";
            $this->data['err'] = $err;  
            $this->view('user.views/pages/home',$this->data);

        }
    }

    public function mybookings(){
        Auth::check();
        $myBookings = $this->model->selectUserBookings(id());
        $this->data['bookings'] = $myBookings;
        $this->view('user.views/pages/bookings',$this->data);
    }

    private function somethingWentWrong(){
        $this->data['err'] = true;
        $this->data['alert'] = 'Ops something went wrong';
        $this->view('user.views/pages/booking',$this->data);
        exit;
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

        $this->somethingWentWrong();

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

        $this->somethingWentWrong();
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

        $this->somethingWentWrong();
    }
}