<?php 
session_start();
if( isset($_SESSION["Mem_Id"])){ //已登入
    $memberInfo = array("Mem_NO"=>$_SESSION["Mem_NO"],"Mem_Name"=>$_SESSION["Mem_Name"], 
    "Mem_Id"=>$_SESSION["Mem_Id"], "Mem_Psw"=>$_SESSION["Mem_Psw"], "Mem_Email"=>$_SESSION["Mem_Email"], 
    "Mem_Status"=>$_SESSION["Mem_Status"], "Mem_LikeSum"=>$_SESSION["Mem_LikeSum"], 
    "Mem_LikeAmount"=>$_SESSION["Mem_LikeAmount"], "Mem_Tel"=>$_SESSION["Mem_Tel"], "Mem_Sex"=>$_SESSION["Mem_Sex"], 
    "Mem_Birth"=>$_SESSION["Mem_Birth"], "Mem_Photo"=>$_SESSION["Mem_Photo"]);

    echo json_encode($memberInfo);
}else{ //未登入
	echo "{}";
}
?>