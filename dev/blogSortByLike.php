<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
    $sql="select Blog_Name, Blog_PicURL, 
        Mem_name,Blog_Date, Blog_Setdate, 
        Blog_Views
        FROM blog b ,membertable m
        where b.mem_no = m.mem_no 
        order by Blog_Views desc";

    $blogCardsLike = $pdo->query($sql); 
    $blogCardsLike -> execute();

    //卡片們所需要資料
    $blogviewSortLike=array();//array不得與pdoStatement同名
    if($blogCardsLike -> rowCount()==0){
        echo "{}";
    }else{
        $blogSortLikeInfo=array();
        while($blogCardsLikeRows = $blogCardsLike->fetch(PDO::FETCH_ASSOC)){
        $blogSortLikeInfo[] = array(
                "Blog_Name"=>$blogCardsLikeRows["Blog_Name"],
                "Blog_PicURL"=>$blogCardsLikeRows["Blog_PicURL"],
                "Mem_name"=>$blogCardsLikeRows["Mem_name"],
                "Blog_Date"=>$blogCardsLikeRows["Blog_Date"],
                "Blog_Setdate"=>$blogCardsLikeRows["Blog_Setdate"],
                "Blog_Views"=>$blogCardsLikeRows["Blog_Views"],
            );	
        }   
    }

    //串接資料
    array_push($blogviewSortLike,$blogSortLikeInfo);
    echo json_encode($blogviewSortLike,JSON_UNESCAPED_UNICODE);

}catch(PDOException $e){
 echo "錯誤行號:", $e->getLine(),"<br>";
 echo "錯誤原因:", $e->getMessage(),"<br>";
}


?>