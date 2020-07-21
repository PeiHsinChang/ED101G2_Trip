<?php
    $refuseInfo = $_POST["refuseInfo"];
    // echo $refuseInfo;
    try{
        require_once("connectMemberTable.php");
        $sql = "update `Mem_Par` set Mem_Par_Status=2 where Mem_No=:memNo";
        $refuse = $pdo->prepare($sql);
        $refuse->bindValue(":memNo", $refuseInfo);
        $refuse->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>