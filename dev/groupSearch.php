<?php 
try{
    require_once("connectMemberTable.php");

  
    //把資訊塞進去sql裡面
    $sql="select * from `GroupTable` 
    where Group_Status=1
    AND Group_Title like :search_text
    OR Group_Place like :search_text 
    OR Group_Com like :search_text";
    //在有效團裡面要團名 集合地點 團備註包含相關字詞

    $result = $pdo->prepare($sql);
    $result->bindValue(":search_text",'%'.$_POST['search_text'].'%');
    $result->execute();
    if($result->rowCount()==0){ //查無資料
        echo"{}";
    }else{  //有資料
        $searchResultRows=$result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($searchResultRows);
    }
    // $searchResultRows=$result->fetchAll(PDO::FETCH_ASSOC);
    // print_r($carouselGroupRows);
    // die;
    
    // echo json_encode($searchResultRows,JSON_UNESCAPED_UNICODE);
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>