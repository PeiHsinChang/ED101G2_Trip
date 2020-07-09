<?php
    try{
      require_once("connect.php"); 
      $r_Adm_Name = $_POST["r_Adm_Name"];
      $r_Adm_Acc = $_POST["r_Adm_Acc"];
      $r_Adm_Psw = $_POST["r_Adm_Psw"];
      $r_Adm_Email = $_POST["r_Adm_Email"];

      $sql = "select* from `AdminTable` where Adm_Acc=:r_Adm_Acc;";
      $addAdmon = $pdo->prepare($sql);
      $addAdmon->bindValue(":r_Adm_Acc", $_POST["r_Adm_Acc"]);
      $addAdmon->execute();

      //檢查註冊的帳號是否已存在
      if($addAdmon->rowCount()==0){
        if($r_Adm_Name != null && $r_Adm_Name != null && $r_Adm_Psw != null && $r_Adm_Email != null){
          //新增資料進資料庫語法
          $sql = "insert into AdminTable(Adm_Acc,Adm_Psw,Adm_Email,Adm_Name,Adm_Status) values ('$r_Adm_Acc','$r_Adm_Psw','$r_Adm_Email','$r_Adm_Name',1)";
          $addAdmonsql = $pdo->exec($sql);
          echo "<script>alert('新增成功');location.href='CMS_accManagement.html';</script>";
        }else{
            echo "<script>alert('新增失敗，欄位不可為空');location.href='CMS_accManagement.html';</script>";
        }
      }else{
        echo "<script>alert('此帳號已經有人使用囉！');location.href='CMS_accManagement.html';</script>";
      }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>