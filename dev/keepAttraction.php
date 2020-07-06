<?php
    session_start();
    require_once("getMemberInfo.php");
    $memInfo = $_SESSION["Mem_NO"];
    echo   $memInfo ;
    die;
    $loginInfo = json_decode($_POST["memInfo"]); 
    try{
        require_once("connectMemberTable.php");
        $sql = "select Attrac_Name, Attrac_Region, Attrac_LikeSum/Attrac_LikeAmount like,Attrac_Status FROM keep_attrac k, attraction a 
        where  k.Attrac_NO=a.Attrac_NO and Mem_NO=:memId";
        $keepAttr = $pdo->prepare($sql);
        $keepAttr -> bindValue(":memId", $memInfo);
        $keepAttr -> execute();
        if($keepAttr -> rowCount()==0 ){
            echo "{}";
        }else{
            $keepAttrRow = $keepAttr -> fetch(PDO::FETCH_ASSOC);
              
            $_SESSION["Attrac_Name"] = $keepAttrRow["Attrac_Name"];
            $_SESSION["Attrac_Region"] = $keepAttrRow["Attrac_Region"];
            $_SESSION["like"] = $keepAttrRow["like"];
            $_SESSION["Attrac_Status"] = $keepAttrRow["Attrac_Status"];

            //送出景點資料
            $attracInfo = array("Attrac_Name"=>$_SESSION["Attrac_Name"],"Attrac_Region"=>$_SESSION["Attrac_Region"], 
            "like"=>$_SESSION["like"], "Attrac_Status"=>$_SESSION["Attrac_Status"]);
            echo json_encode($attracInfo);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>