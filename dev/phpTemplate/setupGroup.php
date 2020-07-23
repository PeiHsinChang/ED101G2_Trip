<?php
    try{
        $mem_NO = $_SESSION["Mem_NO"];
        require_once("connectMemberTable.php");
        $sql = "select * from `GroupTable` where Mem_NO=:mem_NO and Group_Status=3 order by Group_NO;";
        $groups = $pdo->prepare($sql);
        $groups->bindParam(":mem_NO", $mem_NO);
        $groups->execute();
        if($groups->rowCount()==0){
            $rtn = array();
            echo json_encode($rtn);
        }else{
            $results = $groups->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($results,JSON_UNESCAPED_UNICODE);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>

<form class="setupform"  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<!-- <form class="setupform"  action="saveGroup.php" method="post" enctype="multipart/form-data"> -->
    <div class="startgroupall">
        <div class="startgroupa">
            <div class="startgtitle">開始揪團</div>
        </div>    
        <div class="startgroupcont">           
            <div class="startgroupn">選擇一個行程：
                <select name="shedulename" id="grouplistSelect" class="schedulename">
                    <option value="1" class="set1"selected>行程一</option>
                    <option value="2" class="set2">行程二</option>
                    <option value="3" class="set3"> 行程三</option>
                </select>
            </div>
            <div class="groupno">還沒有行程？&nbsp;&nbsp;&nbsp;
                <a href="./plan.html" class="gotosetup">去排行程</a>
            </div>
            請選擇一張美麗的封面照片
            <label for="fileupload" class="custom-file-upload">選擇照片</label>
            <input id="fileupload" name="fileupload" type="file"/></br>
            <img id="myImg" src="images/groupphoto/山1.jpg" alt="your image" style="width:250px;height:150px" />
            <div class="selectreq">設定參團條件</div>
            <div class="selectreqst">
                <div class="reqpartend">報名期限：
                    <input id="partdate" name="Group_Deadline" type="date" style="width: 125px;height: 20px; font-size:14px;">
                </div>
                <div class="reqpartdep">出發日期：
                    <input id="startdate" name="Group_StartDate" type="date" style="width: 125px;height: 20px; font-size:14px;">
                </div>
                <div class="reqpartend">結束日期：
                    <input id="enddate" name="Group_EndDate" type="date" style="width: 125px;height: 20px; font-size:14px;">
                </div>
                <div class="reqpartname">團體名稱：
                    <input type="text" id="partname" name="Group_title" style="font-size:14px;height: 20px; width: 125px">
                </div>
                <div class="reqpartlimit">參團人數：
                    <input type="text" id="partlimit" name="Group_Ppl" style="font-size:14px;height: 20px; width: 125px">
                </div>
            </div>
            <div class="selectreq2">
                <div class="genderlimit">性別限制：
                    <select id = "gendercho" name="Group_Sex" style="font-size:14px; width: 125px;height: 20px" class="gendselect">
                        <option value="0" class="gendm">男</option>
                        <option value="1" class="gendf"selected>女</option>
                        <option value="2" class="gendnone">不限</option>
                    </select>
                </div>
                <div class="yearlimit">年紀限制：
                    <input type="text" id="yearlimitcho" name="Group_Age" style="font-size:14px;height: 20px; width: 125px" class="yearinput">
                </div>
                <div class="estimatecost">預估費用：
                    <input type="text" id="estmoney" name="Group_Fee" style="font-size:14px;height: 20px; width: 125px" class="inputmoney">
                </div>
                <div class="estimatecost">集合地點：
                    <input type="text" id="gatherplace" name="Group_Place" style="font-size:14px;height: 20px; width: 125px" class="inputmoney">
                </div>
            </div>
            <div class="selectreq3">
                <div class="noticetext" style="clear:both">備註：</div>
                <div class="noticetexta"><textarea id="memogroup" name="Group_Com" class="noticetxthere"style="font-size:14px;"></textarea></div>
                <div class="threestatus">
                    <input type="submit" name="submitButton" id ="setgroupSubmit" class="btnSmall" value="發佈" />
                    <!-- <button id ="setgroupSave"class="setgroupsave">儲存</button> -->
                    <input type="button" onclick="closeNewGroup();" class="btnSmall" value="取消" />
                    <!-- <button onclick="closeNewGroup();" class="setgroupcancel">取消</button> -->
                </div>
            </div>
        </div>
    </div>
 </form>

<?php
try {
    require_once("connectMemberTable.php");
    // session_start();
    $mem_NO = $_SESSION["Mem_NO"];
    if(isset($_POST['submitButton'])){
        if($_SESSION["Mem_NO"]){
            $PicGroupContent = 'images/groupphoto/'.$_FILES["fileupload"]["name"];
            if(isset($_FILES["fileupload"])){
                switch($_FILES["fileupload"]["error"]){
                    case 0:
                        $dir = "images/groupphoto"; //指定一個資料夾路徑存放檔案
                        if(file_exists($dir) === false){ //檢察資料夾是否已存在，若否，則建立一個
                            mkdir($dir);
                        }
                        $from = $_FILES["fileupload"]["tmp_name"]; //暫存區的路徑
                        $to = "$dir/{$_FILES["fileupload"]["name"]}"; //用原始檔名稱當做資料儲存的來源會有名稱重複的問題，當相同檔案名稱被重複上傳，後者會覆蓋前者
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
            $sql_group = 
                "Insert into grouptable 
                (Mem_NO, Sche_NO, Group_title, Group_StartDate, 
                Group_EndDate, Group_Deadline,Group_Ppl, Group_Sex, 
                Group_Age, Group_Fee, Group_Place, Group_Pic, 
                Group_Status, Group_Com)
                VALUES 
                (:group_1,  :group_2, :group_3, 
                :group_4,  :group_5,  :group_6, 
                :group_7,  :group_8,  :group_9, 
                :group_10, :group_11, :group_12, 
                :group_13, :group_14)";
            $setupGroup = $pdo->prepare($sql_group);
            $setupGroup->bindValue(":group_1", $mem_NO);
            $setupGroup->bindValue(":group_2", $_POST["shedulename"]);
            $setupGroup->bindValue(":group_3", $_POST["Group_title"]);
            $setupGroup->bindValue(":group_4", $_POST["Group_StartDate"]);
            $setupGroup->bindValue(":group_5", $_POST["Group_EndDate"]);
            $setupGroup->bindValue(":group_6", $_POST["Group_Deadline"]);
            $setupGroup->bindValue(":group_7", $_POST["Group_Ppl"]);
            $setupGroup->bindValue(":group_8", $_POST["Group_Sex"]);
            $setupGroup->bindValue(":group_9", $_POST["Group_Age"]);
            $setupGroup->bindValue(":group_10", $_POST["Group_Fee"]);
            $setupGroup->bindValue(":group_11", $_POST["Group_Place"]);
            $setupGroup->bindValue(":group_12", $PicGroupContent);
            $setupGroup->bindValue(":group_13", 1);
            $setupGroup->bindValue(":group_14", $_POST["Group_Com"]);
            $setupGroup->execute();

            $sql_getgroupno = 
            "Select Group_NO from grouptable g
            where Mem_NO=:Mem_NO
            order by group_no desc limit 1";
            $setupGroupNO = $pdo->prepare($sql_getgroupno);
            $setupGroupNO->bindValue(":Mem_NO", $mem_NO);
            $setupGroupNO->execute();
            $setupGroupNORow=$setupGroupNO->fetch(PDO::FETCH_ASSOC);
           

            $sql_groupHost = 
                "Insert into Mem_Par 
                (Mem_NO, Group_NO, Mem_Par_Status)
                VALUES (:groupHost1, :groupHost2, :groupHost3);";
            $setupGroupHost = $pdo->prepare($sql_groupHost);
            $setupGroupHost->bindValue(":groupHost1", $mem_NO);
            $setupGroupHost->bindValue(":groupHost2", $setupGroupNORow["Group_NO"]);
            $setupGroupHost->bindValue(":groupHost3", 1);
            $setupGroupHost->execute();


            echo "<script>alert('開團成功！');location.href='groupView.html'</script>";
    
        }else{
            echo "<script>alert('請先登入再開團！');location.href='groupView.html'</script>";
        }       
     }

} catch (PDOException $e) {
	// echo "系統暫時無法提供服務, 請通知系統維護人員<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}








?>

<script>
/*
function setupGroupFt(){
     y=document.getElementById("grouplistSelect").value
    let groupInfo = {
        sche_NO: document.getElementById("grouplistSelect").value,
        sche_Name: document.getElementById("grouplistSelect").options.namedItem(y).text,
        
        GroupDeadline: document.getElementById("partdate").value,
        Group_StartDate: document.getElementById("startdate").value,
        Group_EndDate: document.getElementById("enddate").value,
        Group_Title: document.getElementById("partname").value,
        Group_Ppl: document.getElementById("partlimit").value,
        Group_Sex: document.getElementById("gendercho").value,
        Group_Age: document.getElementById("yearlimitcho").value,
        Group_Fee: document.getElementById("estmoney").value,
        Group_Place: document.getElementById("gatherplace").value,
        Group_Com: document.getElementById("memogroup").value,
    }
    console.log(groupInfo);
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        if(xhr.status==200){
        alert(xhr.responseText);
      }else{
        alert(xhr.status);
      }
        //設定好所要連結的程式
        let url = "saveGroup.php";
        xhr.open("Post", url, true);
        //送出資料
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        groupInfo = JSON.stringify(groupInfo);
        let data_info = `groupInfo=${groupInfo}` ;
        console.log(data_info);
        xhr.send(data_info);
    }
    var file = document.getElementById('file-upload').files[0];
    console.log(file);
    xhrPhoto = new XMLHttpRequest();
    file_str = `file=${JSON.stringify(file)}`;

    xhrPhoto.open('POST', 'saveGroup.php');
    xhrPhoto.setRequestHeader('Content-Type', file.type);
    console.log(file.type);
    xhrPhoto.send(file_str);
  }



window.addEventListener("load", function(){
  document.getElementById("setgroupSubmit").addEventListener("click", setupGroupFt, false);
}, false) 
*/
 </script>
