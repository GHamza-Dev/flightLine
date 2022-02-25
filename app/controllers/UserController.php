<?php

class UserController extends Controller{

    public function __construct($model = 'User'){
        parent::__construct($model);
    }

    public function index(){
        $this->view('user.views/pages/home');
    }

    private function loadLoginForm(){
        $this->view('login',$this->data);
    }

    private function validateForm($email,$pass){
        $err = [];
        $err['email'] = empty($email) ? 'Email can not be empty!' : '';
        $err['pass'] = empty($pass) ? 'Password can not be empty!' : '';

        if (!empty($err['email']) || !empty($err['pass'])) {
            $this->data['err'] = $err;
            $this->loadLoginForm();
            exit;
        }
    }

    public function login($params =  []){
        if (!($_SERVER['REQUEST_METHOD'] === 'POST') || !isset($params['email']) || !isset($params['password'])) {
            $this->loadLoginForm();
            return;
        }
        
        $email = $params['email'];
        $password = $params['passwd'];

        $this->validateForm($email,$password);

        if ($this->model->emailExist($email)) {
            if ($user = $this->model->userExist($email,$password)) {
                $username = $user['firstName'].' '.$user['lastName'];
                new Auth($user['userID'],$username);
                header('location:'.URLROOT.'flight/availableFlights');
                return;
            }
        }

        $this->data['err'] = 'Email or password is incorrect!';
        $this->loadLoginForm();

    }
    
}