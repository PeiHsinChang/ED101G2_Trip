<?php 
try{
    $dsn = "mysql:host=localhost;port=3306;dbname=easyPlanningTrip;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO( $dsn, $user, $password, $options);
    //change to require once after done 
    // require_once("connectMemberTable.php");
    
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
    // $carouselGroupInfo=array(
    //         "GroupDays"=>$carouselGroupRows["GroupDays"],
    //         "Group_title"=>$carouselGroupRows["Group_title"],
    //         "Group_pic"=>$carouselGroupRows["Group_pic"],
    //     );
    // foreach($carouselGroupInfo as  $key => $value){
    //     echo $key , $carouselGroupInfo;
    // }
    // $carouselGroupInfo=array();
    while($carouselGroupRows=$carousel->fetchAll(PDO::FETCH_ASSOC)){
        $carouselGroupInfo[]=array(
            "GroupDays"=>$carouselGroupRows["GroupDays"],
            "Group_title"=>$carouselGroupRows["Group_title"],
            "Group_pic"=>$carouselGroupRows["Group_pic"],
        );
    };
    // $carouselGroupInfo=array();
    // foreach(){

    // }
    // $carouselGroupInfo=array(
    //     "GroupDays"=>$carouselGroupRows["GroupDays"],
    //     "Group_title"=>$carouselGroupRows["Group_title"],
    //     "Group_pic"=>$carouselGroupRows["Group_pic"],
    // );
    // for($i=0;$i<5;$i++){
    //     foreach($i as $carouselGroupInfo => $value){
    //         echo $carouselGroupInfo;
    //     }
        // $carouselGroupInfo[]=array(
        //     "GroupDays"=>$carouselGroupRows["GroupDays"],
        //     "Group_title"=>$carouselGroupRows["Group_title"],
        //     "Group_pic"=>$carouselGroupRows["Group_pic"],
        // );
    // };
    // foreach( $carouselGroupRows as $i){
    //     $carouselGroupInfo[]=array(
    //         "GroupDays"=>$carouselGroupRows["GroupDays"],
    //         "Group_title"=>$carouselGroupRows["Group_title"],
    //         "Group_pic"=>$carouselGroupRows["Group_pic"],
    //     );
    // }
    // $carousel->bindValue(":Group_NO", $GroupNo);
    // 只拉資料出來不需要bindValue 
    


    // echo $carouselGroupInfo;
    echo json_encode($carouselGroupInfo,JSON_UNESCAPED_UNICODE);
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>