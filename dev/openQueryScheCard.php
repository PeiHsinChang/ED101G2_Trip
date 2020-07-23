<?php
  
    session_start();
    $memInfo = $_SESSION["Mem_NO"];
    // echo $_POST['keepScheInfo'];
    $keepScheInfo = json_decode($_POST['keepScheInfo']);

    
    try{
        require_once("connectMemberTable.php");        
        //收藏行程SQL指令        
        $sql_keepOneSche1 = "select * 
          from attrac_sche ats, attraction a, sche s
          where a.attrac_no=ats.attrac_no
          and ats.sche_no=s.sche_no
          and s.Sche_Name =:scheName
          order by ats.attrac_sche_no;";
         
        $keepOneSche1 = $pdo-> prepare($sql_keepOneSche1);
        // $keepOneSche1 -> bindValue(":memId", $memInfo);
        $keepOneSche1 -> bindValue(":scheName",$keepScheInfo->Sche_Id);
        $keepOneSche1 -> execute();
        $keepOneScheTnP = $keepOneSche1->fetchAll(PDO::FETCH_ASSOC); 
        print_r($keepOneScheTnP);
        die;
    
        //送出景點資料  
        echo json_encode($keepOneScheTnP);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>