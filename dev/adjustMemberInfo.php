<?php
    session_start();
    try{
        require_once("connectMemberTable.php");
        $AccContent = $_POST["memLeftAdjustAccContent"];
        $PswContent = $_POST["memLeftAdjustPswContent"];
        $BirContent = $_POST["memLeftAdjustBirContent"];
        $EmaContent = $_POST["memLeftAdjustEmaContent"];
        $TelContent = $_POST["memLeftAdjustTelContent"];
        $PicContent = 'images/memberphoto/'.$_FILES["chooseFile"]["name"];

        if(isset($_FILES["chooseFile"])){
        switch($_FILES["chooseFile"]["error"]){
            case 0:
                $dir = "images/memberphoto";
                if(file_exists($dir) === false){
                    mkdir($dir);
                }
                $from = $_FILES["chooseFile"]["tmp_name"]; //暫存區的路徑
                $to = "$dir/{$_FILES["chooseFile"]["name"]}"; //用原始檔名稱當做資料儲存的來源會有名稱重複的問題，當相同檔案名稱被重複上傳，後者會覆蓋前者
                copy($from, $to);	
                break;
            case 1:
                echo "上傳失敗, 上傳的檔案太大, 不得超過" , ini_get("upload_max_filesize"), "<br>";
                break;
            case 2:
                echo "上傳失敗, 上傳的檔案太大, 不得超過", $_POST["MAX_FILE_SIZE"], "<br>";
                break;
            case 3:
                echo "上傳失敗, 上傳的檔案不完整<br>";
                break;
            case 4:
                echo "檔案未選<br>";
                break;
            default:
                echo "system upload error : ", $_FILES["upFile"]["error"], "<br>";
        }
        }else{
            echo "<script>console.log('不存在');</script>";
        }

        $sql = "update MemberTable set Mem_Psw='$PswContent',Mem_Birth='$BirContent',Mem_Email='$EmaContent',
        Mem_Tel='$TelContent', Mem_Photo='$PicContent' where Mem_Id='$AccContent'";
        $pdo->exec($sql);

        unset($_SESSION["Mem_NO"]);
        unset($_SESSION["Mem_Name"]);
        unset($_SESSION["Mem_Id"]);
        unset($_SESSION["Mem_Psw"]);
        unset($_SESSION["Mem_Email"]);
        unset($_SESSION["Mem_Status"]);
        unset($_SESSION["Mem_LikeSum"]);
        unset($_SESSION["Mem_LikeAmount"]);
        unset($_SESSION["Mem_Tel"]);
        unset($_SESSION["Mem_Sex"]);
        unset($_SESSION["Mem_Birth"]);
        unset($_SESSION["Mem_Photo"]);
        echo "<script>alert('儲存成功，請重新登入');location.href='main.html';</script>";
     
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>