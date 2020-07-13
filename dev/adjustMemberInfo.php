<?php
    session_start();
    try{
        require_once("connectMemberTable.php");
        $AccContent = $_POST["memLeftAdjustAccContent"];
        $PswContent = $_POST["memLeftAdjustPswContent"];
        $BirContent = $_POST["memLeftAdjustBirContent"];
        $EmaContent = $_POST["memLeftAdjustEmaContent"];
        $TelContent = $_POST["memLeftAdjustTelContent"];

        $sql = "update MemberTable set Mem_Psw='$PswContent',Mem_Birth='$BirContent',Mem_Email='$EmaContent',
        Mem_Tel='$TelContent' where Mem_Id='$AccContent'";
        $pdo->exec($sql);
        // echo "<script>alert('儲存成功');location.href='member.html';</script>";
        // echo $AccContent.$PswContent.$BirContent.$EmaContent.$TelContent;

        unset($_SESSION["Mem_NO"]);
        unset($_SESSION["Mem_Name"]);
        unset($_SESSION["Mem_Id"]);
        unset($_SESSION["Mem_Psw"]);
        unset($_SESSION["Mem_Email"]);
        unset($_SESSION["Mem_Status"]);
        unset($_SESSION["Mem_LikeSum"]);
        unset($_SESSION["Mem_LikeAmount"]);
        unset($_SESSION["Mem_Tel"]);
        unset($_SESSION["Mem_Sex"]);
        unset($_SESSION["Mem_Birth"]);
        unset($_SESSION["Mem_Photo"]);
        echo "<script>alert('儲存成功，請重新登入');location.href='main.html';</script>";
     
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>