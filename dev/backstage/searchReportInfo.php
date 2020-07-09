<?php
    try{
        require_once("connect.php");
        $sql = "select Report.Rpt_NO, Report.Msg_NO, Report.Mem_NO, Report.Rpt_Date, Report.Rpt_Cont, Message.Msg_NO, Message.Msg_Cont, MemberTable.Mem_NO, MemberTable.Mem_Name
        from Report join Message on Report.Msg_NO=Message.Msg_NO join MemberTable on Report.Mem_NO=MemberTable.Mem_NO order by Report.Rpt_Date desc";
        $reportInfo = $pdo->prepare($sql);
        $reportInfo->execute();

        $reportInfomation = $reportInfo->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reportInfomation);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>