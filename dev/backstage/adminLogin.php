<?php
    session_start();
    //解碼json字串
    $adminLoginInfo = json_decode($_POST["adminLoginInfo"]);

    try{
        require_once("connect.php");
        $sql = "select * from `AdminTable` where Adm_Acc=:exampleInputEmail and Adm_Psw=:exampleInputPassword";
        $admin = $pdo->prepare($sql);
        $admin->bindValue(":exampleInputEmail", $adminLoginInfo->Adm_Acc);
        $admin->bindValue(":exampleInputPassword", $adminLoginInfo->Adm_Psw);
        $admin->execute();

        if($admin->rowCount()==0){
            echo "{}";
        }else{
            //自資料庫中取回資料
            $adminRow = $admin->fetch(PDO::FETCH_ASSOC);

            //將管理員的資訊寫入SESSION
            $_SESSION["Adm_NO"] = $adminRow["Adm_NO"];
            $_SESSION["Adm_Name"] = $adminRow["Adm_Name"];
            $_SESSION["Adm_Acc"] = $adminRow["Adm_Acc"];
            $_SESSION["Adm_Psw"] = $adminRow["Adm_Psw"];
            $_SESSION["Adm_Status"] = $adminRow["Adm_Status"];

            //送出管理員的姓名資料
            $admonInfo = array("Adm_NO"=>$_SESSION["Adm_NO"],"Adm_Name"=>$_SESSION["Adm_Name"],"Adm_Acc"=>$_SESSION["Adm_Acc"], "Adm_Psw"=>$_SESSION["Adm_Psw"], "Adm_Status"=>$_SESSION["Adm_Status"]);
            echo json_encode($admonInfo);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>