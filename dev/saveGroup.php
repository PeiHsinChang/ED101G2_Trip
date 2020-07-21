<?php
session_start();
$groupInfo = json_decode($_POST["groupInfo"],true);
// echo $groupInfo["sche_NO"];
$PicGroupContent = 'images/groupphoto/'.$_FILES["file-upload"]["name"];

echo $PicGroupContent;
die;
if(isset($_FILES["file-upload"])){
switch($_FILES["file-upload"]["error"]){
    case 0:
        $dir = "images/groupphoto"; //指定一個資料夾路徑存放檔案
        if(file_exists($dir) === false){ //檢察資料夾是否已存在，若否，則建立一個
            mkdir($dir);
        }
        $from = $_FILES["file-upload"]["tmp_name"]; //暫存區的路徑
        $to = "$dir/{$_FILES["file-upload"]["name"]}"; //用原始檔名稱當做資料儲存的來源會有名稱重複的問題，當相同檔案名稱被重複上傳，後者會覆蓋前者
        copy($from, $to); //將暫存區檔案抓到資料夾
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
try {
    require_once("connectMemberTable.php");
    $sql_g = 
        "Insert into grouptable (Mem_NO, Sche_NO, Group_title, Group_StartDate, Group_EndDate,
        Group_Deadline,Group_Ppl, Group_Sex, Group_Age, Group_Fee, Group_Place, Group_Pic, 
        Group_Status, Group_Com)
        VALUES 
        (1, 2, '南投好好玩之二日遊', '2020-09-05', '2020-09-06', 
        '2020-07-31', 8, '', '', 6000, '台北火車站', 
        'https://guide.easytravel.com.tw/images/city/nantou.jpg', 1, '記得帶泳衣哦')";
	$groupShow = $pdo->prepare($sql_g);
    $groupShow->bindValue(":Group_NO", $_POST["Group_NO"]);
    $groupShow->bindValue(":Group_NO", $_POST["sche_NO"]);
    $groupShow->bindValue(":Group_NO", $_POST["Group_NO"]);
    $groupShow->bindValue(":Group_NO", $_POST["Group_NO"]);
    $groupShow->bindValue(":Group_NO", $_POST["Group_NO"]);
    $groupShow->bindValue(":Group_NO", $_POST["Group_NO"]);
    $groupShow->bindValue(":Group_NO", $_POST["Group_NO"]);
    $groupShow->bindValue(":Group_NO", $_POST["Group_NO"]);

    $groupShow->execute();
    $groupShowInfo = $groupShow->fetch(PDO::FETCH_ASSOC);
    //echo $groupShowInfo["Mem_NO"]==$_SESSION["Mem_NO"]?'是團主':'不是團主';
} catch (PDOException $e) {
	// echo "系統暫時無法提供服務, 請通知系統維護人員<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}






// $target_dir = $_SERVER['DOCUMENT_ROOT']."/images/groupPhoto/";
// $extension = pathinfo($_FILES['file-upload']['name'], PATHINFO_EXTENSION);
// $target_filename =  $_POST["formGroupno"].".".$extension;
// $target_file = $target_dir.basename($target_filename);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// $serverGroupsrc = './images/groupPhoto/';
// $reupload = true;
// if (strpos($_POST["imgpath"],$serverGroupsrc) !==false) {
//     //no need upload pic again
//     $reupload  = false;
// }
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["file-upload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }

// Check if file already exists
// if (file_exists($target_file)) {
//     if (!unlink($target_file)) {
//         $uploadOk = 0;
//         echo "Sorry, file already exists. cant delete";
//     } else {
//         $uploadOk = 1;
//     }
// }

// // Check file size
// if ($_FILES["file-upload"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//     && $imageFileType != "gif" && $reupload==true) {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if ($reupload==false||move_uploaded_file($_FILES["file-upload"]["tmp_name"], $target_file)) {
//         try{
//             $mem_NO = $_SESSION["Mem_NO"];
//             require_once("connectMemberTable.php");
//             $sql = "select count(*) from GroupTable WHERE Group_NO =:Group_NO and Mem_NO=:Mem_NO";
//             $count = $pdo->prepare($sql);
//             $count->bindParam(":Mem_NO",$mem_NO );
//             $count->bindParam(":Group_NO",$_POST["Group_NO"] );
//             $count  = $count->execute();
//             if (!$count==1){
//                 throw new Exception('cant find group.');
//             }
//             $filepath = "./images/groupPhoto/".$target_filename;
//             $sql = "UPDATE GroupTable SET Group_title=:Group_title,Group_StartDate=:Group_StartDate,Group_EndDate=:Group_EndDate,".
//                 "Group_Deadline=:Group_Deadline,Group_Ppl=:Group_Ppl,Group_Sex=:Group_Sex,Group_Age=:Group_Age,Group_Fee=:Group_Fee,Group_Place=:Group_Place,Group_Pic=:Group_Pic,Group_Com=:Group_Com ".
//                 "WHERE Group_NO =:Group_NO and Mem_NO=:Mem_NO";
//             $groups = $pdo->prepare($sql);
//             $groups->bindParam(":Group_title", $_POST["Group_title"]);
//             $groups->bindParam(":Group_StartDate", $_POST["Group_StartDate"]);
//             $groups->bindParam(":Group_EndDate", $_POST["Group_EndDate"]);
//             $groups->bindParam(":Group_Deadline", $_POST["Group_Deadline"]);
//             $groups->bindParam(":Group_Ppl", $_POST["Group_Ppl"]);
//             $groups->bindParam(":Group_Sex", $_POST["Group_Sex"]);
//             $groups->bindParam(":Group_Age", $_POST["Group_Age"]);
//             $groups->bindParam(":Group_Fee", $_POST["Group_Fee"]);
//             $groups->bindParam(":Group_Place", $_POST["Group_Place"]);
//             if ($reupload==false){
//                 $groups->bindParam(":Group_Pic",$_POST["imgpath"] );
//             }else{
//                 $groups->bindParam(":Group_Pic",$filepath );
//             }
//             $groups->bindParam(":Group_NO",$_POST["Group_NO"] );
//             $groups->bindParam(":Mem_NO",$mem_NO );
//             $groups->bindParam(":Group_Com",$_POST["Group_Com"] );
//             $status  = $groups->execute();
//             echo "儲存成功";
//         }catch(PDOException $e){
//             echo $e->getMessage();
//         }
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }


?>