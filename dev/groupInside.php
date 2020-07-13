<!DOCTYPE html>
<html lang="en">
    require_once("head.php");  

<body>
    require_once("nav.php");     
    require_once("groupShow.php");  
    require_once("footer.php");  
    <div id="setupGroup" class="lightBoxWall" >
        require_once("setupGroup.php");  
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