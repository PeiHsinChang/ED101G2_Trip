<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
    $sql="select Group_title, Group_Pic, 
        Mem_name,Group_StartDate, Group_Deadline, 
        round(Mem_LikeAmount/Mem_LikeSum) hostlike
        FROM grouptable g ,membertable m
        where g.mem_no = m.mem_no 
        order by hostlike desc";

    $groupCardsLike = $pdo->query($sql); 
    $groupCardsLike -> execute();

    //卡片們所需要資料
    $groupviewSortLike=array();//array不得與pdoStatement同名
    if($groupCardsLike -> rowCount()==0){
        echo "{}";
    }else{
        $groupSortLikeInfo=array();
        while($groupCardsLikeRows = $groupCardsLike->fetch(PDO::FETCH_ASSOC)){
        $groupSortLikeInfo[] = array(
                "Group_title"=>$groupCardsLikeRows["Group_title"],
                "Group_Pic"=>$groupCardsLikeRows["Group_Pic"],
                "Mem_name"=>$groupCardsLikeRows["Mem_name"],
                "Group_StartDate"=>$groupCardsLikeRows["Group_StartDate"],
                "Group_Deadline"=>$groupCardsLikeRows["Group_Deadline"],
                "hostlike"=>$groupCardsLikeRows["hostlike"],
            );	
        }   
    }

    //串接資料
    array_push($groupviewSortLike,$groupSortLikeInfo);
    echo json_encode($groupviewSortLike,JSON_UNESCAPED_UNICODE);

}catch(PDOException $e){
 echo "錯誤行號:", $e->getLine(),"<br>";
 echo "錯誤原因:", $e->getMessage(),"<br>";
}


?>