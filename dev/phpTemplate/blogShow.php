<?php
    require_once("connectMemberTable.php");

try {
    $sql_b = 
        "select * 
        from blog b,membertable m
        where b.mem_no = m.mem_no
        and b.Blog_NO=:Blog_NO;";
     
	$blogArticle = $pdo->prepare($sql_b);
	$blogArticle->bindValue(":Blog_NO", $_GET["Blog_NO"]);
    $blogArticle->execute();
    $blogArticleInfo = $blogArticle->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	// echo "系統暫時無法提供服務, 請通知系統維護人員<br>";
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}

?>
<div class="containerBlog">
    <div class="coverPhoto">
        <img src="<?=$blogArticleInfo["Blog_PicURL"];?>">
    </div>


    <h5><?php print_r( $blogArticleInfo);?> </h5>
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
            <button class="btnSmall">收藏</button>
        </div>
    </div>
    <div class="blogContent">
        <aside class="blogCont">
            <h5><?=$blogArticleInfo["Blog_Name"];?></h5>
            <div>
                <p><?=$blogArticleInfo["Blog_Content"];?></p>
            </div>
            &nbsp;
            <div><span>What is Lorem Ipsum? </span><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type andscrambled
                it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div><br>
            <div id="imgSets">
                <img src="https://picsum.photos/500/400">
            </div>
            &nbsp;
            <div><span>Why do we use it? </span><br>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will
                uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</div><br>
            <div id="imgSets">
                <img src="https://picsum.photos/200/200">
                <img src="https://picsum.photos/400/200">
            </div>
            &nbsp;
            <div><span>Where does it come from? </span><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor
                at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum
                comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line
                of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</div><br>
            <div>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English
                versions from the 1914 translation by H. Rackham.
            </div>
            <br>
            <div id="imgSets">
                <img src="https://picsum.photos/300/200?random=1">
                <img src="https://picsum.photos/400/200?random=3">
            </div>
            &nbsp;
        </aside>
        <aside class="popular">
            <div class="popTitle">熱門行程</div>
            <div class="blogAds">
                <img src="https://picsum.photos/300/200?random=3" alt="..." style="width:100%;">
                <div class="adsMask">
                    <p>九族文化村四日遊</p>
                </div>
            </div>
            <div class="blogAds">
                <img src="https://picsum.photos/300/200?random=4" alt="..." style="width:100%;">
                <div class="adsMask">
                    <p>九族文化村四日遊</p>
                </div>
            </div>
            <div class="blogAds">
                <img src="https://picsum.photos/300/200?random=5" alt="..." style="width:100%;">
                <div class="adsMask">
                    <p>九族文化村四日遊</p>
                </div>
            </div>
            <div class="blogAds">
                <img src="https://picsum.photos/300/200?random=6" alt="..." style="width:100%;">
                <div class="adsMask">
                    <p>九族文化村四日遊</p>
                </div>
            </div>
        </aside>
    </div>

</div>

</div>

<script>
    var btnOpen = document.getElementById('btnOpen');
    btnOpen.onclick = function() {
        myModal.style.display = "block ";
    }
    
</script>