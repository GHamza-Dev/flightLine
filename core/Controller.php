<?php

  /**
   * Controller class : base controller
   */
  class Controller{

    protected $modelInstance = null;

    function __construct(){
      
    }
    
    /**
     * Instantiate model
     * 
     * @param string $model
     * @return void
     * 
     */ 

    public function setModelInstance($model){
      if(file_exists(APPLICATION_PATH.DS.'models'.DS.ucwords($model).'.php')){
        require_once APPLICATION_PATH.DS.'models'.DS.ucwords($model).'.php';
        $this->modelInstance = new $model();
      }else die("Err : model '$model' does not exist <br><a href='".URLROOT."'>Go back</a>");
    }
    
    
    /**
     * Get model instance
     * 
     * @param string $model
     * @return object
     * 
     */

    public function getModelInstance($model){
      if(file_exists(APPLICATION_PATH.DS.'models'.DS.ucwords($model).'.php')){
        require_once APPLICATION_PATH.DS.'models'.DS.ucwords($model).'.php';
        return new $model();
      }else die("Err : model '$model' does not exist <br><a href='".URLROOT."'>Go back</a>");
    }

    /**
     * Load view
     * 
     * @param string $viewName [almost a string like 'books/addbook' where books is a folder]
     * @param array $data : data comes from db
     * 
     */

    public function loadView($viewName,$data = []){
      // --
      if(file_exists(APPLICATION_PATH.DS.'views'.DS.$viewName.'.php')) 
      require_once APPLICATION_PATH.DS.'views'.DS.$viewName.'.php';
      else die("Err : view '$viewName' does not exist <br><a href='".URLROOT."'>Go back</a>");
      //--
    }

    /**
     * 
     * This method prepare data for ajax calls
     * @param array $data to be prepared
     * @return void
     * 
     */
    public function jsonPrepare($data){
      // header("Access-Control-Allow-Origin: ".ORIGIN);
      header("Content-Type: application/json; charset=UTF-8");
      http_response_code(200);
      echo json_encode($data);
      exit;
    }

    /**
     * Redirect method
     * @param $path to redirect to
     * 
     */
     public function redirect($path){
      if (!empty($path)) {
        header('location:'.$path);
      }
    }
    
  }
