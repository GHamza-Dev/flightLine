<?php
session_start();
//session_regenerate_id();

// Define the directory deparator
define('DS', DIRECTORY_SEPARATOR);
require_once './config/config.php';
require_once ROOT.'/helpers/filter.php';

//! Only for debugging
require_once './dump.php';

// Autoload core classes
spl_autoload_register(function($className){
  try {
    if(file_exists(CORE_PATH.DS.$className.'.php'))
    require_once CORE_PATH.DS.$className.'.php';
  } catch (Exception $e) {
    die($e->getMessage());
  }
});


new Router();
