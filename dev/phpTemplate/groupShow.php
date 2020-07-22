<?php   
    try {
        require_once("connectMemberTable.php");
        $mem_NO = $_SESSION["Mem_NO"];

        $sql_g = 
            "select * 
            from grouptable g,membertable m
            where g.mem_no = m.mem_no
            and g.Group_NO =:Group_NO;";

        $groupShow = $pdo->prepare($sql_g);
        $groupShow->bindValue(":Group_NO", $_GET["Group_NO"]);
        $groupShow->execute();
        $groupShowInfo = $groupShow->fetch(PDO::FETCH_ASSOC);

        //取得已入團團員
        $sql = "select MemberTable.Mem_Name, MemberTable.Mem_Photo, MemberTable.Mem_Email, MemberTable.Mem_Tel, MemberTable.Mem_Sex, MemberTable.Mem_Birth from MemberTable join Mem_Par on MemberTable.Mem_NO=Mem_Par.Mem_NO where Mem_Par.Mem_Par_Status=1 and Mem_Par.Group_NO=:Group_NO";
        $joined = $pdo->prepare($sql);
        $joined->bindValue(":Group_NO", $_GET["Group_NO"]);
        $joined->execute();
        //取得待審核團員
        $sql2 = "select MemberTable.Mem_NO, MemberTable.Mem_Name, MemberTable.Mem_Photo, MemberTable.Mem_Email, MemberTable.Mem_Tel, MemberTable.Mem_Sex, MemberTable.Mem_Birth from MemberTable join Mem_Par on MemberTable.Mem_NO=Mem_Par.Mem_NO where Mem_Par.Mem_Par_Status=0 and Mem_Par.Group_NO=:Group_NO";
        $goingToJpin = $pdo->prepare($sql2);
        $goingToJpin->bindValue(":Group_NO", $_GET["Group_NO"]);
        $goingToJpin->execute();

        //取得報名揪團狀態
        $sql3 = "select * from Mem_Par where Mem_NO=:memNo and Group_NO=:groupNo order by Par_NO desc";
        $signUpStatus = $pdo->prepare($sql3);
        $signUpStatus->bindValue(":memNo", $_SESSION["Mem_NO"]);
        $signUpStatus->bindValue(":groupNo", $_GET["Group_NO"]);
        $signUpStatus->execute();
        $signUpStatusResult = $signUpStatus->fetch(PDO::FETCH_ASSOC);

        //取得收藏揪團狀態
        $sql4 = "select * from Keep_Group where Mem_NO=:memNo and Group_NO=:groupNo";
        $keepGroupStatus = $pdo->prepare($sql4);
        $keepGroupStatus->bindValue(":memNo", $_SESSION["Mem_NO"]);
        $keepGroupStatus->bindValue(":groupNo", $_GET["Group_NO"]);
        $keepGroupStatus->execute();
        $keepGroupStatusResult = $keepGroupStatus->fetch(PDO::FETCH_ASSOC);

        
    } catch (PDOException $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
    }
?>

<!-- 上半部 -->
<div class="containerGroupTop">
    <div class="containerGroupTitle"><?php echo $groupShowInfo["Group_title"];?></div>
    <div class="containerGroupPhoto"><img src="<?php echo $groupShowInfo["Group_Pic"];?>"></div>  
</div>

