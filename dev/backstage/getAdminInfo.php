<?php 
session_start();
if( isset($_SESSION["Adm_NO"])){ //已登入
    //送出管理員的姓名資料
    $admonInfo = array("Adm_NO"=>$_SESSION["Adm_NO"],"Adm_Name"=>$_SESSION["Adm_Name"],"Adm_Acc"=>$_SESSION["Adm_Acc"], "Adm_Psw"=>$_SESSION["Adm_Psw"]);
    echo json_encode($admonInfo);
}else{ //未登入
    echo "{}";
    // echo '<script>location="CMS_login.html"</script>';
    // exit();
}

?>