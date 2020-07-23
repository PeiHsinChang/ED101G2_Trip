<?php
    session_start();

    try{
        require_once("connectMemberTable.php");
        $r_memName = $_POST["r_memName"];
        $r_memId = $_POST["r_memId"];
        $r_memPsw = $_POST["r_memPsw"];
        $r_memPsw2 = $_POST["r_memPsw2"];
        $r_memSex = $_POST["r_memSex"];
        $r_memEmail = $_POST["r_memEmail"];
        $r_memTel = $_POST["r_memTel"];
        $r_memBirth = $_POST["r_memBirth"];

        $sql = "select * from `MemberTable` where Mem_Id=:r_memId;";
        $member1 = $pdo->prepare($sql);
        $member1->bindValue(":r_memId", $_POST["r_memId"]);
        $member1->execute();


        //檢查註冊的帳號是否已存在
        if($member1->rowCount()==0){
            if($r_memName != null && $r_memId != null && $r_memPsw != null && $r_memPsw == $r_memPsw2 && (mb_strlen($r_memId)>=6) && (mb_strlen($r_memPsw)>=8)){
                //新增資料進資料庫語法
                $sql = "insert into MemberTable(Mem_Name, Mem_Id, Mem_Psw, Mem_Email, 
                Mem_Status, Mem_LikeSum, Mem_LikeAmount, Mem_Tel, Mem_Sex, Mem_Birth, Mem_Photo) values ('$r_memName',
                '$r_memId', '$r_memPsw', '$r_memEmail', 1, 0, 0, '$r_memTel', $r_memSex, '$r_memBirth', 'images/memberphoto/fakeHead.png')";
                $addmembersql = $pdo->exec($sql);
                echo "<script>alert('註冊成功');location.href='main.html';</script>";


                $sql2 = "select * from `MemberTable` where Mem_Id=:r_memId;";
                $member2 = $pdo->prepare($sql2);
                $member2->bindValue(":r_memId", $_POST["r_memId"]);
                $member2->execute();
                //自資料庫中取回資料
                $memRow = $member2->fetch(PDO::FETCH_ASSOC);
                
                //將註冊者的資訊寫入SESSION
                $_SESSION["Mem_NO"] = $memRow["Mem_NO"];
                $_SESSION["Mem_Name"] = $memRow["Mem_Name"];
                $_SESSION["Mem_Id"] = $memRow["Mem_Id"];
                $_SESSION["Mem_Psw"] = $memRow["Mem_Psw"];
                $_SESSION["Mem_Email"] = $memRow["Mem_Email"];
                $_SESSION["Mem_Status"] = $memRow["Mem_Status"];
                $_SESSION["Mem_LikeSum"] = $memRow["Mem_LikeSum"];
                $_SESSION["Mem_LikeAmount"] = $memRow["Mem_LikeAmount"];
                $_SESSION["Mem_Tel"] = $memRow["Mem_Tel"];
                $_SESSION["Mem_Sex"] = $memRow["Mem_Sex"];
                $_SESSION["Mem_Birth"] = $memRow["Mem_Birth"];
                $_SESSION["Mem_Photo"] = $memRow["Mem_Photo"];

                //送出註冊者的姓名資料
                $memberInfo = array("Mem_NO"=>$_SESSION["Mem_NO"],"Mem_Name"=>$_SESSION["Mem_Name"], 
                "Mem_Id"=>$_SESSION["Mem_Id"], "Mem_Psw"=>$_SESSION["Mem_Psw"], "Mem_Email"=>$_SESSION["Mem_Email"], 
                "Mem_Status"=>$_SESSION["Mem_Status"], "Mem_LikeSum"=>$_SESSION["Mem_LikeSum"], 
                "Mem_LikeAmount"=>$_SESSION["Mem_LikeAmount"], "Mem_Tel"=>$_SESSION["Mem_Tel"], "Mem_Sex"=>$_SESSION["Mem_Sex"], 
                "Mem_Birth"=>$_SESSION["Mem_Birth"], "Mem_Photo"=>$_SESSION["Mem_Photo"]);
                echo json_encode($memberInfo);
            }else{
                echo "<script>alert('註冊失敗，請重新註冊');location.href='main.html';</script>";
            }
        }else{
            echo "<script>alert('帳號已經有人使用囉！');location.href='main.html';</script>";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>
