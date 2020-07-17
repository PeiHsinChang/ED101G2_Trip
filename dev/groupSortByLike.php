<?php 
try{
    require_once("connectMemberTable.php");
    $sql = "select Group_NO,round(Mem_LikeAmount/Mem_LikeSum) hostlike 
    FROM grouptable g ,membertable m where g.mem_no = m.mem_no order by hostlike desc";
    
    $groupSortLike = $pdo->query($sql);
    $groupSortLike->execute();
    $groupSortLikeRows=$groupSortLike->fetchAll(PDO::FETCH_ASSOC);
    // r_print($hotScheRows);
    // die;
    echo json_encode($groupSortLikeRows,JSON_UNESCAPED_UNICODE);
}catch (PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
}
?>