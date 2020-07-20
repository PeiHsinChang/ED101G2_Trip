<?php
session_start();
    try{
        require_once("connectMemberTable.php");
        $mem_NO = $_SESSION["Mem_NO"];
        $sql = 
            " select * 
            from `sche` 
            where Mem_NO=:mem_NO 
            and Sche_Status=1
            order by Sche_NO;";
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