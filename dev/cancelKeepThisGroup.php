<?php
   $memberNo =  $_POST["cancelKeepMemberNo"];
   $groupNo =  $_POST["cancelKeepGroupNo"];

   try{
        require_once("connectMemberTable.php");
        $sql = "delete from Keep_Group where Mem_NO=:memNo and Group_NO=:groupNo";
        $keepGroup = $pdo->prepare($sql);
        $keepGroup->bindValue(":memNo", $memberNo);
        $keepGroup->bindValue(":groupNo", $groupNo);
        $keepGroup->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>