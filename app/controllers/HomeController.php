<?php

class HomeController extends Controller{
    

    public function __construct(){

    }

    public function index(){
        $this->view('user/index',[]);
    }
    
    public function hi($name = ''){
        echo "<h1>Hello $name</h1>";
    }

    public function _404(){
        $this->view('404',[]);
    }

    public function addUser(){
        $user = $this->getModelInstance('user');
        // $user->insertUser('HH123456','Hamza','Gassai','067398737','0000');
        // $user->insertUser(['BB123456','Yassine','Lamine','067398737','0000']);
        // $user->insertUser(['CC123456','Aymen','Traw','067398737','0000']);
        // $user->insertUser(['DD123456','Rihab','TAwil','067398737','0000']);
        echo 'Go to line ['.__LINE__.'] and complete the method :)';
    }

    function userExist(){
        echo '<pre>';
        $user = $this->getModelInstance('user');
        if ($u = $user->selectUserById(9)) {
            dump($u);
        }else echo 'User does not exist!';
    }

    function getUsers(){
        $user = $this->getModelInstance('user');
        dump($user->selectUsers());
    }

    public function testdeleteuser($id){
        $user = $this->getModelInstance('user');
        $user->deleteUser($id);
    }
    
    public function testInsertFlight(){
        $flight = $this->getModelInstance('flight');
        $flight->insertFlight(['Korea','Rowanda',date('Y-m-d h:i:s'),date('Y-m-d h:i:s'),3,12,2]); 
    }

    public function testUpdateFlight($id){
        $flight = $this->getModelInstance('flight');
        $data = ['Updated-A','Updated-A',date('Y-m-d h:i:s'),date('Y-m-d h:i:s'),3,12,2];
        $flight->updateFlight($data,$id);
    }

    public function testDeleteFlight($id){
        $flight = $this->getModelInstance('flight');
        $flight->deleteFlight($id);
    }

    public function testGetFlights(){
        $flight = $this->getModelInstance('flight');
        echo json_encode($flight->selectFlights());
    }

    public function flights(){
        $flight = $this->getModelInstance('flight');
        $flights = $flight->selectFlights();
        echo json_encode($flights);
    }

}