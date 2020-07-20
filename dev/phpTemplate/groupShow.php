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


<h5><?php print_r($groupShowInfo);?></h5>
<div class="container">
    <div class="openNewGroup col-4 col-l-2 col-md-2 col-lg-2">
        <a  onclick="openNewGroup();">
            <img src="./images/openNewGroup.png"  class="d-md-block" />
        </a>
    </div>
</div>


<!DOCTYPE html>
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
  
<table  class="prodTable">
	<tr><th>團名</th><td><?=$groupShowInfo["Group_title"]?></td></tr>
	<tr><th>出發日期</th><td><?=$groupShowInfo["Group_StartDate"]?></td></tr>
	<tr><th>結束日期</th><td><?=$groupShowInfo["Group_EndDate"]?></td></tr>
	<tr><th>報名截止</th><td><?=$groupShowInfo["Group_EndDate"]?></td></tr>
    <tr><th>人數限制</th><td><?=$groupShowInfo["Group_Ppl"]?></td></tr>
    <tr><th>性別限制</th><td><?=$groupShowInfo["Group_Sex"]?></td></tr>
    <tr><th>年齡限制</th><td><?=$groupShowInfo["Group_Age"]?></td></tr>
    <tr><th>團費</th><td><?=$groupShowInfo["Group_Fee"]?></td></tr>
    <tr><th>集合地點</th><td><?=$groupShowInfo["Group_Place"]?></td></tr>
    <tr><th>備註</th><td><?=$groupShowInfo["Group_Com"]?></td></tr>
</table>
</body>
</html>
