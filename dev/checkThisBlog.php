<?php


try {
require_once("connectMemberTable.php");

session_start();
// echo $_POST["blogNo"] .'+'.$_SESSION["Mem_NO"];
// die;
//取得收藏揪團狀態
$getBlogStatus_sql = "select * from Keep_Blog where Mem_NO=:memNo and Blog_NO=:blogNo";
$keepBlogStatus = $pdo->prepare($getBlogStatus_sql);
$keepBlogStatus->bindValue(":memNo", $_SESSION["Mem_NO"]);
$keepBlogStatus->bindValue(":blogNo", $_POST["blogNo"]);
$keepBlogStatus->execute();
// $keepBlogStatusResult = $keepBlogStatus->fetch(PDO::FETCH_ASSOC);
if($keepBlogStatus -> rowCount()==0){
  if($_SESSION["Mem_NO"]==null){
    echo "請登入會員";
  }else{
    //insert 一筆資料
    $insertBlogStatus_sql = 
      "Insert into Keep_Blog ( Mem_NO , Blog_NO)
      values (:memNo,:blogNo);";
    $insertkeepBlogStatus = $pdo->prepare($insertBlogStatus_sql);
    $insertkeepBlogStatus->bindValue(":memNo", $_SESSION["Mem_NO"]);
    $insertkeepBlogStatus->bindValue(":blogNo", $_POST["blogNo"]);
    $insertkeepBlogStatus->execute();
  }
  echo "收藏成功";
}else{
  while($keepBlogStatusResult = $keepBlogStatus->fetch(PDO::FETCH_ASSOC)){
    echo "已收藏";
  }
} 
} catch (PDOException $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤原因 : ", $e->getMessage(), "<br>";
}


?>
