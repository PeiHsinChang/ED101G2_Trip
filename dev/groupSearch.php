<?php 
try{
    require_once("connectMemberTable.php");
    
    //拿到畫面輸入的資訊
    $searchText=$_GET['search_text'];
    //把資訊塞進去sql裡面
    $sql="select * from GroupTable 
    where Group_Status=1
    AND Group_Title like '%".$searchText."%' 
    OR Group_Place like '%".$searchText."%' 
    OR Group_Com like '%".$searchText."%'";
    //在有效團裡面要團名 集合地點 團備註包含相關字詞

    $result = $pdo->query($sql);
    $result->execute();
    $searchResultRows=$result->fetchAll(PDO::FETCH_ASSOC);
    // print_r($carouselGroupRows);
    // die;

    echo json_encode($searchResultRows,JSON_UNESCAPED_UNICODE);
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>