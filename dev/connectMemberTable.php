<?php
    $dsn = "mysql:host=localhost;port=8889 ;dbname=easyPlanningTrip;charset=utf8";
    $user = "root";
    $password = "123123";
    $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn, $user, $password, $options);
?>