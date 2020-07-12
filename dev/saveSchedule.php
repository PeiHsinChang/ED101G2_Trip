<?php 
// insert savedScheduel to sche:
try{
    require_once("connect.php");
    $sql = "insert into sche (Mem_NO,Sche_Name,Sche_Img,Sche_Views,Sche_Status) values (:MemNO,:scheName,:scheImg,:scheViews,:scheStatus)";
	$schedule = $pdo->prepare($sql);
	
	$schedule->bindValue(":MemNO", $_POST["MemNO"]);
    $schedule->bindValue(":scheName", $_POST["scheName"]);
    $schedule->bindValue(":scheImg", $_POST["selectedAttractions"][0]["Picture1"]);
    $schedule->bindValue(":scheViews", rand(1000,3000));
    $schedule->bindValue(":scheStatus", $_POST["scheStatus"]);
	$schedule->execute();
    
    // 取得db最後一筆資料的pk:
    $scheNO=$pdo->lastInsertId();
    
    echo '成功儲存MemNO,scheName,scheStatus';

  }catch(PDOException $e){
    echo $e->getMessage();
  };

//   inser savedSchedule to attrac_sche:
  try{
    require_once("connect.php");

for($i=0;$i<count($_POST["selectedAttractions"]);$i++){
    $sql = "insert into attrac_sche (Sche_NO,Attrac_NO) values (:ScheNO,:AttracNO)";
	$schedule = $pdo->prepare($sql);
	
	$schedule->bindValue(":ScheNO",$scheNO);
    $schedule->bindValue(":AttracNO", $_POST["selectedAttractions"][$i]["Id"]);
	$schedule->execute();
};
    echo '成功儲存ScheNO,AttracNO';

  }catch(PDOException $e){
    echo $e->getMessage();
  };
?>