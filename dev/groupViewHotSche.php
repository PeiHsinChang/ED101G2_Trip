<?php 
try{
    // $dsn = "mysql:host=localhost;port=3306;dbname=easyPlanningTrip;charset=utf8";
	// $user = "root";
	// $password = "root";
	// $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    // $pdo = new PDO( $dsn, $user, $password, $options);
    $sql = "select Sche_Img,Sche_Name from sche where Sche_Status=1 order by Sche_Views desc limit 3";
    //change to require once after done 
    require_once("connectMemberTable.php");
    $hotSche = $pdo->query($sql);
    $hotSche->execute();
    $hotScheRows=$hotSche->fetchAll(PDO::FETCH_ASSOC);
    // r_print($hotScheRows);
    // die;
    echo json_encode($hotScheRows,JSON_UNESCAPED_UNICODE);
}catch (PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
}
?>