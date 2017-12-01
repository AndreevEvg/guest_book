<?php

spl_autoload_register(function($class_name){
    include ROOT . "/lib/" . $class_name . ".class.php";
});

