<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
    $sql="select Group_NO, Group_title, Group_Pic, 
        Mem_name,Group_StartDate, Group_Deadline, 
        round(Mem_LikeAmount/Mem_LikeSum) hostlike
        FROM grouptable g ,membertable m
        where g.mem_no = m.mem_no 
        order by Group_NO desc";

    $groupCardsLatest = $pdo->query($sql); 
    $groupCardsLatest -> execute();

    //卡片們所需要資料
    $groupviewSortLatest=array();//array不得與pdoStatement同名
    if($groupCardsLatest -> rowCount()==0){
        echo "{}";
    }else{
        $groupSortLatestInfo=array();
        while($groupCardsLatestRows = $groupCardsLatest->fetch(PDO::FETCH_ASSOC)){
        $groupSortLatestInfo[] = array(
                "Group_title"=>$groupCardsLatestRows["Group_title"],
                "Group_Pic"=>$groupCardsLatestRows["Group_Pic"],
                "Mem_name"=>$groupCardsLatestRows["Mem_name"],
                "Group_StartDate"=>$groupCardsLatestRows["Group_StartDate"],
                "Group_Deadline"=>$groupCardsLatestRows["Group_Deadline"],
                "hostlike"=>$groupCardsLatestRows["hostlike"],
            );	
        }   
    }

    //串接資料
    array_push($groupviewSortLatest,$groupSortLatestInfo);
    echo json_encode($groupviewSortLatest,JSON_UNESCAPED_UNICODE);

}catch(PDOException $e){
 echo "錯誤行號:", $e->getLine(),"<br>";
 echo "錯誤原因:", $e->getMessage(),"<br>";
}


?>