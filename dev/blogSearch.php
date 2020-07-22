<?php 
try{
    require_once("connectMemberTable.php");
    //把資訊塞進去sql裡面
    $sql="select Blog_Name, Blog_PicURL, 
    Mem_name,Blog_Date, Blog_Setdate, 
    Blog_Views,Blog_NO
    FROM blog b 
    inner join membertable m
    on b.mem_no = m.mem_no
    where b.mem_no
    And b.Blog_Name like :search_text
    OR b.Blog_Content like :search_text
    OR m.Mem_name Like :search_text
    ";
    //OR a.Attrac_Name like :search_text
    //遊記裡面的景點要不要做考慮一下 如果等等還沒天亮ＸＤ
    //在有效遊記包含相關字詞
    $result = $pdo->prepare($sql);
    $result->bindValue(":search_text",'%'.$_POST['search_text'].'%');
    $result->execute();
    if($result->rowCount()==0){ //查無資料
        echo"{}";
    }else{  //有資料
        $searchResultRows=$result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($searchResultRows);
    }
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>