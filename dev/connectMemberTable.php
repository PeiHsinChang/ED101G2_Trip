<?php
    $dsn = "mysql:host=localhost;port=7700;dbname=easyPlanningTrip;charset=utf8";
    $user = "root";
    $password = "123456";
    $password = "root";
    $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn, $user, $password, $options);
?>