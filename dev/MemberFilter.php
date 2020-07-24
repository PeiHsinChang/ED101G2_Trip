<?php

    session_start();
    $memInfo = $_SESSION["Mem_NO"];
    // echo $_POST['keepScheInfo'];
    $keepScheInfo = json_decode($_POST['keepScheInfo']);

    try{
        require_once("connectMemberTable.php");        
        //收藏景點Filter SQL指令        
        $sql_FilterSpot = "";
         
        $keepOneSche1 = $pdo-> prepare($sql_keepOneSche1);
        // $keepOneSche1 -> bindValue(":memId", $memInfo);
        $keepOneSche1 -> bindValue(":scheName",$keepScheInfo->Sche_Id);
        $keepOneSche1 -> execute();
        $keepOneScheTnP = $keepOneSche1->fetchAll(PDO::FETCH_ASSOC); 
        print_r($keepOneScheTnP);
        die;
    
        //送出景點資料  
        echo json_encode($keepOneScheTnP);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>