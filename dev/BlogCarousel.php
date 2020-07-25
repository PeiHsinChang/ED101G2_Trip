<?php 
try{
    // $dsn = "mysql:host=localhost;port=3306;dbname=easyPlanningTrip;charset=utf8";
	// $user = "root";
	// $password = "root";
	// $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    // $pdo = new PDO( $dsn, $user, $password, $options);
    //change to require once after done 
    require_once("connectMemberTable.php");
    
    $sql = "Select Blog_NO, Blog_Name , Blog_PicURL from Blog where Blog_Status=1 order by Blog_NO desc limit 5";
    // $sql="select * from GroupTable limit 5";
    //畫面需要的sql
    $carouselBlog = $pdo->query($sql);
    $carouselBlog->execute();
    // $carouselGroupInfo=array();

    $carouselBlogRows=$carouselBlog->fetchAll(PDO::FETCH_ASSOC);
    //print_r($carouselGroupRows);
    // die;

    echo json_encode($carouselBlogRows,JSON_UNESCAPED_UNICODE);
    
}catch(PDOException $e){
    echo "錯誤行號：",$e->getLine(),"<br>";
    echo "錯誤原因：",$e->getMessage(),"<br>";
    // echo $e->getMessage();
}
?>