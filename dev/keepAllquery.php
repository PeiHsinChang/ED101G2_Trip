<?php
    session_start();
    $memInfo = $_SESSION["Mem_NO"];
    // $loginInfo = json_decode($_POST["memInfo"]); 

    try{
        require_once("connectMemberTable.php");
        //下收藏景點SQL指令
        $sql_keepAttr = "select Attrac_Name, Attrac_Region, 
            round(Attrac_LikeSum/Attrac_LikeAmount,1) likecount, 
            Attrac_PicURL
            FROM keep_attrac k, attraction a 
            where  k.Attrac_NO=a.Attrac_NO 
            and Mem_NO=:memId ";
        $keepAttr = $pdo->prepare($sql_keepAttr);
        $keepAttr -> bindValue(":memId", $memInfo);
        $keepAttr -> execute();
        //下收藏團SQL指令      
        $sql_keepGroup ="select Group_title, Group_Pic, 
            Group_StartDate, Group_Deadline,
            Mem_Name, round(Mem_LikeAmount / Mem_LikeSum) MemLike
            FROM keep_group kg, grouptable g , membertable m
            where  kg.Group_NO = g.Group_NO  
            and g.Mem_NO = m.Mem_NO
            and kg.Mem_NO=:memId";
        $keepGroup = $pdo->prepare($sql_keepGroup);
        $keepGroup -> bindValue(":memId", $memInfo);
        $keepGroup -> execute();
        //下收藏行程SQL指令 
        $sql_keepSche = "select Sche_Name, Sche_Img, Sche_Views
            FROM keep_sche ks, sche s
            where ks.Sche_NO = s.Sche_NO  
            and ks.Mem_NO=:memId";
        $keepSche = $pdo->prepare($sql_keepSche);
        $keepSche -> bindValue(":memId", $memInfo);
        $keepSche -> execute();
        //下收藏遊記SQL指令 
        $sql_keepBlog = "select Blog_Name, Blog_PicURL, 
            Blog_Views, mem_name,Blog_Date
            FROM keep_blog kb, blog b , membertable m
            where kb.blog_NO = b.blog_NO 
            and m.mem_NO = b.mem_NO
            and kb.Mem_NO=:memId";
        $keepBlog = $pdo->prepare($sql_keepBlog);
        $keepBlog -> bindValue(":memId", $memInfo);
        $keepBlog -> execute();
        //下我的行程SQL指令
        $sql_MemSche ="select Sche_Name, Sche_Img, Sche_Views
            FROM sche 
            where Mem_NO=:memId";
        $MemSche = $pdo->prepare($sql_MemSche);
        $MemSche -> bindValue(":memId", $memInfo);
        $MemSche -> execute();
        //下我的開團SQL指令
        $sql_MemGroup ="select Group_title, mem_name, 
            Group_StartDate , Group_Deadline, Group_Pic, 
            round(Mem_LikeAmount / Mem_LikeSum) hostlike
            FROM grouptable g , membertable m
            where g.Mem_NO=m.Mem_NO
            and m.mem_NO =:memId";
        $MemGroup = $pdo->prepare($sql_MemGroup);
        $MemGroup -> bindValue(":memId", $memInfo);
        $MemGroup -> execute();
        //下我的遊記SQL指令
        $sql_MemBlog ="select Blog_Name, mem_name, Blog_Date , 
            Blog_PicURL, Blog_Views 
            FROM blog b , membertable m
            where b.Mem_NO = m.Mem_NO
            and m.mem_NO =:memId";
        $MemBlog = $pdo->prepare($sql_MemBlog);
        $MemBlog -> bindValue(":memId", $memInfo);
        $MemBlog -> execute();
        

        //建存放所有收藏資料
        $AllKeepPackage=array();
        //建收藏景點資料
        if($keepAttr -> rowCount()==0 ){
            $attracInfo=[];
        }else{
            $attracInfo=array();
            while($keepAttrRows = $keepAttr->fetch(PDO::FETCH_ASSOC)){
                $attracInfo[] = array(
                    "Attrac_Name"=>$keepAttrRows["Attrac_Name"],
                    "Attrac_Region"=>$keepAttrRows["Attrac_Region"],
                    "likecount"=>$keepAttrRows["likecount"],
                    "Attrac_PicURL"=>$keepAttrRows["Attrac_PicURL"]
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
                    "Group_title"=>$keepGroupRows["Group_title"],
                    "Group_Pic"=>$keepGroupRows["Group_Pic"],
                    "Group_StartDate"=>$keepGroupRows["Group_StartDate"],
                    "Group_Deadline"=>$keepGroupRows["Group_Deadline"],
                    "Mem_Name"=>$keepGroupRows["Mem_Name"],
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
                    "Sche_Name"=>$keepScheRows["Sche_Name"],
                    "Sche_Img"=>$keepScheRows["Sche_Img"],
                    "Sche_Views"=>$keepScheRows["Sche_Views"],
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
                    "Blog_Name"=>$keepBlogRows["Blog_Name"],
                    "Blog_PicURL"=>$keepBlogRows["Blog_PicURL"],
                    "Blog_Views"=>$keepBlogRows["Blog_Views"],
                    "mem_name"=>$keepBlogRows["mem_name"],
                    "Blog_Date"=>$keepBlogRows["Blog_Date"]
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
                    "Sche_Name"=>$MemScheRows["Sche_Name"],
                    "Sche_Img"=>$MemScheRows["Sche_Img"],
                    "Sche_Views"=>$MemScheRows["Sche_Views"]
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
                    "Group_title"=>$MemGroupRows["Group_title"],
                    "mem_name"=>$MemGroupRows["mem_name"],
                    "Group_StartDate"=>$MemGroupRows["Group_StartDate"],
                    "Group_Deadline"=>$MemGroupRows["Group_Deadline"],
                    "Group_Pic"=>$MemGroupRows["Group_Pic"],
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
                    "Blog_Name"=>$MemBlogRows["Blog_Name"],
                    "mem_name"=>$MemBlogRows["mem_name"],
                    "Blog_Date"=>$MemBlogRows["Blog_Date"],
                    "Blog_PicURL"=>$MemBlogRows["Blog_PicURL"],
                    "Blog_Views"=>$MemBlogRows["Blog_Views"],
            
                );	
            }            
        }
        //所有資料串接
        array_push($AllKeepPackage,$MemBlogInfo);
        //送出景點資料  
        echo json_encode($AllKeepPackage,JSON_UNESCAPED_UNICODE);
    }catch(PDOException $e){
        echo $e->getMessage();
    }




?>