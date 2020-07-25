<?php
  
   try{
        require_once("connectMemberTable.php");
        $sql = "insert into Keep_Blog (Mem_NO, Blog_NO) values (:memNo, :blogNo);";
        $keepBlog = $pdo->prepare($sql);
        $keepBlog->bindValue(":memNo",$_POST["keepMemberNo"]);
        $keepBlog->bindValue(":blogNo", $_POST["keepBlogNo"]);
        $keepBlog->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>