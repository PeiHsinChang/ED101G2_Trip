<?php 
try{
    require_once("connectMemberTable.php");
    //把資訊塞進去sql裡面
    $sql="select Group_title, Group_Pic, 
    Mem_name,Group_StartDate, Group_Deadline, 
    round(Mem_LikeAmount/Mem_LikeSum) hostlike,Group_NO
    FROM grouptable g 
    inner join membertable m
    on g.mem_no = m.mem_no
    where g.mem_no
    And g.Group_title like :search_text
    OR g.Group_Place like :search_text
    OR g.Group_Com like :search_text";
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
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>