<?php
session_start();
    try{
        $mem_NO = $_SESSION["Mem_NO"];
        require_once("connectMemberTable.php");
        $sql = "select * from `GroupTable` where Mem_NO=:mem_NO and Group_Status=3 order by Group_NO;";
        $groups = $pdo->prepare($sql);
        $groups->bindParam(":mem_NO", $mem_NO);
        $groups->execute();
        if($groups->rowCount()==0){
            $rtn = array();
            echo json_encode($rtn);
        }else{
            $results = $groups->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($results,JSON_UNESCAPED_UNICODE);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>