<div class="container">
    <div class="openNewGroup col-4 col-l-2 col-md-2 col-lg-2">
        <a  onclick="openNewGroup();">
            <img src="./images/openNewGroup.png" class="d-md-block" />
        </a>
    </div>
    <div class="tabAll">
        <div class="tab">
            <button class="tabs1" data-type="activity">活動說明</button>
            <button class="tabs2" data-type="chat">留言板</button>
        </div>
        <div id="activity" class="tabcontent" style="display:block;">
            <div class="actAll">
                <!-- 揪團說明 -->
                <aside class="actCont">
                    <h4>活動說明</h4>					
					<ul class="prodTable">
						<li><span>團&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名:</span> <?php echo $groupShowInfo["Group_title"];?></li>
						<li><span>出發日期:</span> <?php echo $groupShowInfo["Group_StartDate"];?></li>
						<li><span>結束日期:</span> <?php echo $groupShowInfo["Group_EndDate"];?></li>
                        <li><span>報名截止:</span> <?php echo $groupShowInfo["Group_Deadline"];?></li>
                        <li><span>集合地點:</span> <?php echo $groupShowInfo["Group_Place"];?></li>
                        <li><span>團員人數:</span> <?php echo $groupShowInfo["Group_Ppl"];?></li>
                        <li><span>預估費用:</span> <?php echo $groupShowInfo["Group_Fee"];?></li>
                        <li><span>限制性別:</span> <?php if($groupShowInfo["Group_Sex"]=='0'){echo '限男';}elseif($groupShowInfo["Group_Sex"]=='1'){echo '限女';}else{echo '不限';} ?></li>
                        <li><span>限制年齡:</span> <?php if($groupShowInfo["Group_Age"]==''){echo '不限';}else{echo $groupShowInfo["Group_Age"].'歲以下';}?></li>
                        <li><span>備&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;註:</span> <?php echo $groupShowInfo["Group_Com"];?></li>
                    </ul>
                </aside>

                <!-- 非團主按鈕 -->
                <aside class="btnsAct" id="btnsAct">
                    <button class="btnsActBtn1" id="btnsActBtn1">我要報名</button>
                    <button class="btnsActBtn1_1" id="btnsActBtn1_1">取消報名</button>
                    <button class="btnsActBtn1_2" id="btnsActBtn1_2">報名已被拒絕</button>
                    <button class="btnsActBtn2" id="btnsActBtn2">收藏此團</button>
                    <button class="btnsActBtn2_2" id="btnsActBtn2_2">取消收藏</button>
                </aside>
                
                <!-- 待審核區 -->
                <aside class="goingToJoin" id="goingToJoin">
                    <h5 class="goingToJoinH5">參團申請</h5>
                    <ul class="goingToJoinUl">
                    <?php
                        while($goingToJpinRow = $goingToJpin->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <li class="goingToJoinLi">
                            <div class="pic"><img class="memPic" src="<?=$goingToJpinRow["Mem_Photo"];?>"></div>
                            <div class="name"><?=$goingToJpinRow["Mem_Name"];?></div>                  
                            <button class="accept">接受</button>
                            <div class="memNo" style="display:none"><?=$goingToJpinRow["Mem_NO"];?></div>
                            <button class="refuse">拒絕</button>
                            <br><a class="showInfo">查看會員資料</a>
                            <div class="info">
                                <ul>
                                    <li>性別：<?php if($goingToJpinRow["Mem_Sex"]==0){echo "男";}else{echo "女";} ?></li>
                                    <li>聯絡信箱：<?=$goingToJpinRow["Mem_Email"];?></li>
                                    <li>聯絡電話：<?=$goingToJpinRow["Mem_Tel"];?></li>
                                    <li>出生日期：<?=$goingToJpinRow["Mem_Birth"];?></li>
                                    <li><button class="closeInfo">關閉</button></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                        }
                    ?>
                    </ul>
                </aside>
            </div>
            <hr>
            <!-- 已經加入團員區 -->
            <div class="joined">
                <h5 class="joinedH5">已加入團員</h5>
                <ul class="joinedUl">
                <?php
                    while($joinedRow = $joined->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <li class="joinedLi">
                        <div class="pic"><img class="memPic" src="<?=$joinedRow["Mem_Photo"];?>">
                        </div><div class="name"><?=$joinedRow["Mem_Name"];?></div>
                        <br><a class="showInfo">查看會員資料</a>
                        <div class="info">
                            <ul>
                                <li>性別：<?php if($joinedRow["Mem_Sex"]==0){echo "男";}else{echo "女";} ?></li>
                                <li>聯絡信箱：<?=$joinedRow["Mem_Email"];?></li>
                                <li>聯絡電話：<?=$joinedRow["Mem_Tel"];?></li>
                                <li>出生日期：<?=$joinedRow["Mem_Birth"];?></li>
                                <li><button class="closeInfo">關閉</button></li>
                            </ul>
                        </div>
                    </li>
                <?php
                    }
                ?>
                </ul>
            </div>
        </div>
         <div id="chat" class="tabcontent" style="display: none;">
            <h3>留言板</h3>
            <div class="chatCont" id="msgBook">
                <table>
                    <tr>
                        <td rowspan="3"><img class="commentor" src="./images/profile.jpg"></td>
                        <td>
                            <span>愛旅遊</span>
                            <time>2020/05/09 10:24</time>
                        </td>
                    </tr>
                    <tr>
                        <td class="replies"></td>
                    </tr>
                    <tr>
                        <td class="replies">答覆：約落在2萬～3萬左右！
                            <time>2020/05/09 10:24</time>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td rowspan="3"><img class="commentor" src="./images/profile.jpg"></td>
                        <td>
                            <span>愛旅遊</span>
                            <time>2020/05/09 10:24</time>
                        </td>
                    </tr>
                    <tr>
                        <td class="replies">請問團主，花費預算大概是多少呢？</td>
                    </tr>
                    <tr>
                        <td class="replies">答覆：約落在2萬～3萬左右！
                            <time>2020/05/09 10:24</time>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td rowspan="3"><img class="commentor" src="./images/profile.jpg"></td>
                        <td>
                            <span>愛旅遊</span>
                            <time>2020/05/09 10:24</time>
                        </td>
                    </tr>
                    <tr>
                        <td class="replies">請問團主，花費預算大概是多少呢？哈哈哈!</td>
                    </tr>
                    <tr>
                        <td class="replies">答覆：約落在2萬～3萬左右！
                            <time>2020/05/09 10:24</time>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td rowspan="3"><img class="commentor" src="./images/profile.jpg"></td>
                        <td>
                            <span>中央劉德華</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text"><input class="btnSend" type="submit" value="">
                        </td>
                    </tr>
                </table>

            </div>
             <div class ="chatCont" id="guestRepBlock"></div>
         </div>
    </div>

