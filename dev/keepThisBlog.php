<?php
//   session_start();
//   $memInfo = $_SESSION["Mem_NO"];

    $memberNo = $_POST["keepMemberNo"];
    $blogNo =$_POST["keepBlogNo"];
    
   try{
        require_once("connectMemberTable.php");
        $sql = "insert into Keep_Blog (Mem_NO, Blog_NO) values (:memNo, :blogNo);";
        $keepBlog = $pdo->prepare($sql);
        $keepBlog->bindValue(":memNo", $memberNo);
        $keepBlog->bindValue(":blogNo", $blogNo);
        $keepBlog->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>