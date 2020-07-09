<?php
    try{
        require_once("connect.php");
        $sql = "select * from `AdminTable` where Adm_NO=:adminNo";
        $adminNo = $pdo->prepare($sql);
        $adminNo->bindValue(":adminNo", $_POST["Adm_NO"]);
        $adminNo->execute();

        //自資料庫中取回資料
        $adminNoRow = $adminNo->fetch(PDO::FETCH_ASSOC);
        // echo $memberNoRow["Mem_Status"];
       
        if($adminNoRow["Adm_Status"] == 1){
            $sql = "update `AdminTable` set Adm_Status=0 where Adm_NO=:adminNo";
            $chageAdminStatus = $pdo->prepare($sql);
            $chageAdminStatus->bindValue(":adminNo",$_POST["Adm_NO"]);
            $chageAdminStatus->execute();
            echo '更改成功一';
        }
        if($adminNoRow["Adm_Status"] == 0){
            $sql = "update `AdminTable` set Adm_Status=1 where Adm_NO=:adminNo";
            $chageAdminStatus2 = $pdo->prepare($sql);
            $chageAdminStatus2->bindValue(":adminNo", $_POST["Adm_NO"]);
            $chageAdminStatus2->execute();
            echo '更改成功二';
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>