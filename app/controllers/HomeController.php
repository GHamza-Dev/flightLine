<?php

class HomeController extends Controller{

    public function __construct($model = 'User'){
        parent::__construct($model);
    }

    public function index(){
        $this->view('index',[]);
    }
    
}