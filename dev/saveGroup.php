<?php
session_start();
$target_dir = $_SERVER['DOCUMENT_ROOT']."/images/groupPhoto/";
$extension = pathinfo($_FILES['file-upload']['name'], PATHINFO_EXTENSION);
$target_filename =  $_POST["formGroupno"].".".$extension;
$target_file = $target_dir.basename($target_filename);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$serverGroupsrc = './images/groupPhoto/';
$reupload = true;
if (strpos($_POST["imgpath"],$serverGroupsrc) !==false) {
    //no need upload pic again
    $reupload  = false;
}
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file-upload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    if (!unlink($target_file)) {
        $uploadOk = 0;
        echo "Sorry, file already exists. cant delete";
    } else {
        $uploadOk = 1;
    }
}

// Check file size
if ($_FILES["file-upload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $reupload==true) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if ($reupload==false||move_uploaded_file($_FILES["file-upload"]["tmp_name"], $target_file)) {
        try{
            $mem_NO = $_SESSION["Mem_NO"];
            require_once("connectMemberTable.php");
            $sql = "select count(*) from GroupTable WHERE Group_NO =:Group_NO and Mem_NO=:Mem_NO";
            $count = $pdo->prepare($sql);
            $count->bindParam(":Mem_NO",$mem_NO );
            $count->bindParam(":Group_NO",$_POST["Group_NO"] );
            $count  = $count->execute();
            if (!$count==1){
                throw new Exception('cant find group.');
            }
            $filepath = "./images/groupPhoto/".$target_filename;
            $sql = "UPDATE GroupTable SET Group_title=:Group_title,Group_StartDate=:Group_StartDate,Group_EndDate=:Group_EndDate,".
                "Group_Deadline=:Group_Deadline,Group_Ppl=:Group_Ppl,Group_Sex=:Group_Sex,Group_Age=:Group_Age,Group_Fee=:Group_Fee,Group_Place=:Group_Place,Group_Pic=:Group_Pic,Group_Com=:Group_Com ".
                "WHERE Group_NO =:Group_NO and Mem_NO=:Mem_NO";
            $groups = $pdo->prepare($sql);
            $groups->bindParam(":Group_title", $_POST["Group_title"]);
            $groups->bindParam(":Group_StartDate", $_POST["Group_StartDate"]);
            $groups->bindParam(":Group_EndDate", $_POST["Group_EndDate"]);
            $groups->bindParam(":Group_Deadline", $_POST["Group_Deadline"]);
            $groups->bindParam(":Group_Ppl", $_POST["Group_Ppl"]);
            $groups->bindParam(":Group_Sex", $_POST["Group_Sex"]);
            $groups->bindParam(":Group_Age", $_POST["Group_Age"]);
            $groups->bindParam(":Group_Fee", $_POST["Group_Fee"]);
            $groups->bindParam(":Group_Place", $_POST["Group_Place"]);
            if ($reupload==false){
                $groups->bindParam(":Group_Pic",$_POST["imgpath"] );
            }else{
                $groups->bindParam(":Group_Pic",$filepath );
            }
            $groups->bindParam(":Group_NO",$_POST["Group_NO"] );
            $groups->bindParam(":Mem_NO",$mem_NO );
            $groups->bindParam(":Group_Com",$_POST["Group_Com"] );
            $status  = $groups->execute();
            echo "儲存成功";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>