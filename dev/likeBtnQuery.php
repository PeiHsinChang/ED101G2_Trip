<?php 
  try{
  require_once("connectMemberTable.php");  
  session_start();
  $memInfo = $_SESSION["Mem_NO"];
  $likeSpot = json_decode($_POST["keepLikeInfo"],true); 
  $iskeep =  $likeSpot['iskeep'];
  $LikeTitle = $likeSpot['Like_Title'];
  $ls= $likeSpot["Like_Id"];

  if($iskeep==false){ //not like
    if( $LikeTitle == "spot"){
    //like button for 景點
    $sql =
      "delete k from keep_attrac k
      inner join attraction a 
      on k.Attrac_NO=a.Attrac_NO 
      where a.attrac_Name=:TitleName
      and k.Mem_NO=:memId"; 
     
    }else if($LikeTitle == "sche"){
    //like button for 行程
    $sql =
      "delete ks from keep_sche ks
      inner join sche s 
      on ks.Sche_NO=s.Sche_NO 
      and s.Sche_Name=:TitleName
      and ks.Mem_NO=:memId";      

    }else if($LikeTitle == "group"){
      //like button for 團
      $sql =
      "delete kg from Keep_group kg
      inner join grouptable g
      on kg.group_NO = g.group_NO 
      where  g.Group_title=:TitleName
      and kg.Mem_NO=:memId";
      
      }else{
      //like button for 遊記
      $sql =
      "delete kb from Keep_Blog kb
      inner join blog b 
      on kb.Blog_NO= b.Blog_NO 
      where  b.Blog_Name=:TitleName
      and kb.Mem_NO=:memId";

      }
  }else{ //like
    if( $LikeTitle == "spot"){
      //like button for 景點
      $sql =
      "insert into Keep_Attrac (Mem_NO, Attrac_NO)
      select m.Mem_NO, a.Attrac_NO 
      from membertable m inner join attraction a
      on  a.attrac_Name=:TitleName
      where m.Mem_NO=:memId";
    
      }else if($LikeTitle == "sche"){
      //like button for 行程
      $sql =
        "insert into Keep_Sche (Mem_NO, Sche_NO)
        select m.Mem_NO, s.Sche_NO 
        from membertable m inner join Sche s 
        on  s.Sche_Name=:TitleName
        where m.Mem_NO=:memId;";

      }else if($LikeTitle == "group"){
        //like button for 團
        $sql =
        "insert into Keep_Group (Mem_NO, Group_NO)
        select m.Mem_NO, g.Group_NO 
        from membertable m inner join Grouptable s 
        on  g.Group_title=:TitleName
        where m.Mem_NO=:memId;";

        }else{
        //like button for 遊記
        $sql =
        "insert into Keep_Blog (Mem_NO, Blog_NO)
        select m.Mem_NO, b.Blog_NO 
        from membertable m inner join Blog b 
        on  b.Blog_Name=:TitleName
        where m.Mem_NO=:memId;";

        }
        
        
  }


  $likeSpot111 = $pdo->prepare($sql);
  $likeSpot111->bindValue(":memId", $memInfo);
  $likeSpot111->bindValue(":TitleName", $ls);
  $likeSpot111->execute();
  echo "執行成功" ;
  // die;
}catch(PDOException $e){
  echo $e->getMessage();
}



?>


