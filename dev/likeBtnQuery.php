<?php 
  $likeSpot = json_decode($_POST["keepLikeSpotInfo"]); 
  session_start();
  $memInfo = $_SESSION["Mem_NO"];

  try{
  require_once("connectMemberTable.php");
  //like button for 景點
  $sql_likeSpot =
    "delete k from keep_attrac k
    inner join attraction a 
    on k.Attrac_NO=a.Attrac_NO 
    where  a.attrac_Name=:attracName
    and k.Mem_NO=:memId";
  $ls= $likeSpot->Spot_Id;
  $likeSpot = $pdo -> prepare($sql_likeSpot);
  $likeSpot -> bindValue(":memId", $memInfo);
  $likeSpot -> bindValue(":attracName",  $ls);
  $likeSpot -> execute();

  //like button for 行程
  // $sql_likeSpot =
    //  "delete k from keep_attrac k
  //   inner join attraction a 
  //   on k.Attrac_NO=a.Attrac_NO 
  //   where  a.attrac_Name=:attracName
  //   and k.Mem_NO=:memId";
  // $ls= $likeSpot->Spot_Id;
  // $likeSpot = $pdo -> prepare($sql_likeSpot);
  // $likeSpot -> bindValue(":memId", $memInfo);
  // $likeSpot -> bindValue(":attracName",  $ls);
  // $likeSpot -> execute();

  echo "執行成功";
}catch(PDOException $e){
  echo $e->getMessage();
}



?>


