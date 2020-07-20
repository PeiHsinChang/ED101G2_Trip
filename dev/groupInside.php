<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<?php require_once("./phpTemplate/head.php");?> 
<style>
       /* scrollbar hidden */
  html {
    overflow: -moz-hidden-unscrollable;
    height: 100%;
  }

  body::-webkit-scrollbar {
    display: none;
  }

  body {
    -ms-overflow-style: none;
    height: 100%;
	width: calc(100vw + 18px);
	overflow: auto;
  }
</style>

<body>
    <?php require_once("./phpTemplate/nav.php");?> 
    <?php require_once("./phpTemplate/groupShow.php");?> 
    <?php require_once("./phpTemplate/footer.php");?> 

    <div id="setupGroup" class="lightBoxWall" style="overflow-y: scroll;">
        <?php require_once("./phpTemplate/setupGroup.php");?> 
    </div>
</body>
<script>
    let setupGroup = document.getElementById("setupGroup");
    function openNewGroup(){
        setupGroup.style.display = "block";
        $("body").css({'overflow':'hidden'});
        $("body").css('position','fixed');
    };
    function closeNewGroup(){
        setupGroup.style.display = "none";
        $("body").css({'overflow-y':'visible'});
        $('body').css('position','initial');
    };
</script>
</html>
