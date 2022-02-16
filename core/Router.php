<?php

class Router{

  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  function __construct()
  {
    
    $url = $this->getRequestedUrl();

    if (isset($url[0]) && file_exists(APPLICATION_PATH . '/controllers/' . $url[0] . '.php')) {
      $this->controller = $url[0];
      unset($url[0]);
    }

    require_once APPLICATION_PATH . '/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[1]) && method_exists($this->controller, $url[1])) {
      $this->method = $url[1];
      unset($url[1]);
    }

    $this->params = $url;

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  /**
   * 
   * Get the url the requested url
   * @return array 
   * 
   */

  public function getRequestedUrl()
  {
    return isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : ['home', 'index'];
  }
}
