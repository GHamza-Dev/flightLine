<?php

class BookingController extends Controller{

    public function __construct($model = 'Booking'){
        parent::__construct($model);
    }

    public function index(){
        $this->bookings();
    }

    public function bookings(){
        $bks = $this->model->selectBookings();
        $this->data['bookings'] = $bks;
        // dump($bks);return;
        $this->view('admin.views/bookings',$this->data);
    }
}