<?php

   // ROOT Directory
   define('ROOT', getcwd());
   // Application path
   define('APPLICATION_PATH', ROOT.DS.'app');
   // Config path
   define('CONFIG_PATH', ROOT.DS.'config');
   // core path
   define('CORE_PATH', ROOT.DS.'core');
   // Public path
   define('PUBLIC_PATH', ROOT.DS.'public');

   // Sub directories
   define('VIEWS_PATH', APPLICATION_PATH.DS.'views');
   
   // Uploads path
   define('UPLOADS',ROOT.DS.'uploads');   

   // Database params
   define('DB_NAME','flightlight');
   define('DB_USER','root');
   define('DB_HOST','localhost');
   define('DB_PASSWD','');

   // URL ROOT
   define('URLROOT', 'http://localhost/');

   // Images url
   define('IMAGES', URLROOT.'/public/images');

   
   