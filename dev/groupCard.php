<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
    $sql="select Group_title, Group_Pic, 
        Mem_name,Group_StartDate, Group_Deadline, 
        round(Mem_LikeAmount/Mem_LikeSum) hostlike
        FROM grouptable g ,membertable m
        where g.mem_no = m.mem_no";

    $groupCards = $pdo->query($sql); 
    $groupCards -> execute();


    //卡片們所需要資料
    $groupviewCards=array();//array不得與pdoStatement同名
    if($groupCards -> rowCount()==0){
        echo "{}";
    }else{
        $groupCardsInfo=array();
        while($groupCardsRows = $groupCards->fetch(PDO::FETCH_ASSOC)){
        $groupCardsInfo[] = array(
                "Group_title"=>$groupCardsRows["Group_title"],
                "Group_Pic"=>$groupCardsRows["Group_Pic"],
                "Mem_name"=>$groupCardsRows["Mem_name"],
                "Group_StartDate"=>$groupCardsRows["Group_StartDate"],
                "Group_Deadline"=>$groupCardsRows["Group_Deadline"],
                "hostlike"=>$groupCardsRows["hostlike"],
            );	
        }   
       
        
    }

    //串接資料
    array_push($groupviewCards,$groupCardsInfo);
    echo json_encode($groupviewCards,JSON_UNESCAPED_UNICODE);

}catch(PDOException $e){
 echo "錯誤行號:", $e->getLine(),"<br>";
 echo "錯誤原因:", $e->getMessage(),"<br>";
}


?>