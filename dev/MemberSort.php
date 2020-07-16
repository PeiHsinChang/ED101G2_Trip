<?php 

session_start();
  $memInfo = $_SESSION["Mem_NO"];
  $sortKeep = json_decode($_POST["keepSortObj"],true); 
  $sortType = $sortKeep['keepSort'];
  try{
    require_once("connectMemberTable.php");
    if($sortType=="groupNew"){
      //group SQL sort by new 
      $sql_sort = 
        "select Group_title, Group_Pic, g.Group_No,
        Group_StartDate, Group_Deadline,
        Mem_Name, round(Mem_LikeAmount / Mem_LikeSum) MemLike
        FROM keep_group kg, grouptable g , membertable m
        where  kg.Group_NO = g.Group_NO  
        and g.Mem_NO = m.Mem_NO
        and kg.Mem_NO=:memId
        order by g.Group_No Desc;";
      //group SQL sort by popular 
      // $sql_keepGroupPopular = 
      //   "select Group_title, Group_Pic, g.Group_No,
      //   Group_StartDate, Group_Deadline,
      //   Mem_Name, round(Mem_LikeAmount / Mem_LikeSum) MemLike
      //   FROM keep_group kg, grouptable g , membertable m
      //   where  kg.Group_NO = g.Group_NO  
      //   and g.Mem_NO = m.Mem_NO
      //   and kg.Mem_NO=:memId
      //   order by MemLike  Desc;";

      }else if($sortType=="scheNew"){
      //schedule SQL sort by new 
      $sql_sort = 
        "select Sche_Name, Sche_Img, Sche_Views, s.Sche_NO
        FROM keep_sche ks, sche s
        where ks.Sche_NO = s.Sche_NO  
        and ks.Mem_NO=:memId
        order by  s.Sche_NO  Desc;";

      }else if($sortType=="schePop"){
      //schedule SQL sort by popular 
      $sql_sort = 
        "select Sche_Name, Sche_Img, Sche_Views, s.Sche_NO
        FROM keep_sche ks, sche s
        where ks.Sche_NO = s.Sche_NO  
        and ks.Mem_NO=:memId
        order by  s.Sche_NO  Desc;";
      }else if($sortType=="blogNew"){
      //Blog SQL sort by new 
      $sql_sort = 
        "select Blog_Name, Blog_PicURL, 
        Blog_Views, mem_name,Blog_Date
        FROM keep_blog kb, blog b , membertable m
        where kb.blog_NO = b.blog_NO 
        and m.mem_NO = b.mem_NO
        and kb.Mem_NO=:memId
        order by b.blog_date  Desc;";
      }else if($sortType=="blogPop"){
      //Blog SQL sort by new 
      $sql_sort = 
        "select Blog_Name, Blog_PicURL, 
        Blog_Views, mem_name,Blog_Date
        FROM keep_blog kb, blog b , membertable m
        where kb.blog_NO = b.blog_NO 
        and m.mem_NO = b.mem_NO
        and kb.Mem_NO=:memId
        order by Blog_Views  Desc;";
      }
  
      $keepSortpdo = $pdo-> prepare($sql_sort);
      $keepSortpdo -> bindValue(":memId", $memInfo);
      $keepSortpdo -> execute();
    
      //建收藏景點資料
      if($sortType=="groupNew"){
        if($keepSortpdo -> rowCount()==0 ){
          $SortData=[];
        }else{
          $SortData=array();
          while($keepSortpdoRows = $keepSortpdo->fetch(PDO::FETCH_ASSOC)){
            $SortData[] = array(
              "Group_title"=>$keepSortpdoRows["Group_title"],
              "Group_Pic"=>$keepSortpdoRows["Group_Pic"],
              "Group_StartDate"=>$keepSortpdoRows["Group_StartDate"],
              "Group_Deadline"=>$keepSortpdoRows["Group_Deadline"],
              "Mem_Name"=>$keepSortpdoRows["Mem_Name"],
              "MemLike"=>$keepSortpdoRows["MemLike"],
              );	
          }            
      }
        }else if($sortType=="scheNew"){
          if($keepSortpdo -> rowCount()==0 ){
            $SortData=[];
          }else{
            $SortData=array();
            while($keepSortpdoRows = $keepSortpdo->fetch(PDO::FETCH_ASSOC)){
              $SortData[] = array(
                "Sche_Name"=>$keepSortpdoRows["Sche_Name"],
                "Sche_Img"=>$keepSortpdoRows["Sche_Img"],
                "Sche_Views"=>$keepSortpdoRows["Sche_Views"],
                );	
            }            
        }
        }else if($sortType=="schePop"){
          if($keepSortpdo -> rowCount()==0 ){
            $SortData=[];
          }else{
            $SortData=array();
            while($keepSortpdoRows = $keepSortpdo->fetch(PDO::FETCH_ASSOC)){
              $SortData[] = array(
                "Sche_Name"=>$keepSortpdoRows["Sche_Name"],
                "Sche_Img"=>$keepSortpdoRows["Sche_Img"],
                "Sche_Views"=>$keepSortpdoRows["Sche_Views"],
                );	
            }            
        }
        
        }else if($sortType=="blogNew"){
          if($keepSortpdo -> rowCount()==0 ){
            $SortData=[];
          }else{
            $SortData=array();
            while($keepSortpdoRows = $keepSortpdo->fetch(PDO::FETCH_ASSOC)){
              $SortData[] = array(
                "Blog_Name"=>$keepSortpdoRows["Blog_Name"],
                "Blog_PicURL"=>$keepSortpdoRows["Blog_PicURL"],
                "Blog_Views"=>$keepSortpdoRows["Blog_Views"],
                "mem_name"=>$keepSortpdoRows["mem_name"],
                "Blog_Date"=>$keepSortpdoRows["Blog_Date"]
                );	
            }            
        }
        
        
        }else if($sortType=="blogPop"){
          if($keepSortpdo -> rowCount()==0 ){
            $SortData=[];
          }else{
            $SortData=array();
            while($keepSortpdoRows = $keepSortpdo->fetch(PDO::FETCH_ASSOC)){
              $SortData[] = array(
                "Blog_Name"=>$keepSortpdoRows["Blog_Name"],
                "Blog_PicURL"=>$keepSortpdoRows["Blog_PicURL"],
                "Blog_Views"=>$keepSortpdoRows["Blog_Views"],
                "mem_name"=>$keepSortpdoRows["mem_name"],
                "Blog_Date"=>$keepSortpdoRows["Blog_Date"]
                );	
            }            
          }
        }
      //送出景點資料  
      echo json_encode($SortData,JSON_UNESCAPED_UNICODE);
  }catch(PDOException $e){
      echo $e->getMessage();
  }
?>