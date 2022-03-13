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
    
    private function loadRegisterForm(){
        $this->view('register',$this->data);
    }

    private function validateForm($email,$pass){

        $email_err = empty($email) ? 'Email can not be empty!' : '';
        $pass_err = empty($pass) ? 'Password can not be empty!' : '';

        if (!empty($email_err) || !empty($pass_err)) {
            $this->data['email_err'] = $email_err;
            $this->data['pass_err'] = $pass_err;
            $this->loadLoginForm();
            exit;
        }
    }

    public function login($params =  []){

        $this->adminCheck();

        if (!($_SERVER['REQUEST_METHOD'] === 'POST') || !isset($params['email']) || !isset($params['passwd'])) {
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
                header('location:'.URLROOT.'flight/');
                return;
            }
        }

        $this->data['err'] = true;
        $this->data['alert'] = 'Email or password is incorrect!';
        $this->loadLoginForm();

    }

    private function adminCheck(){
        $allowedIps = ['192.168.8.107','127.0.0.1','::'];
        $currentIp = $_SERVER['REMOTE_ADDR'];

        if (in_array($currentIp,$allowedIps)) {
            new Auth($currentIp,'FlightLine','admin');
            header('location:'.URLROOT.'flight');
            exit;
        }
    }

    public function logout(){
        session_unset();
	    session_destroy();
        $this->redirect(URLROOT.'flight/');
        exit;
    }

    public function register($params = []){
        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
            $this->loadRegisterForm();
            return;
        }
        
        $data = [
            $params['nic'],
            $params['fname'],
            $params['lname'],
            $params['email'],
            $params['phone'],
            $params['pass']
        ];

        $this->data['err'] = true;
        $this->data['alert'] = 'Ops something went wrong please try again!';

        if ($this->model->insertUser($data)) {
           $this->data['err'] = false; 
           $this->data['alert'] = 'You have successfully registred';
        }

        $this->loadRegisterForm();

    }
    
}