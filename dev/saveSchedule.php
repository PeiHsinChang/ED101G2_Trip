<?php 

// $toBeSavedSchedule = json_decode($_POST["toBeSavedSchedule"]);

try{
    require_once("connect.php");
    $sql = "insert into sche (Mem_NO,Sche_Name,Sche_Status) values (:MemNO,:scheName,:scheStatus)";
	$schedule = $pdo->prepare($sql);
	
	$schedule->bindValue(":MemNO", 001);
    $schedule->bindValue(":scheName", 'b');
    $schedule->bindValue(":scheStatus", 1);
	// $schedule->bindValue(":MemNO", $toBeSavedSchedule->MemNO);
    // $schedule->bindValue(":scheName", $toBeSavedSchedule->scheName);
    // $schedule->bindValue(":scheStatus", $toBeSavedSchedule->scheStatus);
	$schedule->execute();
    
    echo '成功儲存一筆資料';

  }catch(PDOException $e){
    echo $e->getMessage();
  }
?>