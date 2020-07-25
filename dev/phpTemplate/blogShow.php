<?php
  
try {
    require_once("connectMemberTable.php");
    session_start();
  

   //遊記內文
    $sql_b = 
        "select * 
        from blog b,membertable m
        where b.mem_no = m.mem_no
        and b.Blog_NO=:Blog_NO;";

	$blogArticle = $pdo->prepare($sql_b);
	$blogArticle->bindValue(":Blog_NO", $_GET["Blog_NO"]);
    $blogArticle->execute();
    $blogArticleInfo = $blogArticle->fetch(PDO::FETCH_ASSOC);


    //遊記照片
    $sql_bPic=
    "select * 
    from blog_pic bp
    where Blog_NO=:Blog_NO;";
    $blogPic = $pdo->prepare($sql_bPic);
    $blogPic->bindValue(":Blog_NO", $_GET["Blog_NO"]);
    $blogPic->execute();
    $blogPicInfo = $blogPic->fetch(PDO::FETCH_ASSOC);

    //遊記廣告
    $sql_bPop=
    "select * 
    from blog
    order by Blog_Views desc
    limit 4;";
    $blogPop = $pdo->prepare($sql_bPop);
    $blogPop->execute();


     
} catch (PDOException $e) {
	// echo "系統暫時無法提供服務, 請通知系統維護人員<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>




<div class="containerBlog">
    <div class="containerBlogPhoto">
        <img src="<?=$blogArticleInfo["Blog_PicURL"];?>">
    </div>

    <a href="./writeBlog.html"><img src="./images/writeBlog.png"></a>

    <div class="writerBlog">
        <div class="boxWriter">
            <img src="<?=$blogArticleInfo["Mem_Photo"];?>" class="profileAuthor">
            <table>
                <tr>
                    <td>作者: <?=$blogArticleInfo["Mem_Name"];?></td>
                </tr>
                <tr>
                    <td><?=$blogArticleInfo["Blog_Date"];?></td>
                </tr>
                <tr>
                    <td><?=$blogArticleInfo["Blog_Views"];?>人氣</td>
                </tr>
            </table>
            <div class="btnKeep">
                <button type="button" class="btnMid" id="blogkeepBtn" onclick="keepTheBlog()"> 收藏</button>
                <!-- <button class="btnMid" id="blogkeepBtn_1">取消收藏</button> -->
            </div>
        </div>
    </div>
    <div class="blogContent">
        <aside class="blogCont">
            <h5><?=$blogArticleInfo["Blog_Name"];?></h5>
            <div>
                <p><?=$blogArticleInfo["Blog_Content"];?></p>
            </div>
            &nbsp;
            <img src="<?=$blogPicInfo["Blog_SubPicURL"];?>">
        </aside>
        <aside class="popular">
            <div class="popTitle">熱門行程</div>
            <?php
                while($blogPopInfo = $blogPop->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="blogAds">
                <img src="<?=$blogPopInfo["Blog_PicURL"];?>" alt="..." style="width:100%;">
                <div class="adsMask">
                    <p><?=$blogPopInfo["Blog_Name"];?></p>
                </div>
            </div>
            <?php
                }
            ?>
            
        </aside>
    </div>
</div>

</div>

<h5><?php print_r($blogArticleInfo);?></h5>
<?php echo $_SESSION["Mem_NO"];?>



<script>
    // var btnOpen = document.getElementById('btnOpen');
    // btnOpen.onclick = function() {
    //     myModal.style.display = "block ";
    // }


// $("#blogkeepBtn").click(function(){
//     let xhr = new XMLHttpRequest();
//     xhr.onload=function(){
//         let member = '<?php echo $_SESSION["Mem_NO"];?>';
//         if(member== ''){
//             alert('請先登入');
//         }else{
//            if(xhr.status==200){
//             $("#blogkeepBtn").text("取消收藏");
//             alert('已收藏此遊記');
//            }else{
//             alert(xhr.status);
//            }
//         }
//     }
//     xhr.open("get","keepThisBlog.php",true);
//     xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
//     xhr.send();
// });


//點擊遊記收藏
function keepTheBlog(){
  let blogNo = <?=$blogArticleInfo["Blog_NO"];?>;
  console.log(blogNo);
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
      if(xhr.status == 200){
        alert(xhr.responseText);          
      }
    }
    xhr.open("post", "checkThisBlog.php", true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xhr.send(`blogNo=${blogNo}`);              
    
  };

   
</script>