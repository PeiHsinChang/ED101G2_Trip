<?php
    try{
        require_once("connect.php");
        $sql = "select * from `AdminTable`";
        $adminInfo = $pdo->prepare($sql);
        $adminInfo->execute();

        $adminInfomation = $adminInfo->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($adminInfomation);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>