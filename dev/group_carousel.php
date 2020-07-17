<?php 
try{
    //change to require once after done 
    require_once("connectMemberTable.php");
    
    $sql = "select Group_title, Group_Pic, 
    Mem_name,Group_StartDate, Group_Deadline, 
    round(Mem_LikeAmount/Mem_LikeSum) hostlike
    FROM grouptable g ,membertable m
    where g.mem_no = m.mem_no
    and  g.Group_Status = 1 order by Group_NO desc limit 5";
    // $sql="select * from GroupTable limit 5";
    //畫面需要的sql

    $groupCards = $pdo->query($sql);
    $groupCards->execute();
    // $carouselGroupInfo=array();

    $groupCarousel=$groupCards->fetchAll(PDO::FETCH_ASSOC);
    // print_r($carouselGroupRows);
    // die;
   
    echo json_encode($groupCarousel,JSON_UNESCAPED_UNICODE);
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>