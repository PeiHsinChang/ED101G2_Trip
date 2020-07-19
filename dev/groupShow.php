<?php 
try {
	require_once("connectMemberTable.php");
	$sql = "select * from groupTable";
	$groupShow = $pdo->query($sql);
	
} catch (PDOException $e) {
	// echo "系統暫時無法提供服務, 請通知系統維護人員<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";	
}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
<style type="text/css">

  table td {border-bottom:1px dotted deeppink;padding:2px 4px;}

</style>
<body>

	<table align="center" width="800">
	<tr bgcolor="#bfbfef">
		<th>書號</th>
		<th>書名</th>
		<th>價格</th>
		<th>作者</th>
		<th>圖片</th>
	</tr>	
	
<?php 
	while($groupShowRow = $groupShow->fetch(PDO::FETCH_ASSOC)){
?>
		<tr>
		<td> <?=$groupShowRow["Group_NO"];?></td>
		<td> 
			<a href="prodQuery.php?psn=<?=$prodRow["psn"];?>">
			<?=$groupShowRow["pname"];?>
			</a>
		</td>
		<td> <?=$groupShowRow["price"];?></td>	
		<td> <?=$groupShowRow["author"];?></td>
		<td> <img width="50" src="images/<?=$groupCardsRow["image"];?>"></td>
		</tr>	
<?php		
	}
?>    
</table>
</body>
</html>






<div style="width:1000px;height:500px;"></div>
<div class="container">
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
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                    <p>London is the capital city of England.</p>
                </aside>
                <aside class="btnsAct">
                    <button onclick="alert('已報名成功\n可前往會員中心查看報名結果喔！')"><img
                            src="#">我要報名</button>
                    <button><img src="#">分享此團</button>
                    <button><img src="#">收藏此團</button>
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