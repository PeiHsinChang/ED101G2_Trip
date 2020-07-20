<?php
    // print_r($_SESSION["Mem_NO"]) ;
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


<h5><?php print_r( $groupShowInfo);?></h5>
<div class="container">
    <div class="openNewGroup col-4 col-l-2 col-md-2 col-lg-2">
        <a  onclick="openNewGroup();">
            <img src="./images/openNewGroup.png"  class="d-md-block" />
        </a>
    </div>
</div>
