<?php
        
try {
    require_once("connectMemberTable.php");
    $sql_g = 
        "select * 
        from grouptable g,membertable m
        where g.mem_no = m.mem_no
        and g.Group_NO =:Group_NO;";
	$groupShow = $pdo->prepare($sql_g);
	$groupShow->bindValue(":Group_NO", $_GET["Group_NO"]);
    $groupShow->execute();
    $groupShowInfo = $groupShow->fetch(PDO::FETCH_ASSOC);
    //echo $groupShowInfo["Mem_NO"]==$_SESSION["Mem_NO"]?'是團主':'不是團主';
} catch (PDOException $e) {
	// echo "系統暫時無法提供服務, 請通知系統維護人員<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}

?>
    <img src="<?=$groupShowInfo["Group_Pic"];?>" >

<div class="containerGroup">
    <div class="coverPhoto">
    </div>
   
</div>
<div class="container">
<h5><?php print_r( $groupShowInfo);?></h5>
    <div class="openNewGroup col-4 col-l-2 col-md-2 col-lg-2">
        <a  onclick="openNewGroup();">
            <img src="./images/openNewGroup.png"  class="d-md-block" />
        </a>
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
                    <p>London is the capital city of England.</p>
                </aside>
                <aside class="btnsAct">
                <button onclick="alert('已報名成功\n可前往會員中心查看報名結果喔！')" style="width:120px;height:40px;"><img
                            src="./images/icon/people.png" style="width:30px;height:20px;margin:2px;">我要報名</button>
                    <button style="width:120px;height:40px;"><img src="./images/icon/share.png" style="width:28px;height:23px;margin:2px;">分享此團</button>
                    <button style="width:120px;height:40px;"><img src="./images/icon/whiteheart.png" style="width:28px;height:23px;margin:2px;">收藏此團</button>
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
        </div>
    </div>
</div>





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
    // var myModal = document.getElementById("myModal");
    // var btnOpen = document.getElementById("btnOpen");
    // var btnClose = document.getElementById("btnClose");
    // btnOpen.onclick = function() {
    //     myModal.style.display = "block ";
    // }
    // btnClose.onclick = function() {
    //     myModal.style.display = "none ";
    // }

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