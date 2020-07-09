<?php
    try{
        require_once("connect.php");
        $sql = "select * from `MemberTable` where Mem_No=:memNo";
        $memberNo = $pdo->prepare($sql);
        $memberNo->bindValue(":memNo", $_POST["Mem_NO"]);
        $memberNo->execute();

        //自資料庫中取回資料
        $memberNoRow = $memberNo->fetch(PDO::FETCH_ASSOC);
        // echo $memberNoRow["Mem_Status"];
       
        if($memberNoRow["Mem_Status"] == 1){
            $sql = "update `MemberTable` set Mem_Status=0 where Mem_No=:memNo";
            $chageMemStatus = $pdo->prepare($sql);
            $chageMemStatus->bindValue(":memNo",$_POST["Mem_NO"]);
            $chageMemStatus->execute();
            // echo '更改成功一';
        }
        if($memberNoRow["Mem_Status"] == 0){
            $sql = "update `MemberTable` set Mem_Status=1 where Mem_No=:memNo";
            $chageMemStatus2 = $pdo->prepare($sql);
            $chageMemStatus2->bindValue(":memNo", $_POST["Mem_NO"]);
            $chageMemStatus2->execute();
            // echo '更改成功二';
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>