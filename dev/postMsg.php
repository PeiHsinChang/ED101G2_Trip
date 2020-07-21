<?php
session_start();
try{
    $mem_NO = $_SESSION["Mem_NO"];
    $data = $_POST["postData"];
    $form = explode("_",$data["msgFrom"]);
    require_once("connectMemberTable.php");
   $sql = "update Message  set Msg_Re=:Msg_Re , Msg_Re_Date=:Msg_Re_Date
           where Group_NO=:Group_NO and Block_NO=:Block_NO;";
    $chageMemStatus = $pdo->prepare($sql);
    $chageMemStatus->bindValue(":Msg_Re",$data["msg"]);
    $chageMemStatus->bindValue(":Msg_Re_Date",date('Y-m-d', time()));
    $chageMemStatus->bindValue(":Group_NO",$form[0]);
    $chageMemStatus->bindValue(":Block_NO",$form[2]);
    $chageMemStatus->execute();
//    $groups->bindParam(":mem_NO", $mem_NO);
    echo "新增留言成功";
}catch(PDOException $e){
    echo $e->getMessage();
}
?>