<?php 
try{
    require_once("connect.php");
    $sql = "select * from keep_attrac k left join attractions a on k.Attrac_NO=a.Id where Mem_NO=:MemNO";
    $attraction = $pdo->prepare($sql); 
    $attraction->bindValue(":MemNO",$_GET["MemNO"]);
    $attraction->execute();
  
    if( $attraction->rowCount()==0){ //尚無收藏任何景點
        echo 0;
    }else{ //成功取得景點
      //自資料庫中取回景點資料
        $searchedAttractionRows = $attraction->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($searchedAttractionRows);
        // print_r($searchedAttractionRows);
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
// echo $_GET["MemNO"];
?>