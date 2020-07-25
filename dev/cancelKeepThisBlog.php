<?php
   try{
        require_once("connectMemberTable.php");
        $sql = "delete from Keep_Blog where Mem_NO=:memNo and Blog_NO=:blogNo";
        $keepBlog = $pdo->prepare($sql);
        $keepBlog->bindValue(":memNo", $_POST["cancelKeepMemberNo"]);
        $keepBlog->bindValue(":blogNo",$_POST["cancelKeepBlogNo"]);
        $keepBlog->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>