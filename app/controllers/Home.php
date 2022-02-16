<?php

class Home extends Controller{
    

    public function __construct(){

    }

    public function index(){
        $this->loadView('index',[]);
    }
    
    public function hi($name = ''){
        echo "<h1>Hello $name</h1>";
    }

    public function _404(){
        $this->loadView('404',[]);
    }
}