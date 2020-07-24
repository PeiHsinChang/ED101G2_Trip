<?php
   $memberNo =  $_POST["cancelKeepMemberNo"];
   $blogNo =  $_POST["cancelKeepBlogNo"];

   try{
        require_once("connectMemberTable.php");
        $sql = "delete from Keep_Blog where Mem_NO=:memNo and Blog_NO=:blogNo";
        $keepBlog = $pdo->prepare($sql);
        $keepBlog->bindValue(":memNo", $memberNo);
        $keepBlog->bindValue(":blogNo", $blogNo);
        $keepBlog->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>