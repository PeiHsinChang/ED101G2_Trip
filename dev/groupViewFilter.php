<?php 
try{
    require_once("connectMemberTable.php");
    
    // $ppl=$_POST["groupView_FliterPpl"];
    // $sex=$_POST["groupView_FliterSex"];
    // $day=$_POST["groupView_FliterDay"];
    // $month=$_POST["groupView_FliterMonth"];
    // $a=json_decode()
    // $likeSpot = json_decode($_POST["keepLikeInfo"],true);
    //ajax get value
    
    //預設全選
    //全部都是任意不限制
    // $sql="select * from GroupTable 
    // where Group_Status =1";

    $sql="select * from GroupTable where Group_Status=1 :groupView_FliterPpl :groupView_FliterSex :groupView_FliterDay :groupView_FliterMonth";
    // $sql="select * from GroupTable where Group_Status=1";
    
    
    
    // $sql="select * from GroupTable limit 5";
    //畫面需要的sql
    $result = $pdo->prepare($sql);
    $result->bindValue(":groupView_FliterPpl",$_POST["groupView_FliterPpl"]);
    $result->bindValue(":groupView_FliterSex",$_POST["groupView_FliterSex"]);
    $result->bindValue(":groupView_FliterDay",$_POST["groupView_FliterDay"]);
    $result->bindValue(":groupView_FliterMonth",$_POST["groupView_FliterMonth"]);
    $result->execute();

    $GroupRows=$result->fetchAll(PDO::FETCH_ASSOC);
    // print_r($carouselGroupRows);
    // die;
    if($result->rowCount()==0){
        echo "{}";
    }else{
        $searchResultRows=$result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($GroupRows,JSON_UNESCAPED_UNICODE);
    }
    
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>