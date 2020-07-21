<?php
    $acceptInfo = $_POST["acceptInfo"];
    // echo $acceptInfo;
    try{
        require_once("connectMemberTable.php");
        $sql = "update `Mem_Par` set Mem_Par_Status=1 where Mem_No=:memNo";
        $accept = $pdo->prepare($sql);
        $accept->bindValue(":memNo", $acceptInfo);
        $accept->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>