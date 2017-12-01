<?php

require(ROOT . '/config/dbConfig.php');

try
{
    $DB_con = new PDO("mysql:dbname=$DB_name;host=$DB_host", $DB_login, $DB_password);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DB_con->exec("set names utf8");
    
} catch (PDOException $e) {
    echo $e->getMessage();
}


        



