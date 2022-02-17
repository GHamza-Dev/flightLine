<?php

class HomeController extends Controller{
    

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

    public function testPost(){
        dump($_POST);
    }
}