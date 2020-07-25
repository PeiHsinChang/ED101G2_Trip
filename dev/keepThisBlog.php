<?php
   $memberNo =  $_POST["keepMemberNo"];
   $blogNo =  $_POST["keepBlogNo"];

   try{
        require_once("connectMemberTable.php");
        $sql = "insert into Keep_Blog (Mem_NO, Blog_NO) values (:memNo, :blogNo);";
        $keepGroup = $pdo->prepare($sql);
        $keepGroup->bindValue(":memNo", $memberNo);
        $keepGroup->bindValue(":groupNo", $blogNo);
        $keepGroup->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>