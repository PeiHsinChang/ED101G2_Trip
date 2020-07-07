<?php 
try{
    require_once("connect.php");
    $sql = "select * from `attractions` where Id = :Id";
    $attraction = $pdo->prepare($sql); 
    $attraction->bindValue(":Id", "$_GET[Id]");
    $attraction->execute();
  
    if( $attraction->rowCount()==0){ //查無此景點
        echo "{}";
    }else{ //成功取得景點
      //自資料庫中取回景點資料
        $Row = $attraction->fetch(PDO::FETCH_ASSOC);
        echo $Row["Name"];
        //將景點資訊寫入SESSION
        // $_SESSION["Id"] = $Row["Id"];
        // $_SESSION["memId"] = $Row["memId"];
        // $_SESSION["memName"] = $Row["memName"];
        // $_SESSION["email"] = $Row["email"];
        // $_SESSION["tel"] = $Row["tel"];
  
    //   $attractionInfo = array("Id"=>$_SESSION["Id"],"Name"=>$_SESSION["Name"], "Px"=>$_SESSION["Px"], "Py"=>$_SESSION["Py"], "Add"=>$_SESSION["Add"]);
  
      
    //   echo json_encode($attractionInfo);
      // 把關聯性陣列轉成json檔
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
?>