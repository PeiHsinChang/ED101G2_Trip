<?php
$dsn = "mysql:host=127.0.0.1;port=3306 ;dbname=ed101g2;charset=utf8";
$user = "ed101g2";
$password = "ed101g2";
$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $user, $password, $options);
?>