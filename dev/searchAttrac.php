<?php 
try{
    require_once("connect.php");
    // $sql = "select * from `attractions` where Name like :searchedName";
    // $sql = "select * from attractions a left join keep_attrac k on a.Id=k.Attrac_NO where Name like :searchedName and char_length(Picture1)>1";
    $sql = "select * from attractions a left join keep_attrac k on a.Id=k.Attrac_NO where Name like :searchedName and Picture1 like 'https://%'";
    $attraction = $pdo->prepare($sql); 
    $attraction->bindValue(":searchedName", '%'.$_GET["searchedName"].'%');
    $attraction->execute();
  
    if( $attraction->rowCount()==0){ //查無此景點
        echo "無此景點";
    }else{ //成功取得景點
      //自資料庫中取回景點資料
        $searchedAttractionRows = $attraction->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($searchedAttractionRows);
        // print_r($searchedAttractionRows);
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
?>
