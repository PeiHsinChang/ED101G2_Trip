<?php
   $memberNo =  $_POST["cancelSignUpMemberNo"];
   $groupNo =  $_POST["cancelSignUpGroupNo"];

   try{
        require_once("connectMemberTable.php");
        $sql = "update Mem_Par set Mem_Par_Status=3 where Mem_NO=:memNo and Group_NO=:groupNo;";
        $signUp = $pdo->prepare($sql);
        $signUp->bindValue(":memNo", $memberNo);
        $signUp->bindValue(":groupNo", $groupNo);
        $signUp->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>