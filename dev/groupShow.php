<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
	$sql="select * from `GroupTable` where Group_Ppl <10";
	$groupShow = $pdo->query($sql); 
	$groupShow -> bindValue(":Group_NO", $_GET["Group_NO"]);
	$groupShow -> execute();
	// $groupShowInfo=$groupShow->fetchAll(PDO::FETCH_ASSOC);



    //卡片們所需要資料
    // $groupShowCards=array();
    // if($groupShow -> rowCount()==0){
    //     echo "{}";
    // }else{
    //     $groupShowInfo=array();
    //     while($groupShowRows = $groupShow->fetch(PDO::FETCH_ASSOC)){
    //     $groupShowInfo[] = array(
    //             "Group_title"=>$groupShowRows["Group_title"],
	// 			"Group_StartDate"=>$groupShowRows["Group_StartDate"],
	// 			"Group_EndDate"=>$groupShowRows["Group_EndDate"],
	// 			"Group_Deadline"=>$groupShowRows["Group_Deadline"],
	// 			"Group_Ppl"=>$groupShowRows["Group_Ppl"],
	// 			"Group_Sex"=>$groupShowRows["Group_Sex"],
	// 			"Group_Age"=>$groupShowRows["Group_Age"],
	// 			"Group_Place"=>$groupShowRows["Group_Place"],
	// 			"Group_Com"=>$groupShowRows["Group_Com"],
	// 			"Group_Pic"=>$groupShowRows["Group_Pic"],
    //         );	
    //     }   
    // }

    //串接資料
    // array_push($groupShowCards,$groupShowInfo);
    // echo json_encode($groupShowCards,JSON_UNESCAPED_UNICODE);

}catch(PDOException $e){
 echo "錯誤行號:", $e->getLine(),"<br>";
 echo "錯誤原因:", $e->getMessage(),"<br>";
}


?>


<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
<style type="text/css">
	.prodTable th {
		background-color : #bfbfef;
	}
	.prodTable td {
		border-bottom : dotted 1px deeppink;
	}
</style>
</head>
<body>
<?php 
if($groupShow->rowCount()==0){
	echo "";
}else{
	$groupShowRows = $groupShow->fetch(PDO::FETCH_ASSOC);

}
?>    


<div id="groupShowAll" class="tabAll">
        <div class="tab">
            <button class="tabs" onclick="openCity(event, 'activity')">活動說明</button>
            <button class="tabs" onclick="openCity(event, 'chat')">留言板</button>
        </div>
        <div id="activity" class="tabcontent" style="display:block;">
            <div class="actAll">
                <aside class="actCont">
                    <h3>活動說明</h3>
                    <p>London is the capital city of England.</p>
					
					<table class="prodTable">
						<tr><th>團號</th><td><?=$groupShowRows["Group_NO"]?></td></tr>
						<tr><th>團名</th><td><?=$groupShowRows["Group_title"]?></td></tr>
						<tr><th>出發日期</th><td><?=$groupShowRows["Group_StartDate"]?></td></tr>
						<tr><th>價格</th><td><?=$groupShowRows["price"]?></td></tr>
						<tr><th>作者</th><td><?=$groupShowRows["author"]?></td></tr>
						<tr><th>頁數</th><td><?=$groupShowRows["pages"]?></td></tr>
					</table>


                </aside>
                <aside class="btnsAct">
                    <button onclick="alert('已報名成功\n可前往會員中心查看報名結果喔！')"><img
                            src="#">我要報名</button>
                    <button><img src="#">分享此團</button>
                    <button><img src="#">收藏此團</button>
                </aside>
            </div>
            <hr>
            <!-- <div class="joinList">
                <p>目前團員名單</p>
                <table class="joinMem">
                    <tr>
                        <td><img src="./images/profile.jpg">派大星</td>
                        <td><img src="./images/profile.jpg">愛旅遊</td>
                        <td><img src="./images/profile.jpg">狠愛吃</td>
                    </tr>
                </table>
            </div> -->
        </div>
        <!-- <div id="chat" class="tabcontent" style="display: none;">
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
        </div> -->

    </div>

</body>
</html>