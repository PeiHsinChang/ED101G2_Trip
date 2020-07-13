<?php
    $keepSpotInfo = json_decode($_POST['keepSpotInfo']); 
    session_start();
    $memInfo = $_SESSION["Mem_NO"];

    try{
        require_once("connectMemberTable.php");

        //收藏景點SQL指令
        $sql_keepOneAttr = "select *, 
          round(Attrac_LikeSum / Attrac_LikeAmount,1) LikeAttrac
          FROM keep_attrac k, attraction a 
          where  k.Attrac_NO=a.Attrac_NO 
          and  attrac_Name=:attracName
          and Mem_NO=:memId ";
        $keepOneAttr = $pdo-> prepare($sql_keepOneAttr);
        $keepOneAttr -> bindValue(":memId", $memInfo);
        $keepOneAttr -> bindValue(":attracName",$keepSpotInfo->Spot_Id);
        $keepOneAttr -> execute();

        
        //收藏行程SQL指令        
        $sql_keepOneSche1 = "select sche_Name, Sche_Img
          FROM keep_Sche ks, sche s 
          where  ks.sche_NO=s.sche_NO 
          and  sche_Name=:scheName
          and Mem_NO=:memId";
        $keepOneSche1 = $pdo-> prepare($sql_keepOneSche1);
        $keepOneSche1 -> bindValue(":memId", $memInfo);
        $keepOneSche1 -> bindValue(":attracName",$keepScheInfo->Spot_Id);
        $keepOneSche1 -> execute();
        $sql_keepOneSche2 = "select * 
          FROM Attrac_Sche ats, sche s
          where ats.sche_no=s.sche_no
          and ats.sche_no=:memId;"
        $keepOneSche2 = $pdo-> prepare($sql_keepOneSche2);
        $keepOneSche2 -> bindValue(":memId", $memInfo);
        $keepOneSche2 -> bindValue(":attracName",$keepScheInfo->Spot_Id);
        $keepOneSche2 -> execute();

        //建收藏景點資料
        if($keepOneAttr -> rowCount()==0 ){
            echo "{}";
        }else{
          //景點
          $keepOneAttrRow = $keepOneAttr->fetch(PDO::FETCH_ASSOC);              
          $attracOneInfo = array(
            "Attrac_Name"=>$keepOneAttrRow["Attrac_Name"],
            "Attrac_Region"=>$keepOneAttrRow["Attrac_Region"],
            "Attrac_Addre"=>$keepOneAttrRow["Attrac_Addre"],
            "Attrac_Tel"=>$keepOneAttrRow["Attrac_Tel"],
            "Attrac_Open"=>$keepOneAttrRow["Attrac_Open"],
            "Attrac_PicURL"=>$keepOneAttrRow["Attrac_PicURL"],
            "LikeAttrac"=>$keepOneAttrRow["LikeAttrac"]
          );	
           //行程
          if($keepOneSche1 -> rowCount()==0 ){
            echo "{}";
          }else{
          
          $keepOneAttrRow = $keepOneAttr->fetch(PDO::FETCH_ASSOC);              
          $attracOneInfo = array(
            "Attrac_Name"=>$keepOneAttrRow["Attrac_Name"],
            "Attrac_Region"=>$keepOneAttrRow["Attrac_Region"],
            "Attrac_Addre"=>$keepOneAttrRow["Attrac_Addre"],
            "Attrac_Tel"=>$keepOneAttrRow["Attrac_Tel"],
            "Attrac_Open"=>$keepOneAttrRow["Attrac_Open"],
            "Attrac_PicURL"=>$keepOneAttrRow["Attrac_PicURL"],
            "LikeAttrac"=>$keepOneAttrRow["LikeAttrac"]
          );	

        }
        //送出景點資料  
        echo json_encode($attracOneInfo,JSON_UNESCAPED_UNICODE);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>