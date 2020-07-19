<?php 
try {
	require_once("connectMemberTable.php");
	$sql = "select * from groupTable";
	$products = $pdo->query($sql);
	
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
	while($prodRow = $products->fetch(PDO::FETCH_ASSOC)){
?>
		<tr>
		<td> <?=$prodRow["psn"];?></td>
		<td> 
			<a href="prodQuery.php?psn=<?=$prodRow["psn"];?>">
			<?=$prodRow["pname"];?>
			</a>
		</td>
		<td> <?=$prodRow["price"];?></td>	
		<td> <?=$prodRow["author"];?></td>
		<td> <img width="50" src="images/<?=$prodRow["image"];?>"></td>
		</tr>	
<?php		
	}
?>    
</table>
</body>
</html>