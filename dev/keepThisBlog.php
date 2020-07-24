<?php

try{
    session_start();
    require_once("connectMemberTable.php");
    $sql="insert into `Keep_Blog`(Mem_NO, Blog_NO) values (:memNO,:blogNo);";
    $keepBlog = $pdo->prepare($sql);
    $keepBlog->bindValue(":memNO",$_SESSION["Mem_NO"]);
    $keepBlog->bindValue(":blogNo",$_POST["Blog_NO"]);
    $keepBlog->execute();
    }catch(PDOException $e){
    // echo "錯誤行號:", $e->getLine(),"<br>";
    echo "錯誤原因:", $e->getMessage(),"<br>";
   }

?>

<?php echo $_SESSION["Mem_NO"];?>
