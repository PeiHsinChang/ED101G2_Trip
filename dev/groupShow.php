<?php 
try {
	require_once("connectMemberTable.php");
	$sql = "select * from groupTable where Group_NO=:Group_NO";
    $groupShow = $pdo->prepare($sql);
    $groupShow->bindValue(":Group_NO", $_GET["Group_NO"]);
	$groupShow->execute();
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
	.groupShowTable th {
		background-color : #bfbfef;
	}
	.groupShowTable td {
		border-bottom : dotted 1px deeppink;
	}
</style>
<body>
<?php 
if($groupShow->rowCount()==0){
	echo "";
}else{
	$groupShowRow = $groupShow->fetch(PDO::FETCH_ASSOC);
}
?>    
<table align="center" class="groupShowTable">
    <!-- <tr><th>團編號</th><td><?=$groupShowRow["Group_NO"]?></td></tr> -->
	<tr><th>團名</th><td><?=$groupShowRow["Group_title"]?></td></tr>
	<tr><th>報名期限</th><td><?=$groupShowRow["Group_Deadline"]?></td></tr>
	<tr><th>出發日期</th><td><?=$groupShowRow["Group_StartDate"]?></td></tr>
	<tr><th>結束日期</th><td><?=$groupShowRow["Group_EndDate"]?></td></tr>
    <tr><th>參團人數</th><td><?=$groupShowRow["Group_Ppl"]?></td></tr>
    <tr><th>性別限制</th><td><?=$groupShowRow["Group_Sex"]?></td></tr>
    <tr><th>年紀限制</th><td><?=$groupShowRow["Group_Age"]?></td></tr>
    <tr><th>預估費用</th><td><?=$groupShowRow["Group_Fee"]?></td></tr>
    <tr><th>集合地點</th><td><?=$groupShowRow["Group_Place"]?></td></tr>
    <tr><th>備註</th><td><?=$groupShowRow["Group_Com"]?></td></tr>

</table>
</body>
</html>

