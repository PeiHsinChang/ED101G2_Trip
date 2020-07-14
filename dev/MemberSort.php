<?php 

session_start();
    $memInfo = $_SESSION["Mem_NO"];
    try{
      require_once("connectMemberTable.php");

      //group SQL sort new -> old
      $sql_keepGroupNew = "select Group_title, Group_Pic, g.Group_No,
      Group_StartDate, Group_Deadline,
        Mem_Name, round(Mem_LikeAmount / Mem_LikeSum) MemLike
        FROM keep_group kg, grouptable g , membertable m
        where  kg.Group_NO = g.Group_NO  
        and g.Mem_NO = m.Mem_NO
        and kg.Mem_NO=:memId
        order by g.Group_No Desc;";
      
      //group SQL sort popular 
      $sql_keepGroupPopular = "select Group_title, Group_Pic, g.Group_No,
      Group_StartDate, Group_Deadline,
        Mem_Name, round(Mem_LikeAmount / Mem_LikeSum) MemLike
        FROM keep_group kg, grouptable g , membertable m
        where  kg.Group_NO = g.Group_NO  
        and g.Mem_NO = m.Mem_NO
        and kg.Mem_NO=:memId
        order by MemLike  Desc;";
        // select Sche_Name, Sche_Img, Sche_Views, s.Sche_NO
        // FROM keep_sche ks, sche s
        // where ks.Sche_NO = s.Sche_NO  
        // and ks.Mem_NO=1
        // order by  s.Sche_NO  Desc;

      //schedule SQL sort popular 
      $sql_keepGroupPopular = "select Group_title, Group_Pic, g.Group_No,
      Group_StartDate, Group_Deadline,
        Mem_Name, round(Mem_LikeAmount / Mem_LikeSum) MemLike
        FROM keep_group kg, grouptable g , membertable m
        where  kg.Group_NO = g.Group_NO  
        and g.Mem_NO = m.Mem_NO
        and kg.Mem_NO=:memId
        order by MemLike  Desc;";
      
      
      $keepOneAttr = $pdo-> prepare($sql_keepOneAttr);
      $keepOneAttr -> bindValue(":memId", $memInfo);
      $keepOneAttr -> execute();

    
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
      }
      //送出景點資料  
      echo json_encode($attracOneInfo,JSON_UNESCAPED_UNICODE);
  }catch(PDOException $e){
      echo $e->getMessage();
  }
?>