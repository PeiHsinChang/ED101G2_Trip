<?php 
try{
    require_once("connect.php");
    $sql = "select * from `attractions` where Name like :Name";
    $attraction = $pdo->prepare($sql); 
    $attraction->bindValue(":Name", '%'.$_GET["Name"].'%');
    $attraction->execute();
  
    if( $attraction->rowCount()==0){ //查無此景點
        echo "無此景點";
    }else{ //成功取得景點
      //自資料庫中取回景點資料
        $searchedAttractionRows = $attraction->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($searchedAttractionRows);
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
?>
