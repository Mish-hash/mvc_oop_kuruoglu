<?php

    require_once 'vendor/autoload.php';
    // var_dump($_GET['url']);    
    spl_autoload_register(function($class){
        require_once 'src/' . $class . '.php';
    });

    services\Route::start(); //статический метод


?>
