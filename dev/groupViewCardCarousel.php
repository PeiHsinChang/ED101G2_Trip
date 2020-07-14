<?php 
try{
    $dsn = "mysql:host=localhost;port=8889;dbname=easyPlanningTrip;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO( $dsn, $user, $password, $options);
    //change to require once after done 
    // require_once("connectMemberTable.php");
    
    $sql = "";
}catch (PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
}
?>