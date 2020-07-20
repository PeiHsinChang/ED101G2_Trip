<?php 
try{
    require_once("connectMemberTable.php");
    
    //預設全選
    //全部都是任意不限制
    $filter=$_POST["filter"];// 從畫面把選項指令塞過來
    // $sql="select * from GroupTable where Group_Status=1";
    // $sql="select * from GroupTable where Group_Status=1 $filter";
    $sql="select Group_title, Group_Pic, 
    Mem_name,Group_StartDate, Group_Deadline, 
    round(Mem_LikeAmount/Mem_LikeSum) hostlike,Group_NO
    FROM grouptable g 
    inner join membertable m
    on g.mem_no = m.mem_no
    where g.mem_no and Group_Status=1 $filter";
    //畫面需要的sql
    $result = $pdo->prepare($sql);
    $result->execute();

    if($result->rowCount()==0){ //如果沒有
        echo "{}";
    }else{
        //從資料庫拉資料出來
        $filterResultRows=$result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($filterResultRows,JSON_UNESCAPED_UNICODE);
    }
    
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
}
?>