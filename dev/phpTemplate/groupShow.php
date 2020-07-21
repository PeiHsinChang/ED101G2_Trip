<?php
 
try {
    require_once("connectMemberTable.php");
    $mem_NO = $_SESSION["Mem_NO"];

    $sql_g = 
        "select * 
        from GroupTable g, MemberTable m
        where g.mem_no = m.mem_no
        and g.Group_NO =g.Group_NO;";
	$groupShow = $pdo->prepare($sql_g);
    $groupShow->bindValue(":Group_NO", $_GET["Group_NO"]);   
    $groupShow->bindValue(":Group_title", $_GET["Group_title"]);  
    $groupShow->execute();
    $groupShowInfo = $groupShow->fetch(PDO::FETCH_ASSOC);
    


} catch (PDOException $e) {
	// echo "系統暫時無法提供服務, 請通知系統維護人員<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}

?>


<div class="containerGroup">
    <div class="coverPhoto">
    <img src="<?=$groupShowInfo["Group_Pic"];?>" >
    </div>
    <br>
    <br>
    <div class="openNewGroup col-4 col-l-2 col-md-2 col-lg-2">
        <!-- <a onclick="openNewGroup();">
            <img src="./images/openNewGroup.png" class="d-md-block" />
        </a> -->
    </div>
    <div class="tabAll">
        <div class="tab">
            <button class="tabs" data-type="activity">活動說明</button>
            <button class="tabs" data-type="chat">留言板</button>
        </div>
        <div id="activity" class="tabcontent" style="display:block;">
            <div class="actAll">
                <aside class="actCont">
                    <h3>活動說明</h3>
                    <br>
                    <table  class="groupCardTable">
                        <?php 
                        echo $_GET["Group_NO"];
                        echo $_GET["Group_title"];
                        echo $_GET["Group_StartDate"];
                        ?>
                        <tr><th>團名</th><td><?=$groupShowInfo["Group_title"]?></td>
                        <tr><th>結束日期</th><td><?=$groupShowInfo["Group_StartDate"]?></td>
                        <tr><th>結束日期</th><td><?=$groupShowInfo["Group_EndDate"]?></td></tr>
                        <tr><th>報名截止</th><td><?=$groupShowInfo["Group_EndDate"]?></td></tr>
                        <tr><th>人數限制</th><td><?=$groupShowInfo["Group_Ppl"]?></td></tr>
                        <tr><th>性別限制</th><td><?=$groupShowInfo["Group_Sex"]?></td></tr>
                        <tr><th>年齡限制</th><td><?=$groupShowInfo["Group_Age"]?></td></tr>
                        <tr><th>團費</th><td><?=$groupShowInfo["Group_Fee"]?></td></tr>
                        <tr><th>集合地點</th><td><?=$groupShowInfo["Group_Place"]?></td></tr>
                        <tr><th>備註</th><td><?=$groupShowInfo["Group_Com"]?></td></tr>  
                    </table>
                    <?php
                   
                    ?>
                </aside>
                <aside class="btnsAct">
                    <button onclick="alert('已報名成功\n可前往會員中心查看報名結果喔！')" style="width:120px;height:40px;"><img
                            src="./images/icon/people.png"
                            style="width:30px;height:20px;margin:2px;">我要報名</button>
                    <button style="width:120px;height:40px;"><img
                            src="./images/icon/share.png"
                            style="width:28px;height:23px;margin:2px;">分享此團</button>
                    <button style="width:120px;height:40px;"><img
                            src="./images/icon/whiteheart.png"
                            style="width:28px;height:23px;margin:2px;">收藏此團</button>
                </aside>
            </div>
            <hr>
            <div class="joinList">
                <p>目前團員名單</p>
                <table class="joinMem">
                    <tr>
                        <td><img src="./images/profile.jpg">派大星</td>
                        <td><img src="./images/profile.jpg">愛旅遊</td>
                        <td><img src="./images/profile.jpg">狠愛吃</td>
                    </tr>
                </table>
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
                            <time>2020/05/09
                                10:24</time>
                        </td>
                    </tr>
                    <tr>
                        <td class="replies">請問團主，花費預算大概是多少呢？</td>
                    </tr>
                    <tr>
                        <td class="replies">答覆：約落在2萬～3萬左右！
                            <time>2020/05/09
                                10:24</time>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td rowspan="3"><img class="commentor" src="./images/profile.jpg"></td>
                        <td>
                            <span>愛旅遊</span>
                            <time>2020/05/09
                                10:24</time>
                        </td>
                    </tr>
                    <tr>
                        <td class="replies">請問團主，花費預算大概是多少呢？</td>
                    </tr>
                    <tr>
                        <td class="replies">答覆：約落在2萬～3萬左右！
                            <time>2020/05/09
                                10:24</time>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td rowspan="3"><img class="commentor" src="./images/profile.jpg"></td>
                        <td>
                            <span>愛旅遊</span>
                            <time>2020/05/09
                                10:24</time>
                        </td>
                    </tr>
                    <tr>
                        <td class="replies">請問團主，花費預算大概是多少呢？</td>
                    </tr>
                    <tr>
                        <td class="replies">答覆：約落在2萬～3萬左右！
                            <time>2020/05/09
                                10:24</time>
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
</div>


  

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
<style type="text/css">
    .groupCardTable{
    border:1px solid  rgb(188, 38, 84);
    margin-bottom:30px;
    min-width:300px;
 
    }
	.groupCardTable th {
        background-color : rgb(188, 38, 84);
        color:rgb(237, 237, 237);
        letter-spacing: 1.5px;
	}
	.groupCardTable td {
		/* border-bottom : dotted 1px deeppink; */
	}
</style>
</head>
<body>


<script>
        $(function(){
        $('body').on('click', '.tabs[data-type]', function (e) {
            let $obj = $(this);
            let type = $obj.data('type');
            openCity(e, type);
        });
        });


    //lightbox
    var myModal = document.getElementById("myModal");
    var btnOpen = document.getElementById("btnOpen");
    var btnClose = document.getElementById("btnClose");
    btnOpen.onclick = function() {
        myModal.style.display = "block ";
    }
    btnClose.onclick = function() {
        myModal.style.display = "none ";
    }
    //lightbox ends

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tabs = document.getElementsByClassName("tabs");
        for (i = 0; i < tabs.length; i++) {
            tabs[i].className = tabs[i].className.replace("active", " ");
        }

        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += "active";


        let memberNo = <?php echo $_SESSION["Mem_NO"]; ?>;
        let isUsrLeader = false;
        if (memberNo == <?php echo $groupShowInfo["Mem_NO"]?>) {
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
                            let memberNo = <?php echo $_SESSION["Mem_NO"]; ?>;
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
        let guestid = <?php echo $_SESSION["Mem_NO"]; ?>;
        let groupno = <?php echo $_GET["Group_NO"]?>;
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
        let guestid = <?php echo $_SESSION["Mem_NO"]; ?>;
        let groupno = <?php echo $_GET["Group_NO"]?>;
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



   
</script>
    

</body>
</html>


<h5><?php print_r($groupShowInfo);?></h5>