<?php
session_start();
try{
    //$mem_NO = $_SESSION["Mem_NO"];
    //TEST 先將group寫死 方便測試
    require_once("connectMemberTable.php");
    $sql = "select gr.Mem_NO AS main_mem,mem.Mem_Id,mem.Mem_Photo,msg.* from Message msg ".
            "join MemberTable mem on mem.Mem_NO = msg.Mem_NO ".
            "join GroupTable gr on gr.Group_NO = msg.Group_NO ".
            "where msg.Group_NO=:Group_NO  order by Block_NO,Msg_NO;";
    $chats = $pdo->prepare($sql);
   $chats->bindParam(":Group_NO", $_POST["groupNO"]);
    $chats->execute();
    if($chats->rowCount()==0){
        $rtn = array();
        echo json_encode($rtn);
    }else{
        $results = $chats->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
?>