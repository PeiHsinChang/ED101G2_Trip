<?php 
try{
    require_once("connectMemberTable.php");
    
    $sql = "Select datediff(Group_EndDate,Group_StartDate)+1 `GroupDays`, Group_title , Group_pic 
    from GroupTable where Group_Status=1 order by Group_NO desc limit 5";
    // $sql="select * from GroupTable limit 5";
    //畫面需要的sql
    $carousel = $pdo->query($sql);
    $carousel->execute();
    // $carouselGroupInfo=array();

    $carouselGroupRows=$carousel->fetchAll(PDO::FETCH_ASSOC);
    // print_r($carouselGroupRows);
    // die;

    echo json_encode($carouselGroupRows,JSON_UNESCAPED_UNICODE);
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>