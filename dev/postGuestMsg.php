<?php
session_start();
try{
    $mem_NO = $_SESSION["Mem_NO"];
    $data = $_POST["msgObj"];
    require_once("connectMemberTable.php");
    $sql = "select CAST(Block_NO as UNSIGNED)AS 'block' from Message m where Group_NO=:Group_NO order by Block_NO desc limit 1";
    $chageMemStatus = $pdo->prepare($sql);
    $chageMemStatus->bindValue(":Group_NO",$data["groupno"]);
    $chageMemStatus->execute();
    $row = $chageMemStatus->fetch(PDO::FETCH_ASSOC);
    if ($row !== false) {
        $block_no = $row['block'];
    }else{
        $block_no=1;
    }

    require_once("connectMemberTable.php");
    $sql = "Insert into  Message  (Msg_NO,mem_no, group_no, msg_date, msg_cont, msg_re, msg_re_date, msg_status, block_no)
            values (DEFAULT,:mem_no, :group_no, :msg_date, :msg_cont,null, null, 1, :block_no)";
    $chageMemStatus = $pdo->prepare($sql);
    $chageMemStatus->bindValue(":mem_no",$mem_NO);
    $chageMemStatus->bindValue(":group_no",$data["groupno"]);
    $chageMemStatus->bindValue(":msg_date",date('Y-m-d', time()));
    $chageMemStatus->bindValue(":msg_cont",$data["guestMsgContent"]);
    $chageMemStatus->bindValue(":block_no",$block_no+1);
    $chageMemStatus->execute();
//    $groups->bindParam(":mem_NO", $mem_NO);
    echo "新增留言成功";
}catch(PDOException $e){
    echo $e->getMessage();
}
?>