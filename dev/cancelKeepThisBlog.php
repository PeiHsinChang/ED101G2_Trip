<?php


   $memberNo =  $_POST["cancelKeepMemberNo"];
   $blogNo =  $_POST["cancelKeepBlogNo"];

   try{
        require_once("connectMemberTable.php");
        $sql = "delete from Keep_Blog where Mem_NO=:memNo and Blog_NO=:blogNo";
        $keepGroup = $pdo->prepare($sql);
        $keepGroup->bindValue(":memNo", $memberNo);
        $keepGroup->bindValue(":groupNo", $blogNo);
        $keepGroup->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>