<?php
    try{
        // require_once("getAdminInfo.php");
        require_once("connect.php");
        $sql = "select * from `MemberTable`";
        $memInfo = $pdo->prepare($sql);
        $memInfo->execute();

        $memInfomation = $memInfo->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($memInfomation);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>