<?php
   $memberNo =  $_POST["SignUpMemberNo"];
   $groupNo =  $_POST["SignUpGroupNo"];
   
   try{
        require_once("connectMemberTable.php");
        $sql = "insert into Mem_Par (Mem_NO, Group_NO, Mem_Par_Status) VALUES (:memNo, :groupNo, 0);";
        $signUp = $pdo->prepare($sql);
        $signUp->bindValue(":memNo", $memberNo);
        $signUp->bindValue(":groupNo", $groupNo);
        $signUp->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>