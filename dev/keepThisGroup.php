<?php
   $memberNo =  $_POST["keepMemberNo"];
   $groupNo =  $_POST["keepGroupNo"];

   try{
        require_once("connectMemberTable.php");
        $sql = "insert into Keep_Group (Mem_NO, Group_NO) values (:memNo, :groupNo);";
        $keepGroup = $pdo->prepare($sql);
        $keepGroup->bindValue(":memNo", $memberNo);
        $keepGroup->bindValue(":groupNo", $groupNo);
        $keepGroup->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>