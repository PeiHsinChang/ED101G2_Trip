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

<form class="setupform" >
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
            <label for="file-upload" class="custom-file-upload">選擇照片</label>
            <input id="file-upload" type="file"/></br>
            <img id="myImg" src="#" alt="your image" style="width:420px;height:250px" />
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
                    <button id ="setgroupSubmit" class="setgroupadd">發佈</button>
                    <!-- <button id ="setgroupSave"class="setgroupsave">儲存</button> -->
                    <button onclick="closeNewGroup();" class="setgroupcancel">取消</button>
                </div>
            </div>
        </div>
    </div>
 </form>

 <script>
function setupGroupFt(){
    let groupInfo = {
        scheName: document.getElementById("grouplistSelect").value,
    }
    console.log(groupInfo);
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        if(xhr.status==200){
        // document.getElementById("idMsg").innerText=xhr.responseText;
      }else{
        alert(xhr.status);
      }
  }

  //設定好所要連結的程式
  let url = "saveGroup.php";
  xhr.open("Post", url, true);
  //送出資料
  xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
  let data_info = "memId=" ;
  console.log(data_info);
  xhr.send(data_info);
}//function_checkId



window.addEventListener("load", function(){
  document.getElementById("setgroupSubmit").addEventListener("click", setupGroupFt, false);
}, false) 
 </script>