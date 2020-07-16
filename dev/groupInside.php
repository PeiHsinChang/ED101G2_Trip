<!DOCTYPE html>
<html lang="en">
    <?php  require_once("./phpTemplate/head.php"); ?>

<body>
    <?php  require_once("./phpTemplate/nav.php"); ?>
    <?php  require_once("./phpTemplate/groupShow.php"); ?>
    <?php  require_once("./phpTemplate/footer.php"); ?>
    <div id="setupGroup" class="lightBoxWall" style="overflow-y: scroll;">
        <?php  require_once("./phpTemplate/setupGroup.php"); ?>
    </div>
</body>
<script>
    let setupGroup = document.getElementById("setupGroup");
    function openNewGroup(){
        setupGroup.style.display = "block";
    };
    function closeNewGroup(){
        setupGroup.style.display = "none";
    };
</script>
</html>
