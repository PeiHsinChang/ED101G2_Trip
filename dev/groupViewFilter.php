<?php 
try{
    require_once("connectMemberTable.php");
    
    $ppl=$_GET["groupView_FliterPpl"];
    $sex=$_GET["groupView_FliterSex"];
    $day=$_GET["groupView_FliterDay"];
    $month=$_GET["groupView_FliterMonth"];
    
    //預設全選
    //全部都是任意不限制
    $sql="select * from GroupTable 
    where Group_Status =1";
    $sql="select * from GroupTable
    Where Group";

    
    
    
    // $sql="select * from GroupTable limit 5";
    //畫面需要的sql
    $result = $pdo->query($sql);
    $result->execute();

    $GroupRows=$result->fetchAll(PDO::FETCH_ASSOC);
    // print_r($carouselGroupRows);
    // die;

    echo json_encode($GroupRows,JSON_UNESCAPED_UNICODE);
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>