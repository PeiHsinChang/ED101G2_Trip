<?php
   //解碼json字串
   $report = json_decode($_POST["report"]); 

   try{
    require_once("connect.php");
    //將被檢舉留言從檢舉表格中刪除
    $sql = "delete from `Report` where Msg_NO=:msgNo";
    $deleteReport = $pdo->prepare($sql);
    $deleteReport->bindValue(":msgNo", $report->Msg_NO);
    $deleteReport->execute();

    //將被檢舉留言在留言表格中更改狀態
    //$sql = "update `Message` set Msg_Status=0 where Msg_NO=:msgNum";
    $sql = "delete from `Message` where Msg_NO=:msgNum";
    $deleteReport = $pdo->prepare($sql);
    $deleteReport->bindValue(":msgNum", $report->Msg_NO);
    $deleteReport->execute();
   }catch(PDOException $e){
    echo $e->getMessage();
   }
?>