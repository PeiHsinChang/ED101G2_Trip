<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
    $sql="select Blog_NO, Blog_Name, Blog_PicURL, 
        Mem_name,Blog_Date, Blog_Setdate, 
        Blog_Views
        FROM Blog b ,membertable m
        where b.mem_no = m.mem_no 
        order by Blog_NO desc";

    $blogCardsLatest = $pdo->query($sql); 
    $blogCardsLatest -> execute();

    //卡片們所需要資料
    $blogviewSortLatest=array();//array不得與pdoStatement同名
    if($blogCardsLatest -> rowCount()==0){
        echo "{}";
    }else{
        $blogSortLatestInfo=array();
        while($blogCardsLatestRows = $blogCardsLatest->fetch(PDO::FETCH_ASSOC)){
        $blogSortLatestInfo[] = array(
                "Blog_Name"=>$blogCardsLatestRows["Blog_Name"],
                "Blog_PicURL"=>$blogCardsLatestRows["Blog_PicURL"],
                "Mem_name"=>$blogCardsLatestRows["Mem_name"],
                "Blog_Date"=>$blogCardsLatestRows["Blog_Date"],
                "Blog_Setdate"=>$blogCardsLatestRows["Blog_Setdate"],
                "Blog_Views"=>$blogCardsLatestRows["Blog_Views"],
            );	
        }   
    }

    //串接資料
    array_push($blogviewSortLatest,$blogSortLatestInfo);
    echo json_encode($blogviewSortLatest,JSON_UNESCAPED_UNICODE);

}catch(PDOException $e){
 echo "錯誤行號:", $e->getLine(),"<br>";
 echo "錯誤原因:", $e->getMessage(),"<br>";
}


?>