<?php
    session_start();
    $memInfo = $_SESSION["Mem_NO"];

    try{
        require_once("connectMemberTable.php");
                
        //下收藏景點SQL指令
        $sql_keepAttr = 
            "Select a.Attrac_Name `AttracName`, 
            a.Attrac_Region `AttracRegion`, 
            round(Attrac_LikeSum/Attrac_LikeAmount,1) `likecount`, 
            a.Attrac_PicURL `AttracPicURL`
            FROM keep_attrac k, attraction a 
            where  k.Attrac_NO=a.Attrac_NO 
            and Mem_NO=:memId ";
        $keepAttr = $pdo->prepare($sql_keepAttr);
        $keepAttr -> bindValue(":memId", $memInfo);
        $keepAttr -> execute();
        
        //下收藏團SQL指令    
        $sql_keepGroup =
            "Select kg.Group_NO `GroupNO`,g.Group_title `GroupTitle`,
            g.Group_Pic `GroupPic`,g.Group_StartDate `GroupStartDate`,
            g.Group_Deadline `GroupDeadline`, m.Mem_Name `MemName`,  
            round(Mem_LikeAmount / Mem_LikeSum) `MemLike`
            FROM keep_group kg, grouptable g , membertable m
            where  kg.Group_NO = g.Group_NO  
            and g.Mem_NO = m.Mem_NO
            and kg.Mem_NO=:memId";
        $keepGroup = $pdo->prepare($sql_keepGroup);
        $keepGroup -> bindValue(":memId", $memInfo);
        $keepGroup -> execute();
        
        //下收藏行程SQL指令 
        $sql_keepSche = 
            "Select s.Sche_Name `ScheName`, 
            s.Sche_Img `ScheImg`, s.Sche_Views `ScheViews`
            FROM keep_sche ks, sche s
            where ks.Sche_NO = s.Sche_NO  
            and ks.Mem_NO=:memId";
        $keepSche = $pdo->prepare($sql_keepSche);
        $keepSche -> bindValue(":memId", $memInfo);
        $keepSche -> execute();
        
        //下收藏遊記SQL指令 
        $sql_keepBlog = 
            "Select kb.Blog_NO `BlogNO`,b.Blog_Name `BlogName`,
            b.Blog_PicURL `BlogPicURL`,
            b.Blog_Views `BlogViews`, m.Mem_Name `MemName`,
            b.Blog_Date `BlogDate`
            FROM keep_blog kb, blog b , membertable m
            where kb.blog_NO = b.blog_NO 
            and b.mem_NO=m.mem_NO
            and kb.Mem_NO=:memId";  
        $keepBlog = $pdo->prepare($sql_keepBlog);
        $keepBlog -> bindValue(":memId", $memInfo);
        $keepBlog -> execute();
        
        //下我的行程SQL指令
        $sql_MemSche =
            "Select s.Sche_Name `ScheName`, s.Sche_Img `ScheImg`, 
            s.Sche_Views `ScheViews`
            FROM sche s 
            where Mem_NO=:memId";
        $MemSche = $pdo->prepare($sql_MemSche);
        $MemSche -> bindValue(":memId", $memInfo);
        $MemSche -> execute();
        //下我的開團SQL指令
        $sql_MemGroup =
            "Select g.Group_NO `GroupNO`,g.Group_title `GroupTitle`,
            m.mem_name `MemName`, g.Group_StartDate `GroupStartDate`,
            g.Group_Deadline `GroupDeadline`, g.Group_Pic `GroupPic`, 
            round(Mem_LikeAmount / Mem_LikeSum) `hostlike`
            FROM grouptable g , membertable m
            where g.Mem_NO=m.Mem_NO
            and m.mem_NO =:memId";
        $MemGroup = $pdo->prepare($sql_MemGroup);
        $MemGroup -> bindValue(":memId", $memInfo);
        $MemGroup -> execute();
        //下我的遊記SQL指令
        $sql_MemBlog =
            "Select b.Blog_NO `BlogNO`, m.Mem_Name `MemName`,
            b.Blog_Name `BlogName`, b.Blog_Date `BlogDate`, 
            b.Blog_PicURL `BlogPicURL`, Blog_Views `BlogViews`
            FROM blog b , membertable m
            where b.Mem_NO = m.Mem_NO
            and m.mem_NO =:memId";
        $MemBlog = $pdo->prepare($sql_MemBlog);
        $MemBlog -> bindValue(":memId", $memInfo);
        $MemBlog -> execute();
        
        //下篩選地區SQL 
        $sql_FilterArea =
        "select distinct(Attrac_Region),
        case  attraction.Attrac_Region  when '' then '其他' 
        else attraction.Attrac_Region end as A_R 
        FROM easyplanningtrip.attraction ";
        $FilterArea = $pdo->prepare($sql_FilterArea);
        $FilterArea -> execute();


        //建存放所有收藏資料
        $AllKeepPackage=array();
        //建收藏景點資料
        if($keepAttr -> rowCount()==0 ){
            $attracInfo=[];
        }else{
            $attracInfo=array();
            while($keepAttrRows = $keepAttr->fetch(PDO::FETCH_ASSOC)){
                $attracInfo[] = array(
                    "Attrac_Name"=>$keepAttrRows["AttracName"],
                    "Attrac_Region"=>$keepAttrRows["AttracRegion"],
                    "likecount"=>$keepAttrRows["likecount"],
                    "Attrac_PicURL"=>$keepAttrRows["AttracPicURL"]
                );	
            }
        }
        //所有Keep資料串接
        array_push($AllKeepPackage,$attracInfo);
        //建收藏團資料
        if($keepGroup -> rowCount()==0 ){
            $GroupInfo=[];        
        }else{
            $GroupInfo=array();
            while($keepGroupRows = $keepGroup->fetch(PDO::FETCH_ASSOC)){
                $GroupInfo[] = array(
                    "Group_NO"=>$keepGroupRows["GroupNO"],
                    "Group_title"=>$keepGroupRows["GroupTitle"],
                    "Group_Pic"=>$keepGroupRows["GroupPic"],
                    "Group_StartDate"=>$keepGroupRows["GroupStartDate"],
                    "Group_Deadline"=>$keepGroupRows["GroupDeadline"],
                    "Mem_Name"=>$keepGroupRows["MemName"],
                    "MemLike"=>$keepGroupRows["MemLike"],              
                );
            }                
        }
        //所有Keep資料串接
        array_push($AllKeepPackage,$GroupInfo);
        //建收藏行程資料
        if($keepSche -> rowCount()==0 ){
            $ScheInfo=[];
        }else{
            $ScheInfo=array();
            while($keepScheRows = $keepSche->fetch(PDO::FETCH_ASSOC)){
                $ScheInfo[] = array(
                    "Sche_Name"=>$keepScheRows["ScheName"],
                    "Sche_Img"=>$keepScheRows["ScheImg"],
                    "Sche_Views"=>$keepScheRows["ScheViews"],
                );	
            }            
        }
        //所有Keep資料串接
        array_push($AllKeepPackage,$ScheInfo);

        // //建收藏遊記資料
        if($keepBlog -> rowCount()==0 ){
            $BlogInfo=[];
        }else{
            $BlogInfo=array();
            while($keepBlogRows = $keepBlog->fetch(PDO::FETCH_ASSOC)){
                $BlogInfo[] = array(           
                    "Blog_NO"=>$keepBlogRows["BlogNO"],
                    "Blog_Name"=>$keepBlogRows["BlogName"],
                    "Blog_PicURL"=>$keepBlogRows["BlogPicURL"],
                    "Blog_Views"=>$keepBlogRows["BlogViews"],
                    "Mem_Name"=>$keepBlogRows["MemName"],
                    "Blog_Date"=>$keepBlogRows["BlogDate"]
                );	
            }            
        }
        // //所有Keep資料串接
        array_push($AllKeepPackage,$BlogInfo);
        //建我的行程資料
        if($MemSche -> rowCount()==0 ){
            $MemScheInfo=[];
            // echo $MemScheInfo[];
        }else{
            $MemScheInfo=array();
            while($MemScheRows = $MemSche->fetch(PDO::FETCH_ASSOC)){
                $MemScheInfo[] = array(
                    "Sche_Name"=>$MemScheRows["ScheName"],
                    "Sche_Img"=>$MemScheRows["ScheImg"],
                    "Sche_Views"=>$MemScheRows["ScheViews"]
                );	
            }            
        }
        //所有資料串接
        array_push($AllKeepPackage,$MemScheInfo);
        //建開團資料
        if($MemGroup -> rowCount()==0 ){
            $MemGroupInfo=[];
        }else{
            $MemGroupInfo=array();
            while($MemGroupRows = $MemGroup->fetch(PDO::FETCH_ASSOC)){
                $MemGroupInfo[] = array(
                    "Group_NO"=>$MemGroupRows["GroupNO"],
                    "Group_title"=>$MemGroupRows["GroupTitle"],
                    "mem_name"=>$MemGroupRows["MemName"],
                    "Group_StartDate"=>$MemGroupRows["GroupStartDate"],
                    "Group_Deadline"=>$MemGroupRows["GroupDeadline"],
                    "Group_Pic"=>$MemGroupRows["GroupPic"],
                    "hostlike"=>$MemGroupRows["hostlike"],
                );	
            }            
        }
        //所有資料串接
        array_push($AllKeepPackage,$MemGroupInfo);
        //建開團資料
        if($MemBlog -> rowCount()==0 ){
            $MemBlogInfo=[];
        }else{

            $MemBlogInfo=array();
            while($MemBlogRows = $MemBlog->fetch(PDO::FETCH_ASSOC)){
                $MemBlogInfo[] = array(
                    "Blog_NO"=>$MemBlogRows["BlogNO"],
                    "Blog_Name"=>$MemBlogRows["BlogName"],
                    "mem_name"=>$MemBlogRows["MemName"],
                    "Blog_Date"=>$MemBlogRows["BlogDate"],
                    "Blog_PicURL"=>$MemBlogRows["BlogPicURL"],
                    "Blog_Views"=>$MemBlogRows["BlogViews"],
                );	
            }            
        }
        //所有資料串接
        array_push($AllKeepPackage,$MemBlogInfo);

        //建開團資料
        if($FilterArea -> rowCount()==0 ){
            $FilterAreaInfo=[];
        }else{
            while($FilterAreaRows = $FilterArea->fetch(PDO::FETCH_ASSOC)){
                $FilterAreaInfo[] = array(
                    "A_R"=>$FilterAreaRows["A_R"],   
                );	
            }            
        }
        // echo print_r($FilterAreaInfo);
        //所有資料串接
        array_push($AllKeepPackage,$FilterAreaInfo);

        //送出景點資料  
        echo json_encode($AllKeepPackage,JSON_UNESCAPED_UNICODE);
    }catch(PDOException $e){
        echo $e->getMessage();
    }




?>

