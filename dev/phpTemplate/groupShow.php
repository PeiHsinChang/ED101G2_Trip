<?php
    // print_r($_SESSION["Mem_NO"]) ;
try {
    require_once("connectMemberTable.php");
    $sql_g = 
        "select * 
        from GroupTable g, MemberTable m
        where g.mem_no = m.mem_no
        and g.Group_NO =g.Group_NO;";
	$groupShow = $pdo->prepare($sql_g);
	$groupShow->bindValue(":Group_NO", $_GET["Group_NO"]);
    $groupShow->execute();
    $groupShowInfo = $groupShow->fetch(PDO::FETCH_ASSOC);
    
    // for($i=0; $i<count($_GET["Group_NO"]); $i++){
    //     echo $_GET["Group_NO"][$i];
    // }


    // foreach ($groupShowInfo as $row){
    //     echo "<tr>";
    //     foreach($row as $data){
    //         echo "<td>",$data,"</td>";
    //     }
    //     echo "</tr>";   
    // }
    

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
            <button class="tabs" onclick="openCity(event, 'activity')">活動說明</button>
            <button class="tabs" onclick="openCity(event, 'chat')">留言板</button>
        </div>
        <div id="activity" class="tabcontent" style="display:block;">
            <div class="actAll">
                <aside class="actCont">
                    <h3>活動說明</h3>
                    <br>
                    <table  class="groupCardTable">
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
                    echo $groupShowInfo[$i][0];
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
            <div class="chatCont">
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
        </div>

    </div>
  
</div>


<h5><?php print_r($groupShowInfo);?></h5>




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
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName(" tabcontent ");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none ";
        }

        tabs = document.getElementsByClassName("tabs ");
        for (i = 0; i < tabs.length; i++) {
            tabs[i].className = tabs[i].className.replace(" active ", " ");
        }

        document.getElementById(cityName).style.display = "block ";
        evt.currentTarget.className += " active ";
    }

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
    }
</script>



</body>
</html>
