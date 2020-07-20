<?php
try{
    require_once("connectMemberTable.php");

    //揪團卡片指令
	$sql="select * from GroupTable";
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
<table align="center" class="prodTable">
	<tr><th>書名</th><td><?=$groupShowRows["Group_NO"]?></td></tr>
	<tr><th>團名</th><td><?=$groupShowRows["Group_title"]?></td></tr>
	<tr><th>出發日期</th><td><?=$groupShowRows["Group_StartDate"]?></td></tr>
	<tr><th>價格</th><td><?=$groupShowRows["price"]?></td></tr>
	<tr><th>作者</th><td><?=$groupShowRows["author"]?></td></tr>
	<tr><th>頁數</th><td><?=$groupShowRows["pages"]?></td></tr>
</table>
</body>
</html>