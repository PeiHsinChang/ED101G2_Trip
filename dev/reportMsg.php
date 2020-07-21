<?php
session_start();
try{
    $data = $_POST["msgObj"];
    require_once("connectMemberTable.php");
    $sql = "select m.Msg_NO from Message m where Group_NO=:Group_NO and Block_NO=:Block_NO";
    $chageMemStatus = $pdo->prepare($sql);
    $chageMemStatus->bindValue(":Group_NO",$data["groupno"]);
    $chageMemStatus->bindValue(":Block_NO",$data["block_no"]);
    $chageMemStatus->execute();
    $row = $chageMemStatus->fetch(PDO::FETCH_ASSOC);
    $msg_no = "";
    if ($row !== false) {
        $msg_no = $row['Msg_NO'];
    }else{
        return;
    }
    require_once("connectMemberTable.php");
    $sql = "";
    $sql = "Insert into  Report (Rpt_NO,Msg_NO,Mem_NO,Rpt_Date,Rpt_Cont)
            values (DEFAULT,:Msg_NO, :Mem_NO, :Rpt_Date, :Rpt_Cont)";
    $chageMemStatus = $pdo->prepare($sql);
    $chageMemStatus->bindValue(":Msg_NO",$msg_no);
    $chageMemStatus->bindValue(":Mem_NO",$data["guestid"]);
    $chageMemStatus->bindValue(":Rpt_Date",date('Y-m-d', time()));
    $chageMemStatus->bindValue(":Rpt_Cont",$data["msg"]);
    $chageMemStatus->execute();
//    $groups->bindParam(":mem_NO", $mem_NO);
    echo "檢舉完成";
}catch(PDOException $e){
    echo $e->getMessage();
}
?>