<script>
    $(function () {
        $('body').on('click', '.tabs[data-type]', function (e) {
            let $obj = $(this);
            let type = $obj.data('type');
            openCity(e, type);
        });
    });

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent ");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none ";
        }
        tabs = document.getElementsByClassName("tabs ");
        for (i = 0; i < tabs.length; i++) {
            tabs[i].className = tabs[i].className.replace(" active ", " ");
        }

        document.getElementById(cityName).style.display = "block ";
        evt.currentTarget.className += " active ";


        let memberNo = '<?php echo $_SESSION["Mem_NO"]; ?>';
        let isUsrLeader = false;
        if (memberNo == '<?php echo $groupShowInfo["Mem_NO"]?>') {
            isUsrLeader = true;
        }
        if (cityName=='chat'){
            let chatArray = [];
            $.ajax({
                type: "POST",
                data:{"groupNO":<?php echo $_GET["Group_NO"]?>},
                url: 'getChatList.php',
                success: function(response){
                    $('#grouplistSelect').html('');
                    $('#msgBook').html('');
                    if ($.parseJSON(response).length>0){
                        let chat = $.parseJSON(response);
                        chatArray = chat;
                        /*$.each(chatArray, function( index, value ) {
                            $('#grouplistSelect').append($("<option></option>").attr("value",schedules[index].Group_NO).text(schedules[index].Group_title));
                        });*/
                        //分出有幾個討論串
                        Array.prototype.groupBy = function(prop) {
                            return this.reduce(function(groups, item) {
                                const val = item[prop]
                                groups[val] = groups[val] || []
                                groups[val].push(item)
                                return groups
                            }, {})
                        };
                        const blockChat = chat.groupBy('Block_NO');
                        //分群
                        //取得key值
                        let keyArray = [];
                        for(var key in blockChat){
                            keyArray.push(key);
                        }
                        keyArray.sort((x,y) => x - y);
                        //取得key值排序
                        let memPhoto = "<?php echo $groupShowInfo["Mem_Photo"]?>";
                        let memidx = "<?php echo $groupShowInfo["Mem_Id"]?>";
                        console.log(keyArray);
                        for (i = 0;i<keyArray.length;i++){
                            let keyName =  keyArray[i];
                            console.log(blockChat[keyName]);
                            let block =  (blockChat[keyName])[0];
                            let tableid = block["Group_NO"]+'_'+block["main_mem"]+'_'+block["Block_NO"];
                            let memberNo = '<?php echo $_SESSION["Mem_NO"]; ?>';
                            let isUsrLeader = false;
                            if (memberNo == block["main_mem"]) {
                                isUsrLeader = true;
                            }
                            let msgBook = $('#msgBook');
                            let blockTable = $('<table>').prop('id',tableid);
                            let replied = false;
                            if((blockChat[keyName])[0]){
                                for (j=0;j<(blockChat[keyName]).length;j++){
                                    blockTable.append(
                                        $('<tr></tr>').append($('<td>').attr('rowspan',3).append($('<img onclick=\"myFunction(\''+tableid+'\')">').attr({'class':'commentor','src':((blockChat[keyName])[j]).Mem_Photo})))
                                            .append($('<td>').append($('<span>').html(((blockChat[keyName])[j]).Mem_Id)).append($('<time>').text(' '+((blockChat[keyName])[j]).Msg_Date))));
                                    blockTable.append($('<tr>').append($('<td>').attr('class','replies').html(((blockChat[keyName])[j]).Msg_Cont)));
                                    if (((blockChat[keyName])[j]).Msg_Re && ((blockChat[keyName])[j]).Msg_Re_Date){
                                        blockTable.append($('<tr>').append($('<td>').attr({class:'replies',id:tableid+'leaderReAppend'}).text('答覆： '+((blockChat[keyName])[j]).Msg_Re).append($('<time>').text(' '+((blockChat[keyName])[j]).Msg_Re_Date))));
                                        replied = true
                                    }
                                }
                                msgBook.append(blockTable);

                            }
                            let memPhoto = "<?php echo $groupShowInfo["Mem_Photo"]?>";
                            if (!replied && isUsrLeader){
                                //團主回覆用
                                let leaderTable = $('<table>').prop('id',tableid+'repliedTable');
                                leaderTable.append( $('<tr></tr>').append($('<td>').attr('rowspan',3).append($('<img>').attr({'class':'commentor','src':'<?php echo $groupShowInfo["Mem_Photo"]?>'})))
                                    .append($('<td>').append($('<span>').text(memidx))));
                                leaderTable.append($('<td>').append($('<input type="text" id="'+tableid+'inputMsg" '+'class="'+tableid+'"/><input class="btnSend '+tableid+'" onclick=submitRep("'+tableid+'") type="button" value="">')));
                                msgBook.append(leaderTable);

                            }

                        }
                    }
                    if (!isUsrLeader){
                        $('#guestRepBlock').html('');
                        let gusetTable = $('<table>').prop('id','guestTable');
                        gusetTable.append( $('<tr></tr>').append($('<td>').attr('rowspan',3).append($('<img>').attr({'class':'commentor','src':'<?php echo $_SESSION["Mem_Photo"]?>'})))
                            .append($('<td>').append($('<span>').text('<?php echo $_SESSION["Mem_Id"]?>'))));
                        gusetTable.append($('<td>').append($('<input type="text" id="guestInputx"/><input class="btnSend" onclick=guestSubmitRep() type="button" value="">')));
                        $('#guestRepBlock').append(gusetTable);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    }
    function submitRep(msgFrom) {
        let msg = $('#'+msgFrom+ 'inputMsg').val();
        let data = {};
        data["msg"] = msg;
        data["msgFrom"] = msgFrom;

        $.ajax({
            type: "POST",
            url: 'postMsg.php',
            data: {postData:data},
            success: function(response){
                alert(response);
                if (response=='新增留言成功'){
                    let deltableid = '#'+msgFrom+'repliedTable';
                    console.log(deltableid);
                    $(deltableid).remove();
                    let appendMainTable = '#'+ msgFrom;
                    let now = new Date();
                    let timenow = now.getFullYear() + "-" + (now.getMonth()+1) + "-" + now.getDate();
                    $(appendMainTable).append($('<tr>').append($('<td>').attr({class:'replies'}).text('答覆： '+msg).append($('<time>').text(' '+timenow))));
                }
            },
            error: function (xhr, ajaxOptions, thrownError){
                alert(xhr.status);
                alert(thrownError);
            }
        });
    };
    function guestSubmitRep() {
        let msgObj = {};
        let guestid = '<?php echo $_SESSION["Mem_NO"]; ?>';
        let groupno = '<?php echo $_GET["Group_NO"]?>';
        var guestMsgContent  = $('#guestInputx').val();
        msgObj.guestid = guestid;
        msgObj.groupno = groupno;
        msgObj.guestMsgContent = guestMsgContent;
        $.ajax({
            type: "POST",
            url: 'postGuestMsg.php',
            data: {msgObj:msgObj},
            success: function(response){
                alert(response);
                if (response=='新增留言成功'){
                    let now = new Date();
                    let timenow = now.getFullYear() + "-" + (now.getMonth()+1) + "-" + now.getDate();
                    let postByGuest = $('<table>');
                    postByGuest.append(
                        $('<tr></tr>').append($('<td>').attr('rowspan',3).append($('<img>').attr({'class':'commentor','src':'<?php echo $_SESSION["Mem_Photo"]?>'})))
                            .append($('<td>').append($('<span>').html('<?php echo $_SESSION["Mem_Id"]?>')).append($('<time>').text(' '+timenow))));
                    postByGuest.append($('<tr>').append($('<td>').attr('class','replies').html(guestMsgContent)));
                    $('#msgBook').append(postByGuest);
                    $('#guestInputx').val('');
                   /* let deltableid = '#'+msgFrom+'repliedTable';
                    console.log(deltableid);
                    $(deltableid).remove();
                    let appendMainTable = '#'+ msgFrom;
                    let now = new Date();
                    let timenow = now.getFullYear() + "-" + (now.getMonth()+1) + "-" + now.getDate();
                    $(appendMainTable).append($('<tr>').append($('<td>').attr({class:'replies'}).text('答覆： '+msg).append($('<time>').text(' '+timenow))));*/
                }
            },
            error: function (xhr, ajaxOptions, thrownError){
                alert(xhr.status);
                alert(thrownError);
            }
        });
    };

    function myFunction(formInfo) {
        var msg = prompt("請說明舉報原因");
        let msgObj = {};
        let guestid = '<?php echo $_SESSION["Mem_NO"]; ?>';
        let groupno = '<?php echo $_GET["Group_NO"]?>';
        let formdata = formInfo.toString().split('_');
        let block_no = formdata[2].toString();
        console.log(block_no);
        let reportmsg = msg;
        msgObj.guestid = guestid;
        msgObj.groupno = groupno;
        msgObj.block_no = block_no;
        msgObj.msg = reportmsg;
        if (msg == null || msg == "") {
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: 'reportMsg.php',
                data: {msgObj:msgObj},
                success: function(response){

                    if (response=='檢舉完成'){
                        alert(response);
                    }else{
                        alert('檢舉失敗');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
        document.getElementById("demo").innerHTML = txt;
    } 

    //loading之後判斷是否為團主，呈現不同畫面
    function checkGroupLeader(){
        let memberNo = '<?php echo $_SESSION["Mem_NO"];?>';
        if(memberNo == <?php echo $groupShowInfo["Mem_NO"];?>){
            document.getElementById('btnsAct').style.display = 'none';
            document.getElementById('goingToJoin').style.display = 'inline-block';
        }else{
            document.getElementById('btnsAct').style.display = 'inline-block';
            document.getElementById('goingToJoin').style.display = 'none';
        }
    }

    //loading之後判斷是否已經報名此團
    function checkSignUpStatus(){
        let status = "<?php echo $signUpStatusResult['Mem_Par_Status'];?>";
        if(status == 3 || status == ''){
            //取消報名或尚未報名
            $("#btnsActBtn1").css("display","inline-block");
            $("#btnsActBtn1_1").css("display","none");
        }else if(status == 2){
            //報名被拒絕
            $("#btnsActBtn1").css("display","none");
            $("#btnsActBtn1_1").css("display","none");
            $("#btnsActBtn1_2").css("display","inline-block");
        }else{
            //已報名等待審核
            $("#btnsActBtn1").css("display","none");
            $("#btnsActBtn1_1").css("display","inline-block"); 
        }
    }

    //loading之後判斷是否已經收藏此團
    function checkKeepThisGroup(){
        let keepStatus = "<?php echo $keepGroupStatusResult['Keep_Group_NO'];?>";
        if(keepStatus == ''){
            $("#btnsActBtn2").css("display","inline-block");
            $("#btnsActBtn2_2").css("display","none");
        }else{
            $("#btnsActBtn2").css("display","none");
            $("#btnsActBtn2_2").css("display","inline-block");
        }
    }
    function groupShow(){
        checkGroupLeader();
        checkSignUpStatus();
        checkKeepThisGroup();
    }
    //window.onload
    window.addEventListener("load",groupShow,false); 

    //點擊我要報名
    $("#btnsActBtn1").click(function(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if(xhr.status==200){
                console.log(xhr.responseText);
                alert('已成功報名');
                $("#btnsActBtn1").css("display","none");
                $("#btnsActBtn1_1").css("display","inline-block");
            }else{
                alert(xhr.status);
            }
        }
        xhr.open("post", "iWantToSignUp.php", true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
 
        let memberNo = '<?php echo $_SESSION["Mem_NO"];?>';
        let groupNo = '<?php echo $groupShowInfo["Group_NO"];?>';
        // alert(groupNo);
        xhr.send('SignUpMemberNo='+memberNo +'&SignUpGroupNo='+groupNo);   
    });

    //點擊取消報名
    $("#btnsActBtn1_1").click(function(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if(xhr.status==200){
                // console.log(xhr.responseText);
                alert('已取消報名');
                $("#btnsActBtn1").css("display","inline-block");
                $("#btnsActBtn1_1").css("display","none");
            }else{
                alert(xhr.status);
            }
        }
        xhr.open("post", "cancelSignUp.php", true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
 
        let memberNo = '<?php echo $_SESSION["Mem_NO"];?>';
        let groupNo = '<?php echo $groupShowInfo["Group_NO"];?>';
        xhr.send('cancelSignUpMemberNo='+memberNo +'&cancelSignUpGroupNo='+groupNo);   
    });

    //點擊收藏此團
    $("#btnsActBtn2").click(function(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if(xhr.status==200){
                $("#btnsActBtn2").css("display","none");
                $("#btnsActBtn2_2").css("display","inline-block");
                alert('已收藏此團');
            }else{
                alert(xhr.status);
            }
        }
        xhr.open("post", "keepThisGroup.php", true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
 
        let memberNo = '<?php echo $_SESSION["Mem_NO"];?>';
        let groupNo = '<?php echo $groupShowInfo["Group_NO"];?>';
        xhr.send('keepMemberNo='+memberNo +'&keepGroupNo='+groupNo);   
    });

    //點擊取消收藏此團
    $("#btnsActBtn2_2").click(function(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if(xhr.status==200){
                $("#btnsActBtn2").css("display","inline-block");
                $("#btnsActBtn2_2").css("display","none");
                alert('已取消收藏此團');
            }else{
                alert(xhr.status);
            }
        }
        xhr.open("post", "cancelKeepThisGroup.php", true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
 
        let memberNo = '<?php echo $_SESSION["Mem_NO"];?>';
        let groupNo = '<?php echo $groupShowInfo["Group_NO"];?>';
        xhr.send('cancelKeepMemberNo='+memberNo +'&cancelKeepGroupNo='+groupNo);   
    });

    //點擊查看會員詳情跳出資訊
    $(".showInfo").each(function(){
            $(this).click(function(){
    	        $(this).next('.info').css("display","block");
                $(this).css("display","none");
            });
        });
        //關閉查看會員詳情
        $(".closeInfo").each(function(){
            $(this).click(function(){
    	        $(this).parent().parent().parent('.info').css("display","none");
                $(this).parent().parent().parent().prev('.showInfo').css("display","inline-block");
            });
        });
        //審核，接受參團申請
        $(".accept").each(function(){
            $(this).click(function(){
    	        let xhr = new XMLHttpRequest();
                xhr.onload = function(){
                    if(xhr.status==200){
                        // console.log(xhr.responseText);
                        alert('審核成功');
                    }else{
                        alert(xhr.status);
                    }
                }
                xhr.open("post", "acceptMember.php", true);
                xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
 
                let mem_no = $(this).next('.memNo').text();
                // alert('acceptInfo='+mem_no);
                xhr.send('acceptInfo='+mem_no);  

                $('.joinedUl').append($(this).parent('.goingToJoinLi'));
                $(this).css("display","none");
                $(this).next().next('.refuse').css("display","none");
            });
        });
        //審核，拒絕參團申請
        $(".refuse").each(function(){
            $(this).click(function(){
    	        let xhr = new XMLHttpRequest();
                xhr.onload = function(){
                    if(xhr.status==200){
                        // console.log(xhr.responseText);
                        alert('已拒絕申請');
                    }else{
                        alert(xhr.status);
                    }
                }
                xhr.open("post", "refuseMember.php", true);
                xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
 
                let mem_no = $(this).prev('.memNo').text();
                xhr.send('refuseInfo='+mem_no); 

                $(this).parent('.goingToJoinLi').css("display","none");
            });
        });

</script>
