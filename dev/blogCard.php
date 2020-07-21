<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
    $sql="select Blog_Name, Blog_PicURL, 
        Mem_name,Blog_Date, Blog_Setdate, 
        Blog_Views,Blog_NO
        FROM Blog b ,membertable m
        where b.mem_no = m.mem_no";
    
    $blogCards = $pdo->query($sql); 
    $blogCards -> execute();


    //卡片們所需要資料
    $blogviewCards=array();//array不得與pdoStatement同名
    if($blogCards -> rowCount()==0){
        echo "{}";
    }else{
        $blogCardsInfo=array();
        while($blogCardsRows = $blogCards->fetch(PDO::FETCH_ASSOC)){
        $blogCardsInfo[] = array(
                "Blog_NO"=>$blogCardsRows["Blog_NO"],
                "Blog_Name"=>$blogCardsRows["Blog_Name"],
                "Blog_PicURL"=>$blogCardsRows["Blog_PicURL"],
                "Mem_name"=>$blogCardsRows["Mem_name"],
                "Blog_Date"=>$blogCardsRows["Blog_Date"],
                "Blog_Views"=>$blogCardsRows["Blog_Views"],
            );	
        }   
    }

    //串接資料
    array_push($blogviewCards,$blogCardsInfo);
    echo json_encode($blogviewCards,JSON_UNESCAPED_UNICODE);

}catch(PDOException $e){
 echo "錯誤行號:", $e->getLine(),"<br>";
 echo "錯誤原因:", $e->getMessage(),"<br>";
}


?>