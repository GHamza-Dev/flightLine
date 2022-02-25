<?php

class HomeController extends Controller{

    public function __construct($model = 'User'){
        parent::__construct($model);
    }

    public function index(){
        Auth::check();
        $this->view('index',[]);
    }
    
}