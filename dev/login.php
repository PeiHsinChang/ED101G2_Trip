<?php
    session_start();

    //解碼json字串
    $loginInfo = json_decode($_POST["loginInfo"]); 

    try{
        require_once("connectMemberTable.php");
        $sql = "select * from `MemberTable` where Mem_Id=:memId and Mem_Psw=:memPsw";
        $member = $pdo->prepare($sql);
        $member->bindValue(":memId", $loginInfo->Mem_Id);
        $member->bindValue(":memPsw", $loginInfo->Mem_Psw);
        $member->execute();

        if($member->rowCount()==0){
            echo "{}";
        }else{
            //自資料庫中取回資料
            $memRow = $member->fetch(PDO::FETCH_ASSOC);
              
            //將登入者的資訊寫入SESSION
            $_SESSION["Mem_NO"] = $memRow["Mem_NO"];
            $_SESSION["Mem_Name"] = $memRow["Mem_Name"];
            $_SESSION["Mem_Id"] = $memRow["Mem_Id"];
            $_SESSION["Mem_Psw"] = $memRow["Mem_Psw"];
            $_SESSION["Mem_Email"] = $memRow["Mem_Email"];
            $_SESSION["Mem_Status"] = $memRow["Mem_Status"];
            $_SESSION["Mem_LikeSum"] = $memRow["Mem_LikeSum"];
            $_SESSION["Mem_LikeAmount"] = $memRow["Mem_LikeAmount"];
            $_SESSION["Mem_Tel"] = $memRow["Mem_Tel"];
            $_SESSION["Mem_Sex"] = $memRow["Mem_Sex"];
            $_SESSION["Mem_Birth"] = $memRow["Mem_Birth"];
            $_SESSION["Mem_Photo"] = $memRow["Mem_Photo"];

            //送出登入者的姓名資料
            $memberInfo = array("Mem_NO"=>$_SESSION["Mem_NO"],"Mem_Name"=>$_SESSION["Mem_Name"], 
            "Mem_Id"=>$_SESSION["Mem_Id"], "Mem_Psw"=>$_SESSION["Mem_Psw"], "Mem_Email"=>$_SESSION["Mem_Email"], 
            "Mem_Status"=>$_SESSION["Mem_Status"], "Mem_LikeSum"=>$_SESSION["Mem_LikeSum"], 
            "Mem_LikeAmount"=>$_SESSION["Mem_LikeAmount"], "Mem_Tel"=>$_SESSION["Mem_Tel"], "Mem_Sex"=>$_SESSION["Mem_Sex"], 
            "Mem_Birth"=>$_SESSION["Mem_Birth"], "Mem_Photo"=>$_SESSION["Mem_Photo"]);
            echo json_encode($memberInfo);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>