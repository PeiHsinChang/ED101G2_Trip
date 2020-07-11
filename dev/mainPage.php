<?php 
 try{
  require_once("connectMemberTable.php");
  // 團SQL指令      
  $sql_group = "select Group_title, Group_Pic, 
    Mem_name,Group_StartDate, Group_Deadline, 
    round(Mem_LikeAmount/Mem_LikeSum) hostlike
    FROM grouptable g ,membertable m
    where g.mem_no = m.mem_no
    and  g.Group_Status = 1 limit 2";
  $homePageGroup = $pdo->prepare($sql_group);
  $homePageGroup -> execute();
  //景點SQL指令
  $sql_spot = "select Attrac_Name,
    Attrac_Region, Attrac_PicURL , 
    round(attrac_likesum / attrac_likeamount,1) likecount
    FROM attraction limit 2";
  $homePageSpot = $pdo->prepare($sql_spot);
  $homePageSpot -> execute();
  
  //存放所有資料
  $homePageCards=array();
  //行程需要的資料
  if( $homePageGroup -> rowCount()==0 ){
      echo "{}";
  }else{
    $homePageGroupInfo=array();
      while($homePageGroupRows = $homePageGroup->fetch(PDO::FETCH_ASSOC)){
        $homePageGroupInfo[] = array(
              "Group_title"=>$homePageGroupRows["Group_title"],
              "Group_Pic"=>$homePageGroupRows["Group_Pic"],
              "Mem_name"=>$homePageGroupRows["Mem_name"],
              "Group_StartDate"=>$homePageGroupRows["Group_StartDate"],
              "Group_Deadline"=>$homePageGroupRows["Group_Deadline"],
              "hostlike"=>$homePageGroupRows["hostlike"],
          );	
      }            
  }
  //資料串接 + group
  array_push($homePageCards,$homePageGroupInfo);
  //景點需要的資料
  if($homePageSpot -> rowCount()==0 ){
      echo "{}";
  }else{
      $homePageSpotInfo=array();
      while($homePageSpotRows = $homePageSpot->fetch(PDO::FETCH_ASSOC)){
          $homePageSpotInfo[] = array(
              "Attrac_Name"=>$homePageSpotRows["Attrac_Name"],
              "Attrac_Region"=>$homePageSpotRows["Attrac_Region"],
              "likecount"=>$homePageSpotRows["likecount"],
              "Attrac_PicURL"=>$homePageSpotRows["Attrac_PicURL"]
          );	
      }
  }
  //資料串接 + spot
  array_push($homePageCards,$homePageSpotInfo);

  //送出景點資料  
  echo json_encode($homePageCards,JSON_UNESCAPED_UNICODE);
}catch(PDOException $e){
  echo $e->getMessage();
}

?>